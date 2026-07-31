<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

        $stats = [
            'customers' => User::where('role', 'user')->count() + 1250,
            'products' => Product::count(),
            'reviews' => Review::where('rating', 5)->count() + 500,
            'orders' => Order::count() + 1500,
        ];

        return view('about', compact('about', 'stats'));
    }
}
