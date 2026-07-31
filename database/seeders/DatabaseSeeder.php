<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed Customer Users
        $usersData = [
            ['name' => 'Rahul Sharma', 'email' => 'rahul@gmail.com'],
            ['name' => 'Priya Patel', 'email' => 'priya@gmail.com'],
            ['name' => 'Amit Verma', 'email' => 'amit@gmail.com'],
            ['name' => 'Neha Gupta', 'email' => 'neha@gmail.com'],
            ['name' => 'Vikram Singh', 'email' => 'vikram@gmail.com'],
        ];

        $createdUsers = [];
        foreach ($usersData as $u) {
            $createdUsers[] = User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make('password123'),
                    'role' => 'user',
                    'status' => 'active',
                    'email_verified_at' => now(),
                    'phone' => '98765' . rand(10005, 99999),
                    'address' => 'Station Road, City Center, Building #' . rand(10, 99),
                ]
            );
        }

        // 3. Ensure Products exist
        $products = Product::all();
        if ($products->isEmpty()) {
            return;
        }

        // 4. Seed Real Product Reviews
        $reviewsText = [
            5 => [
                'Absolutely stunning piece! Fits perfectly in my living room and quality is top notch.',
                'Super comfortable, looks very luxurious and delivery was fast.',
                'Extremely satisfied with the build quality and premium finish.',
                'Best furniture purchase ever! Highly recommended for modern homes.',
            ],
            4 => [
                'Great quality product, looks exact like the photos on website.',
                'Very good value for money and solid wood build.',
                'Comfortable seating and smooth delivery experience.',
            ],
        ];

        foreach ($products as $product) {
            // Seed 2-3 reviews per product
            $randomUsers = collect($createdUsers)->random(rand(2, 3));
            foreach ($randomUsers as $user) {
                $rating = rand(4, 5);
                $comment = $reviewsText[$rating][array_rand($reviewsText[$rating])];

                Review::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                    ],
                    [
                        'rating' => $rating,
                        'review' => $comment,
                        'created_at' => now()->subDays(rand(1, 30)),
                    ]
                );
            }
        }

        // 5. Seed Real Orders & Order Items
        $statuses = ['Delivered', 'Delivered', 'Delivered', 'Created', 'Cancelled'];
        $paymentMethods = ['COD', 'Razorpay', 'COD'];

        foreach ($createdUsers as $user) {
            $userProducts = $products->random(rand(1, 3));
            
            $totalAmount = 0;
            $order = Order::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone ?? '9876543210',
                'address' => $user->address ?? 'Main Street, Flat 101',
                'total_amount' => 0,
                'shipping_fee' => rand(0, 1) ? 0 : 499,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'status' => $statuses[array_rand($statuses)],
                'payment_status' => 'paid',
                'created_at' => now()->subDays(rand(1, 45)),
            ]);

            foreach ($userProducts as $prod) {
                $qty = rand(1, 2);
                $unitPrice = $prod->price;
                $subtotal = $unitPrice * $qty;
                $totalAmount += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $prod->id,
                    'quantity' => $qty,
                    'price' => $unitPrice,
                    'subtotal' => $subtotal,
                ]);
            }

            $order->update([
                'total_amount' => $totalAmount + $order->shipping_fee,
            ]);
        }
    }
}
