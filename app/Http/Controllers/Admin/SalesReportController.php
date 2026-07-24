<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Order::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(), 
                Carbon::parse($endDate)->endOfDay()
            ]);
        } elseif ($startDate) {
            $query->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        } elseif ($endDate) {
            $query->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        // Calculate totals based on the filtered query
        $totalRevenue = $query->sum(\DB::raw('COALESCE(total_amount, total_price, 0)'));
        $totalOrders = $query->count();
        
        $orderIds = $query->pluck('id');
        $totalItemsSold = \App\Models\OrderItem::whereIn('order_id', $orderIds)->sum('quantity');

        // Get the paginated list of orders
        $orders = $query->with('items.product.featuredImage')->latest()->paginate(20)->withQueryString();

        return view('admin.sales-report', compact(
            'orders', 
            'totalRevenue', 
            'totalOrders', 
            'totalItemsSold',
            'startDate',
            'endDate'
        ));
    }
}
