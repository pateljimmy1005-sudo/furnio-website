<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_inactive_products_are_hidden_from_storefront()
    {
        $activeProduct = Product::create([
            'name' => 'Active Chair',
            'category' => 'Chair',
            'price' => 1000,
            'description' => 'Test chair',
            'image' => 'images/test.jpg',
            'stock' => 10,
            'is_active' => true,
        ]);

        $inactiveProduct = Product::create([
            'name' => 'Inactive Chair',
            'category' => 'Chair',
            'price' => 1500,
            'description' => 'Hidden chair',
            'image' => 'images/test2.jpg',
            'stock' => 5,
            'is_active' => false,
        ]);

        $response = $this->get(route('store'));
        $response->assertStatus(200);
        $response->assertSee('Active Chair');
        $response->assertDontSee('Inactive Chair');
    }

    public function test_admin_can_toggle_product_status()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $product = Product::create([
            'name' => 'Toggle Sofa',
            'category' => 'Sofa',
            'price' => 5000,
            'description' => 'Test sofa',
            'image' => 'images/sofa.jpg',
            'stock' => 3,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.product.toggle-status', $product->id));
        $response->assertRedirect();

        $product->refresh();
        $this->assertFalse((bool)$product->is_active);
    }
}
