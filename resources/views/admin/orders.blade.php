@extends('admin.layout')

@section('content')



<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

@if(session('success'))
    <div id="adminSuccessAlert" class="alert alert-success admin-alert-success">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function () {
            let msg = document.getElementById('adminSuccessAlert');
            if (msg) {
                msg.classList.add('fade-out');
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000); // 3 seconds
    </script>
@endif

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex justify-content-start align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase text-start text-break">All Orders</h2>
        </div>

        <div class="card-body p-3 p-md-4">

            <form action="{{ route('admin.orders') }}" method="GET" class="d-flex mb-3 admin-search-form w-100 mx-auto mx-sm-0">
                <input type="text"
                       name="search"
                       id="searchInput"
                       class="search-box form-control"
                       placeholder="Search customer..."
                       value="{{ request('search') }}">
            </form>



            <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                <table class="table table-hover align-middle mb-0 order-table" id="orderTable" style="min-width: 820px;">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="width: 50px; font-size: 12px;">ID</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 120px; font-size: 12px;">Customer</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 110px; font-size: 12px;">Phone</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 130px; font-size: 12px;">Address</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 100px; font-size: 12px;">Price</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 130px; font-size: 12px;">Status</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 100px; font-size: 12px;">Date</th>
                            <th class="text-secondary text-uppercase fw-bold text-center py-2 py-md-3 px-2 px-md-3" style="width: 80px; font-size: 12px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="fw-semibold text-secondary py-2 py-md-3 px-2 px-md-3" style="font-size: 13px;">{{ $order->id }}</td>
                            <td class="fw-bold text-dark py-2 py-md-3 px-2 px-md-3" style="font-size: 14px;">{{ $order->name }}</td>
                            <td class="py-2 py-md-3 px-2 px-md-3" style="font-size: 13.5px;">{{ $order->phone }}</td>
                            <td class="py-2 py-md-3 px-2 px-md-3" style="font-size: 13.5px;">{{ $order->address }}</td>
                            <td class="fw-bold text-dark py-2 py-md-3 px-2 px-md-3" style="font-size: 14px;">₹{{ number_format($order->total_amount ?? $order->total_price, 2) }}</td>
                            <td class="py-2 py-md-3 px-2 px-md-3" style="min-width: 130px;">
                                <form action="{{ route('admin.order.update-status', $order->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm fw-bold shadow-sm status-select-fixed" style="border: 1.5px solid #d1d5db; border-radius: 6px; font-size: 13px; min-width: 115px; width: 115px;" onchange="this.form.submit()">
                                        <option value="Created" {{ $order->status === \App\Enums\OrderStatus::CREATED || $order->status === \App\Enums\OrderStatus::PENDING ? 'selected' : '' }}>Created</option>
                                        <option value="Delivered" {{ $order->status === \App\Enums\OrderStatus::DELIVERED ? 'selected' : '' }}>Delivered</option>
                                        <option value="Cancelled" {{ $order->status === \App\Enums\OrderStatus::CANCELLED ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>

                        <td class="py-2 py-md-3 px-2 px-md-3" style="font-size: 13px;">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        <td class="text-center py-2 py-md-3 px-2 px-md-3">
                            <div class="action-buttons d-flex justify-content-center">
                                <form action="{{ route('admin.order.delete', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table></div>

        </div>

    </div>

</div>

@endsection

