<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice {{ $invoiceNumber }}</title>
    <style>
        @page {
            margin: 25px 35px;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif, Helvetica, Arial;
            font-size: 13px;
            color: #333333;
            line-height: 1.5;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border-bottom: 2px solid #426B90;
            padding-bottom: 15px;
        }
        .header-table td {
            vertical-align: top;
        }
        .company-brand h1 {
            font-size: 26px;
            color: #1A1A1A;
            margin: 0 0 5px 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .company-brand p {
            margin: 2px 0;
            color: #666666;
            font-size: 11px;
        }
        .invoice-title {
            text-align: right;
        }
        .invoice-title h2 {
            font-size: 24px;
            color: #426B90;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .invoice-number-text {
            font-size: 14px;
            font-weight: bold;
            color: #1A1A1A;
            margin: 0 0 5px 0;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 12px;
            background-color: #e2e8f0;
            color: #334155;
        }
        .status-badge.status-created, .status-badge.status-completed, .status-badge.status-delivered {
            background-color: #dcfce7;
            color: #15803d;
        }
        .status-badge.status-pending, .status-badge.status-processing {
            background-color: #fef9c3;
            color: #a16207;
        }
        .status-badge.status-cancelled {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .details-table td {
            width: 50%;
            vertical-align: top;
            padding: 0 10px 0 0;
        }
        .details-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 14px;
        }
        .details-box h3 {
            font-size: 13px;
            color: #426B90;
            margin: 0 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px dashed #cbd5e1;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .details-box p {
            margin: 4px 0;
            font-size: 11px;
            line-height: 1.4;
        }
        .details-box p strong {
            color: #1e293b;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background-color: #426B90;
            color: #ffffff;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px;
            text-align: left;
            border: 1px solid #426B90;
        }
        .items-table th.text-right, .items-table td.text-right {
            text-align: right;
        }
        .items-table th.text-center, .items-table td.text-center {
            text-align: center;
        }
        .items-table td {
            padding: 10px;
            font-size: 11px;
            border-bottom: 1px solid #e2e8f0;
            border-left: 1px solid #f1f5f9;
            border-right: 1px solid #f1f5f9;
        }
        .items-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .totals-table td.blank-space {
            width: 55%;
        }
        .totals-table td.totals-content {
            width: 45%;
        }
        .totals-box {
            width: 100%;
            border-collapse: collapse;
        }
        .totals-box td {
            padding: 6px 10px;
            font-size: 11px;
        }
        .totals-box td.label {
            text-align: left;
            color: #475569;
        }
        .totals-box td.value {
            text-align: right;
            font-weight: bold;
            color: #1e293b;
        }
        .totals-box tr.grand-total td {
            border-top: 2px solid #426B90;
            border-bottom: 2px solid #426B90;
            padding: 10px;
            font-size: 13px;
        }
        .totals-box tr.grand-total td.label {
            color: #1e293b;
            font-weight: bold;
        }
        .totals-box tr.grand-total td.value {
            color: #426B90;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
            text-align: center;
            font-size: 10px;
            color: #64748b;
        }
        .footer p {
            margin: 3px 0;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <table class="header-table">
        <tr>
            <td class="company-brand">
                <h1>Furnio</h1>
                <p><strong>Furnio Furniture Ltd.</strong></p>
                <p>27 Main Street, City Center</p>
                <p>Phone: +91 9099025453 | Email: furnio@gmail.com</p>
            </td>
            <td class="invoice-title">
                <h2>INVOICE</h2>
                <div class="invoice-number-text">{{ $invoiceNumber }}</div>
                <p style="margin: 2px 0 6px 0; font-size: 11px; color: #64748b;">
                    Date: {{ $order->created_at ? $order->created_at->format('d M Y') : date('d M Y') }}
                </p>
                @php
                    $statusVal = $order->status instanceof \UnitEnum ? $order->status->value : $order->status;
                @endphp
                <span class="status-badge status-{{ strtolower($statusVal) }}">
                    {{ ucfirst($statusVal) }}
                </span>
            </td>
        </tr>
    </table>

    <!-- Billing & Order Details -->
    <table class="details-table">
        <tr>
            <td>
                <div class="details-box">
                    <h3>Customer Information</h3>
                    <p><strong>Customer Name:</strong> {{ $order->name ?? $order->user?->name ?? 'Customer' }}</p>
                    <p><strong>Email:</strong> {{ $order->user?->email ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                    <p><strong>Billing / Shipping Address:</strong> {{ $order->address ?? 'N/A' }}</p>
                </div>
            </td>
            <td style="padding-right: 0; padding-left: 10px;">
                <div class="details-box">
                    <h3>Order Information</h3>
                    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                    <p><strong>Order Date:</strong> {{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : 'N/A' }}</p>
                    <p><strong>Payment Method:</strong> {{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}</p>
                    @php
                        $payStatus = $order->payment_status instanceof \UnitEnum ? $order->payment_status->value : $order->payment_status;
                    @endphp
                    <p><strong>Payment Status:</strong> {{ ucfirst($payStatus ?? 'pending') }}</p>
                </div>
            </td>
        </tr>
    </table>

    <!-- Line Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 50%;">Product Details</th>
                <th class="text-center" style="width: 15%;">Quantity</th>
                <th class="text-right" style="width: 15%;">Price</th>
                <th class="text-right" style="width: 15%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $itemIndex = 1;
                $computedSubtotal = 0;
            @endphp

            @if($order->relationLoaded('items') && $order->items->count() > 0)
                @foreach($order->items as $item)
                    @php
                        $lineSubtotal = $item->subtotal ?? ($item->price * $item->quantity);
                        $computedSubtotal += $lineSubtotal;
                        $productName = $item->product ? ($item->product->catalogName() ?? $item->product->name) : 'Product Item';
                    @endphp
                    <tr>
                        <td class="text-center">{{ $itemIndex++ }}</td>
                        <td>
                            <strong>{{ $productName }}</strong>
                        </td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                        <td class="text-right">₹{{ number_format($lineSubtotal, 2) }}</td>
                    </tr>
                @endforeach
            @elseif($order->legacyProduct)
                @php
                    $lineSubtotal = $order->total_price ?? ($order->total_amount ?? 0);
                    $computedSubtotal = $lineSubtotal;
                    $productName = $order->legacyProduct->catalogName() ?? $order->legacyProduct->name;
                    $price = $order->quantity > 0 ? ($lineSubtotal / $order->quantity) : $lineSubtotal;
                @endphp
                <tr>
                    <td class="text-center">1</td>
                    <td>
                        <strong>{{ $productName }}</strong>
                    </td>
                    <td class="text-center">{{ $order->quantity ?? 1 }}</td>
                    <td class="text-right">₹{{ number_format($price, 2) }}</td>
                    <td class="text-right">₹{{ number_format($lineSubtotal, 2) }}</td>
                </tr>
            @else
                @php
                    $computedSubtotal = $order->total_amount ?? $order->total_price ?? 0;
                @endphp
                <tr>
                    <td class="text-center">1</td>
                    <td><strong>Furniture Purchase</strong></td>
                    <td class="text-center">1</td>
                    <td class="text-right">₹{{ number_format($computedSubtotal, 2) }}</td>
                    <td class="text-right">₹{{ number_format($computedSubtotal, 2) }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Totals Summary -->
    @php
        $subtotal = $order->total_amount ?? $computedSubtotal;
        $shipping = $order->shipping_fee ?? 99.00;
        $tax = 0.00; // Tax is included in product prices or 0.00
        $grandTotal = $subtotal + $tax + $shipping;
    @endphp

    <table class="totals-table">
        <tr>
            <td class="blank-space"></td>
            <td class="totals-content">
                <table class="totals-box">
                    <tr>
                        <td class="label">Subtotal:</td>
                        <td class="value">₹{{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tax (Included):</td>
                        <td class="value">₹{{ number_format($tax, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Shipping Charges:</td>
                        <td class="value">₹{{ number_format($shipping, 2) }}</td>
                    </tr>
                    <tr class="grand-total">
                        <td class="label">Grand Total:</td>
                        <td class="value">₹{{ number_format($grandTotal, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Thank you for your business!</strong></p>
        <p>For support or inquiries regarding this invoice, please email <strong>furnio@gmail.com</strong> or call <strong>+91 9099025453</strong>.</p>
        <p>&copy; {{ date('Y') }} Furnio Furniture Store. All rights reserved.</p>
    </div>

</body>
</html>
