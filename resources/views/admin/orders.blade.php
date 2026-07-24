@extends('admin.layout')

@section('content')



<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn m-0 d-inline-block">← Back</a>
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
        <div class="card-header bg-white d-flex justify-content-center justify-content-sm-start align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-3 text-center text-sm-start text-break">All Orders</h2>
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



            <div class="table-responsive"><table class="order-table"
                   id="orderTable">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>

                    </tr>

                </thead>



                <tbody>

                    @foreach($orders as $order)

                    <tr>

                        <td>{{ $order->id }}</td>

                        <td>{{ $order->name }}</td>

                        <td>{{ $order->phone }}</td>

                        <td>{{ $order->address }}</td>

                        <td>₹{{ number_format($order->total_amount ?? $order->total_price, 2) }}</td>

                        <td>
                            <form action="{{ route('admin.order.update-status', $order->id) }}" method="POST">
                                @csrf
                                <select name="status" class="form-select form-select-sm status-dropdown" onchange="this.form.submit()">
                                    <option value="Created" {{ $order->status === \App\Enums\OrderStatus::CREATED || $order->status === \App\Enums\OrderStatus::PENDING ? 'selected' : '' }}>Created</option>
                                    <option value="Delivered" {{ $order->status === \App\Enums\OrderStatus::DELIVERED ? 'selected' : '' }}>Delivered</option>
                                    <option value="Cancelled" {{ $order->status === \App\Enums\OrderStatus::CANCELLED ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>

                        <td>
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                        <td>
                            <div class="action-buttons">
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

