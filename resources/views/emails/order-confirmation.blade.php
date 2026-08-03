<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #000;
            color: #ffcc00;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            color: #333;
        }
        .content p {
            font-size: 17px;
            line-height: 1.6;
        }
        .order-details {
            background-color: #f9f9f9;
            border-left: 4px solid #426B90;
            padding: 15px;
            margin: 20px 0;
        }
        .order-details h3 {
            margin-top: 0;
            color: #426B90;
        }
        .product-list {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .product-list th, .product-list td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .product-list th {
            background-color: #f1f1f1;
        }
        .footer {
            background-color: #426B90;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 17px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>FURNIO</h1>
        </div>
        <div class="content">
            <p>Dear {{ $order->name }},</p>
            <p>Thank you for your purchase! We are thrilled to confirm that your order has been placed successfully.</p>
            
            <div class="order-details">
                <h3>Order Summary</h3>
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p><strong>Shipping Address:</strong> {{ $order->address }}</p>
            </div>

            <p style="background-color: #e0f2fe; border-left: 4px solid #0284c7; padding: 12px 15px; border-radius: 4px; color: #0369a1; font-size: 15px; margin: 20px 0;">
                📎 <strong>Invoice Attached:</strong> Your official invoice PDF has been attached to this email for your reference and records.
            </p>

            <table class="product-list">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                    @endphp
                    @if($order->relationLoaded('items') && $order->items->count() > 0)
                        @foreach($order->items as $item)
                            @php
                                $itemSubtotal = $item->subtotal ?? ($item->price * $item->quantity);
                                $subtotal += $itemSubtotal;
                            @endphp
                            <tr>
                                <td>{{ $item->product ? ($item->product->catalogName() ?? $item->product->name) : 'Product Item' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ number_format($itemSubtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    @elseif($order->legacyProduct)
                        @php
                            $subtotal = $order->total_price ?? ($order->total_amount ?? 0);
                        @endphp
                        <tr>
                            <td>{{ $order->legacyProduct->catalogName() ?? $order->legacyProduct->name }}</td>
                            <td>{{ $order->quantity ?? 1 }}</td>
                            <td>₹{{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @else
                        @php
                            $subtotal = $order->total_amount ?? $order->total_price ?? 0;
                        @endphp
                        <tr>
                            <td>Furniture Purchase</td>
                            <td>1</td>
                            <td>₹{{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @endif
                    
                    @php
                        $shipping = $order->shipping_fee ?? 99.00;
                        $grandTotal = $subtotal + $shipping;
                    @endphp
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Subtotal:</strong></td>
                        <td>₹{{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Shipping Fee:</strong></td>
                        <td>₹{{ number_format($shipping, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Grand Total:</strong></td>
                        <td><strong>₹{{ number_format($grandTotal, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
            
            <p style="margin-top: 30px;">We will notify you once your order is shipped.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Furnio Furniture. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
