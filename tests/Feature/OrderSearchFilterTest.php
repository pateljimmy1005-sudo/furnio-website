<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderSearchFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_search_orders_by_product_name_and_order_id()
    {
        $user = User::factory()->create();

        $product1 = Product::create([
            'name' => 'Royal Velvet Sofa',
            'category' => 'Sofa',
            'price' => 25000,
            'description' => 'Luxury sofa',
            'image' => 'images/sofa.jpg',
            'stock' => 5,
            'is_active' => true,
        ]);

        $product2 = Product::create([
            'name' => 'Wooden Study Desk',
            'category' => 'Table',
            'price' => 8000,
            'description' => 'Study desk',
            'image' => 'images/desk.jpg',
            'stock' => 10,
            'is_active' => true,
        ]);

        $order1 = Order::create([
            'user_id' => $user->id,
            'status' => 'Delivered',
            'total_amount' => 25000,
            'name' => 'John Doe',
            'email' => $user->email,
            'phone' => '9876543210',
            'address' => '123 St',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395007',
            'payment_method' => 'Online',
            'payment_status' => 'paid',
            'razorpay_payment_id' => 'pay_test_9999',
        ]);
        OrderItem::create(['order_id' => $order1->id, 'product_id' => $product1->id, 'quantity' => 1, 'price' => 25000, 'subtotal' => 25000]);

        $order2 = Order::create([
            'user_id' => $user->id,
            'status' => 'Created',
            'total_amount' => 8000,
            'name' => 'Alice Smith',
            'email' => $user->email,
            'phone' => '8888877777',
            'address' => '123 St',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395007',
            'payment_method' => 'COD',
            'payment_status' => 'pending',
        ]);
        OrderItem::create(['order_id' => $order2->id, 'product_id' => $product2->id, 'quantity' => 1, 'price' => 8000, 'subtotal' => 8000]);

        // Search product name partial keyword "Velvet"
        $response = $this->actingAs($user)->get(route('orders', ['search' => 'Velvet']));
        $response->assertStatus(200);
        $response->assertSee('Royal Velvet Sofa');
        $response->assertDontSee('Wooden Study Desk');

        // Search by Order ID formatted as #1
        $response = $this->actingAs($user)->get(route('orders', ['search' => '#' . $order1->id]));
        $response->assertStatus(200);
        $response->assertSee('Royal Velvet Sofa');

        // Search by Phone number
        $response = $this->actingAs($user)->get(route('orders', ['search' => '8888877777']));
        $response->assertStatus(200);
        $response->assertSee('Wooden Study Desk');
        $response->assertDontSee('Royal Velvet Sofa');

        // Search by Razorpay Payment ID
        $response = $this->actingAs($user)->get(route('orders', ['search' => 'pay_test_9999']));
        $response->assertStatus(200);
        $response->assertSee('Royal Velvet Sofa');
        $response->assertDontSee('Wooden Study Desk');
    }

    public function test_inactive_product_redirects_gracefully_instead_of_404()
    {
        $user = User::factory()->create();

        $inactiveProduct = Product::create([
            'name' => 'Discontinued Chair',
            'category' => 'Chair',
            'price' => 1200,
            'description' => 'Old chair',
            'image' => 'images/chair.jpg',
            'stock' => 0,
            'is_active' => false,
        ]);

        $response = $this->actingAs($user)->get(route('image.detail', $inactiveProduct->id));
        $response->assertRedirect(route('store'));
        $response->assertSessionHas('info', 'This product is currently unavailable.');
    }
}
