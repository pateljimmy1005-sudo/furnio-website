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

            <table class="product-list">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->product ? $order->product->name : 'Product Unavailable' }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>₹{{ number_format($order->total_price, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Shipping:</strong></td>
                        <td>₹99.00</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Grand Total:</strong></td>
                        <td><strong>₹{{ number_format($order->total_price + 99, 2) }}</strong></td>
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
