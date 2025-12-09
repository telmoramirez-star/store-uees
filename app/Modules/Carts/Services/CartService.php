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
        // Temporal: usar user_id = 1 para pruebas sin autenticación
        $userId = 1;
        return $this->cartRepository->getUserCart($userId);
    }

    public function addToCart($productId, $quantity, $unitPrice)
    {
        // Temporal: usar user_id = 1 para pruebas
        $userId = 1;

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
        // Temporal: usar user_id = 1
        $userId = 1;
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
