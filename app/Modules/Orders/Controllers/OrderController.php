<?php

namespace App\Modules\Orders\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of pending orders.
     */
    public function index()
    {
        $orders = Order::with('user')
            ->where('status', 'queued')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created order in storage (Checkout).
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 'ACTIVE')->first();

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        try {
            DB::beginTransaction();

            // Calculate total
            $total = $cart->items->sum('subtotal');

            // Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'queued',
                'total' => $total,
            ]);

            // Create Order Items
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'amount' => $cartItem->amount,
                    'unit_price' => $cartItem->unit_price,
                    'subtotal' => $cartItem->subtotal,
                ]);
            }

            // Clear Cart (Soft Delete as per model)
            $cart->delete();

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Pedido realizado con éxito.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Hubo un error al procesar el pedido. Intentelo de nuevo.');
        }
    }
}
