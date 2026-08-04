<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    protected function getFilteredQuery(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');
        $search = $request->input('search');

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

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        return $query;
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');
        $search = $request->input('search');

        $query = $this->getFilteredQuery($request);

        // Calculate totals based on the filtered query
        $totalRevenue = (clone $query)->sum(DB::raw('COALESCE(total_amount, total_price, 0)'));
        $totalOrders = (clone $query)->count();
        
        $orderIds = (clone $query)->pluck('id');
        $totalItemsSold = \App\Models\OrderItem::whereIn('order_id', $orderIds)->sum('quantity');

        // Get the paginated list of orders
        $orders = (clone $query)->with(['items.product.featuredImage', 'user'])
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.sales-report', compact(
            'orders', 
            'totalRevenue', 
            'totalOrders', 
            'totalItemsSold',
            'startDate',
            'endDate',
            'status',
            'search'
        ));
    }

    public function exportCsv(Request $request)
    {
        try {
            $query = $this->getFilteredQuery($request);

            $filename = 'sales-report-' . now()->format('Y-m-d') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0',
            ];

            $callback = function () use ($query) {
                $file = fopen('php://output', 'w');

                // Add UTF-8 BOM for Microsoft Excel / Google Sheets compatibility
                fputs($file, "\xEF\xBB\xBF");

                // CSV Headers
                fputcsv($file, [
                    'Order ID',
                    'Customer Name',
                    'Customer Email',
                    'Order Date',
                    'Total Amount',
                    'Payment Method',
                    'Payment Status',
                    'Order Status',
                ]);

                // Chunk records to prevent memory exhaustion
                $query->with('user')->latest()->chunk(200, function ($orders) use ($file) {
                    foreach ($orders as $order) {
                        $orderStatus = is_object($order->status) ? $order->status->value : ($order->status ?? 'Pending');
                        $paymentStatus = is_object($order->payment_status) ? $order->payment_status->value : ($order->payment_status ?? 'Pending');
                        $customerEmail = $order->user->email ?? 'N/A';
                        $customerName = $order->name ?? ($order->user->name ?? 'N/A');
                        $amount = number_format((float)($order->total_amount ?? $order->total_price ?? 0), 2, '.', '');
                        $orderDate = $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : 'N/A';
                        $paymentMethod = $order->payment_method ?? 'COD';

                        fputcsv($file, [
                            $order->id,
                            $customerName,
                            $customerEmail,
                            $orderDate,
                            $amount,
                            $paymentMethod,
                            $paymentStatus,
                            $orderStatus,
                        ]);
                    }
                });

                fclose($file);
            };

            return response()->streamDownload($callback, $filename, $headers);
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to export CSV: ' . $e->getMessage());
        }
    }
}
