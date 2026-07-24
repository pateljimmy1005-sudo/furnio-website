@extends('admin.layout')

@section('content')

<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn m-0 d-inline-block">← Back</a>
    </div>

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-center py-3 gap-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-3 text-center text-sm-start text-break">Products Management</h2>
            <a href="{{ route('admin.product.create') }}" class="add-btn admin-extracted-style-16 text-center px-3 px-sm-4 py-1 py-sm-2" style="font-size: 14px; border-radius: 6px;">
                <i class="fas fa-plus me-1"></i> Add Product
            </a>
        </div>
        <div class="card-body p-4">

           @if(session('success'))
    <div id="successMessage" class="alert alert-success">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function () {
            let msg = document.getElementById('successMessage');
            if (msg) {
                msg.classList.add('fade-out');
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000);
    </script>
@endif

        
            <div class="table-responsive"><table class="table table-hover align-middle mb-0">
                <tr>
                    <th class="dash-table-th">ID</th>
                    <th class="dash-table-th">Image</th>
                    <th class="dash-table-th">Name</th>
                    <th class="dash-table-th">Price</th>
                    <th class="dash-table-th">Category</th>
                    <th class="dash-table-th">Stock</th>
                    <th class="dash-table-th">Action</th>
                </tr>

                @foreach($products as $product)

                <tr class="{{ $product->hasInvalidPrice() ? 'table-warning' : '' }}">

                    <td>{{ $product->id }}</td>

                    <td>
                        <img src="{{ $product->imageUrl() }}"
                             alt="{{ $product->name }}"
                             class="product-img-thumb">
                    </td>

                    <td>
                        {{ $product->name }}
                        @if($product->hasInvalidPrice())
                            <span class="badge bg-danger">Price ₹0</span>
                        @endif
                    </td>

                    <td>₹{{ number_format($product->price) }}</td>

                    <td>{{ $product->category }}</td>
                    
                    <td>
                        @if($product->stock > 0)
                            <span >{{ $product->stock }} in stock</span>
                        @else
                            <span class="admin-out-of-stock">Out of Stock</span>
                        @endif
                    </td>

                    <td>

                        <div class="action-group">

                            <a href="{{ route('admin.product.edit', $product->id) }}"
                               class="action-btn edit-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.product.delete', $product->id) }}"
                                  method="POST"
                                  class="delete-form"
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">

                                @csrf
                                @method('DELETE')

                                <button class="action-btn delete-btn" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @endforeach

            </table></div>

        </div>

    </div>

</div>
@endsection
