<?php

namespace App\Modules\Carts\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Carts\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Mostrar la vista del carrito
     */
    public function index()
    {
        $cartData = $this->cartService->getCartSummary();

        return view('cart.index', [
            'cart' => $cartData['items'],
            'total' => $cartData['total'],
            'itemCount' => $cartData['count']
        ]);
    }

    /**
     * Agregar producto al carrito
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0'
        ]);

        $result = $this->cartService->addToCart(
            $request->product_id,
            $request->quantity,
            $request->unit_price
        );

        return back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Actualizar cantidad de un item
     */
    public function update(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0'
        ]);

        $result = $this->cartService->updateQuantity(
            $cartItemId,
            $request->quantity,
            $request->unit_price
        );

        return response()->json($result);
    }

    /**
     * Eliminar producto del carrito
     */
    public function remove($cartItemId)
    {
        $result = $this->cartService->removeFromCart($cartItemId);

        return response()->json($result);
    }

    /**
     * Vaciar carrito completo
     */
    public function clear()
    {
        $result = $this->cartService->clearCart();

        return response()->json($result);
    }

    /**
     * Obtener resumen del carrito (para AJAX)
     */
    public function summary()
    {
        $cartData = $this->cartService->getCartSummary();

        return response()->json($cartData);
    }
}
