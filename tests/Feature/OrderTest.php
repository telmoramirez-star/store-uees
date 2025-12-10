<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_checkout()
    {
        // 1. Create User and Product
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'price' => 100.00
        ]);

        // 2. Create Cart and Item
        $cart = Cart::create([
            'user_id' => $user->id,
            'status' => 'ACTIVE'
        ]);

        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'amount' => 2,
            'unit_price' => 100.00,
            'subtotal' => 200.00
        ]);

        // 3. Authenticate
        $this->actingAs($user);

        // 4. Hit Checkout Endpoint
        $response = $this->post(route('orders.store'));

        // 5. Assertions
        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total' => 200.00,
            'status' => 'queued'
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'amount' => 2,
            'subtotal' => 200.00
        ]);

        // Assert Cart is soft deleted
        $this->assertSoftDeleted('carts', ['id' => $cart->id]);
    }

    public function test_admin_can_view_pending_orders()
    {
        $admin = User::factory()->create(['email' => 'admin@store.com']);
        $user = User::factory()->create();
        
        // Create an order directly
        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'status' => 'queued',
            'total' => 500.00
        ]);

        $this->actingAs($admin);

        $response = $this->get(route('orders.index'));

        $response->assertStatus(200);
        $response->assertSee('Gestión de Pedidos Pendientes');
        $response->assertSee(number_format(500, 2));
    }
}
