<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $order = Order::with(['items.product.featuredImage', 'legacyProduct.featuredImage', 'user'])->findOrFail($id);
        
        if (Auth::user()->id !== $order->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        
        $invoiceNumber = 'INV-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
        
        return view('invoice', compact('order', 'invoiceNumber'));
    }

    public function download($id)
    {
        $order = Order::with(['items.product.featuredImage', 'legacyProduct.featuredImage', 'user'])->findOrFail($id);
        
        if (Auth::user()->id !== $order->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        
        $invoiceNumber = 'INV-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', compact('order', 'invoiceNumber'));
        return $pdf->download($invoiceNumber . '.pdf');
    }
}
