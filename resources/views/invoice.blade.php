@extends('layouts.app')

@section('content')
<div class="invoice-page">
    <div class="invoice-container">
        <div class="invoice-header-top" style="margin-top: -30px;">
            <a href="{{ route('orders') }}" class="back-link-invoice">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <div class="invoice-actions d-flex gap-3">
                <a href="{{ route('invoice.download', $order->id) }}" class="btn-download-invoice">
                    <i class="bi bi-file-earmark-pdf"></i> Download PDF
                </a>
                <button class="btn-print-invoice" onclick="window.print()">
                    <i class="bi bi-printer"></i> Print Invoice
                </button>
            </div>
        </div>
        
        <div class="invoice-card">
            <div class="invoice-header">
                <div class="company-info">
                    <div class="company-logo-placeholder">
                        <i class="bi bi-house-door"></i>
                    </div>
                    <div class="company-details">
                        <h2>Furnio</h2>
                        <p>Premium Furniture Store</p>
                        <p>27 Main Street, City Center</p>
                        <p>Phone: +91 9099025453 | Email: furnio@gmail.com</p>
                    </div>
                </div>
                <div class="invoice-number-status">
                    <div class="invoice-number-wrapper">
                        <h3>Invoice</h3>
                        <p class="invoice-id">{{ $invoiceNumber }}</p>
                    </div>
                    <div class="order-status-badge invoice-status-{{ $order->status instanceof \UnitEnum ? $order->status->value : $order->status }}">
                        {{ ucfirst($order->status instanceof \UnitEnum ? $order->status->value : $order->status) }}
                    </div>
                </div>
            </div>
            
            <div class="invoice-info-section">
                <div class="customer-info">
                    <h4>Customer Details</h4>
                    <p><strong>Name:</strong> {{ $order->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user?->email ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Delivery Address:</strong> {{ $order->address }}</p>
                </div>
                <div class="order-info">
                    <h4>Order Details</h4>
                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                    <p><strong>Invoice Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                    <p><strong>Payment Method:</strong> {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status instanceof \UnitEnum ? $order->payment_status->value : $order->payment_status) }}</p>
                </div>
            </div>
            
            <div class="invoice-products-table">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->items->count() > 0)
                            @foreach($order->items as $item)
                            <tr>
                                <td class="product-cell">
                                    <div class="product-image-invoice">
                                        <img src="{{ $item->product?->imageUrl() }}" alt="{{ $item->product?->catalogName() }}">
                                    </div>
                                    <div class="product-name-invoice">
                                        {{ $item->product?->catalogName() ?? 'Product' }}
                                    </div>
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ number_format($item->price, 2) }}</td>
                                <td class="total-cell">₹{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        @elseif($order->legacyProduct)
                            <tr>
                                <td class="product-cell">
                                    <div class="product-image-invoice">
                                        <img src="{{ $order->legacyProduct->imageUrl() }}" alt="{{ $order->legacyProduct->catalogName() }}">
                                    </div>
                                    <div class="product-name-invoice">
                                        {{ $order->legacyProduct->catalogName() }}
                                    </div>
                                </td>
                                <td>{{ $order->quantity }}</td>
                                <td>₹{{ number_format($order->total_price, 2) }}</td>
                                <td class="total-cell">₹{{ number_format($order->total_price, 2) }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div class="invoice-total-section">
                <div class="invoice-total-wrapper">
                    <div class="total-row">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($order->total_amount ?? $order->total_price, 2) }}</span>
                    </div>
                    <div class="total-row">
                        <span>Shipping Charges</span>
                        <span>₹{{ number_format($order->shipping_fee ?? 99.00, 2) }}</span>
                    </div>
                    <div class="total-row grand-total">
                        <span>Grand Total</span>
                        <span>₹{{ number_format(($order->total_amount ?? $order->total_price) + ($order->shipping_fee ?? 99.00), 2) }}</span>
                    </div>
                </div>
            </div>
            
            <div class="invoice-footer">
                <p>Thank you for shopping with us!</p>
                <p class="invoice-footer-note">For any queries, contact us at furnio@gmaile.com</p>
            </div>
        </div>
    </div>
</div>
@endsection
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        

