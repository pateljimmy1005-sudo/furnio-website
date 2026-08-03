<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_verified_buyers_can_submit_reviews()
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Luxury Chair',
            'category' => 'Chair',
            'price' => 2000,
            'description' => 'Test chair',
            'image' => 'images/chair.jpg',
            'stock' => 10,
            'is_active' => true,
        ]);

        // Attempt submission without purchase
        $response = $this->actingAs($user)->post(route('review.store'), [
            'product_id' => $product->id,
            'rating' => 5,
            'title' => 'Awesome Product',
            'review' => 'Loved it so much!',
        ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseCount('reviews', 0);

        // Now create a delivered order for this product
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'Delivered',
            'total_amount' => 2000,
            'full_name' => 'John Doe',
            'email' => $user->email,
            'phone' => '9876543210',
            'address' => '123 Test St',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395007',
            'payment_method' => 'COD',
            'payment_status' => 'paid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 2000,
            'subtotal' => 2000,
        ]);

        // Submit review after verified purchase
        $response = $this->actingAs($user)->post(route('review.store'), [
            'product_id' => $product->id,
            'rating' => 5,
            'title' => 'Awesome Product',
            'review' => 'Loved it so much!',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 5,
            'title' => 'Awesome Product',
            'review' => 'Loved it so much!',
        ]);
    }

    public function test_prevents_duplicate_reviews_and_allows_updates()
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'King Bed',
            'category' => 'Bed',
            'price' => 15000,
            'description' => 'Test bed',
            'image' => 'images/bed.jpg',
            'stock' => 5,
            'is_active' => true,
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'Delivered',
            'total_amount' => 15000,
            'full_name' => 'Jane Doe',
            'email' => $user->email,
            'phone' => '9876543210',
            'address' => '456 Test St',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395007',
            'payment_method' => 'COD',
            'payment_status' => 'paid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 15000,
            'subtotal' => 15000,
        ]);

        // Initial review
        $this->actingAs($user)->post(route('review.store'), [
            'product_id' => $product->id,
            'rating' => 4,
            'title' => 'Good bed',
            'review' => 'Comfortable sleep',
        ]);

        $this->assertDatabaseCount('reviews', 1);

        // Update existing review
        $this->actingAs($user)->post(route('review.store'), [
            'product_id' => $product->id,
            'rating' => 5,
            'title' => 'Superb Bed!',
            'review' => 'Updated: Best bed ever!',
        ]);

        $this->assertDatabaseCount('reviews', 1);
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 5,
            'title' => 'Superb Bed!',
        ]);
    }

    public function test_calculates_average_rating_and_breakdown_correctly()
    {
        $product = Product::create([
            'name' => 'Dining Table',
            'category' => 'Table',
            'price' => 8000,
            'description' => 'Test table',
            'image' => 'images/table.jpg',
            'stock' => 4,
            'is_active' => true,
        ]);

        $u1 = User::factory()->create();
        $u2 = User::factory()->create();

        Review::create(['user_id' => $u1->id, 'product_id' => $product->id, 'rating' => 5, 'title' => 'Great']);
        Review::create(['user_id' => $u2->id, 'product_id' => $product->id, 'rating' => 3, 'title' => 'Okay']);

        $this->assertEquals(4.0, $product->averageRating());
        $this->assertEquals(2, $product->reviewCount());

        $breakdown = $product->ratingBreakdown();
        $this->assertEquals(1, $breakdown[5]['count']);
        $this->assertEquals(50, $breakdown[5]['percentage']);
        $this->assertEquals(1, $breakdown[3]['count']);
        $this->assertEquals(50, $breakdown[3]['percentage']);
    }
}
