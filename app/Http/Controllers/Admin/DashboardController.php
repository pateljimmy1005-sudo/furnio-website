<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::count();
        $orders = \App\Models\Order::count();
        $users = \App\Models\User::count();

        $totalRevenue = \App\Models\Order::sum('total_amount');

        $todayOrders = \App\Models\Order::whereDate('created_at', today())->count();

        $lowStockItems = \App\Models\Product::where('stock', '<=', 5)->count();

        $recentOrders = \App\Models\Order::with('items')->latest()->take(5)->get();

        $topProducts = \App\Models\Product::orderBy('stock','desc')
            ->take(5)
            ->get();

        $lowStockProducts = \App\Models\Product::where('stock', '<=', 2)
            ->get();
          
        return view('admin.dashboard', compact(
            'products',
            'orders',
            'users',
            'totalRevenue',
            'todayOrders',
            'lowStockItems',
            'recentOrders',
            'topProducts',
            'lowStockProducts'
        ));
    }
}
