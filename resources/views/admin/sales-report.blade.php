@extends('admin.layout')

@section('content')

<div class="order-page">

    <a href="{{ route('admin.dashboard') }}" class="dashboard-btn mb-4"><i class="fas fa-arrow-left"></i> Back</a>

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex justify-content-center justify-content-sm-start align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-3 text-center text-sm-start text-break">Sales Report Filters</h2>
        </div>

        <div class="card-body p-3 p-md-4 ">
            <form action="{{ route('admin.sales-report') }}" method="GET" class="d-flex flex-column flex-md-row gap-3 align-items-md-end mb-4">
                <div class="w-100 w-md-auto">
                    <label for="start_date" class="form-label mb-1">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control w-100" value="{{ $startDate ?? '' }}">
                </div>
                <div class="w-100 w-md-auto">
                    <label for="end_date" class="form-label mb-1">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control w-100" value="{{ $endDate ?? '' }}">
                </div>
                <div class="w-100 w-md-auto d-flex gap-2">
                    <button type="submit" class="btn10 btn-secondary text-white w-100 w-md-auto text-center">Filter</button>
                    <a href="{{ route('admin.sales-report') }}" class="bttn btn-secondary text-white w-100 w-md-auto text-center">Clear</a>
                </div>
            </form>

            <div class="row g-3 mb-2">
                <div class="col-md-4">
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <h5 class="text-muted mb-2">Total Revenue</h5>
                            <h3 class="mb-0 fw-bold">₹{{ number_format($totalRevenue, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <h5 class="text-muted mb-2">Total Orders</h5>
                            <h3 class="mb-0 fw-bold">{{ $totalOrders }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border-0 shadow-sm">
                        <div class="card-body text-center py-4">
                            <h5 class="text-muted mb-2">Items Sold</h5>
                            <h3 class="mb-0 fw-bold">{{ $totalItemsSold }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex justify-content-center justify-content-sm-start align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-3 text-center text-sm-start text-break">Sales Details</h2>
        </div>
        <div class="card-body p-3 p-md-4">
            <div class="table-responsive"><table class="table table-hover align-middle mb-0" id="orderTable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>
                            @if($order->status === 'Delivered')
                                <span class="badge bg-success">Delivered</span>
                            @elseif($order->status === 'Cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @else
                                <span class="badge text-dark">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        <td class="fw-bold">₹{{ number_format($order->total_amount ?? $order->total_price, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No sales found for the selected period.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table></div>

            <div class="row mt-4">
                <div class="col-12 pagination-wrapper">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection




