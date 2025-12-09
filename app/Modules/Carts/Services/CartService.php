<?php

namespace App\Modules\Carts\Services;

use App\Modules\Carts\Repositories\CartRepository;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getUserCart()
    {
        $userId = auth()->id();
        return $this->cartRepository->getUserCart($userId);
    }

    public function addToCart($productId, $quantity, $unitPrice)
    {
        $userId = auth()->id();

        // Obtener o crear carrito
        $cart = $this->cartRepository->getOrCreateCart($userId);

        // Agregar item
        $this->cartRepository->addItem($cart->id, $productId, $quantity, $unitPrice);

        return [
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'cart_items_count' => $this->cartRepository->countItems($cart->id)
        ];
    }

    public function updateQuantity($cartItemId, $quantity, $unitPrice)
    {
        if ($quantity <= 0) {
            return $this->removeFromCart($cartItemId);
        }

        $this->cartRepository->updateItemQuantity($cartItemId, $quantity, $unitPrice);

        return [
            'success' => true,
            'message' => 'Cantidad actualizada'
        ];
    }

    public function removeFromCart($cartItemId)
    {
        $this->cartRepository->removeItem($cartItemId);

        return [
            'success' => true,
            'message' => 'Producto eliminado del carrito'
        ];
    }

    public function clearCart()
    {
        $userId = auth()->id();
        $cart = $this->cartRepository->getUserCart($userId);

        if ($cart) {
            $this->cartRepository->clearCart($cart->id);
        }

        return [
            'success' => true,
            'message' => 'Carrito vaciado'
        ];
    }

    public function getCartSummary()
    {
        $cart = $this->getUserCart();

        if (!$cart) {
            return [
                'items' => [],
                'total' => 0,
                'count' => 0
            ];
        }

        return [
            'items' => $cart->items,
            'total' => $this->cartRepository->getCartTotal($cart->id),
            'count' => $this->cartRepository->countItems($cart->id)
        ];
    }
}
