<?php

namespace App\Modules\Carts\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartRepository
{

    public function getOrCreateCart($userId)
    {
        return Cart::firstOrCreate(
            ['user_id' => $userId, 'status' => 'ACTIVE'],
            ['expiration_at' => now()->addDays(7)]
        );
    }

    public function getUserCart($userId)
    {
        return Cart::with(['items.product'])
            ->where('user_id', $userId)
            ->where('status', 'ACTIVE')
            ->first();
    }

    public function addItem($cartId, $productId, $quantity, $unitPrice)
    {
        $subtotal = $quantity * $unitPrice;

        return CartItem::updateOrCreate(
            [
                'cart_id' => $cartId,
                'product_id' => $productId
            ],
            [
                'amount' => DB::raw("amount + $quantity"),
                'unit_price' => $unitPrice,
                'subtotal' => DB::raw("subtotal + $subtotal")
            ]
        );
    }

    public function updateItemQuantity($cartItemId, $quantity, $unitPrice)
    {
        $item = CartItem::findOrFail($cartItemId);
        $item->amount = $quantity;
        $item->subtotal = $quantity * $unitPrice;
        $item->save();

        return $item;
    }

    public function removeItem($cartItemId)
    {
        return CartItem::destroy($cartItemId);
    }

    public function clearCart($cartId)
    {
        return CartItem::where('cart_id', $cartId)->delete();
    }

    public function getCartTotal($cartId)
    {
        return CartItem::where('cart_id', $cartId)->sum('subtotal');
    }

    public function countItems($cartId)
    {
        return CartItem::where('cart_id', $cartId)->sum('amount');
    }
}
