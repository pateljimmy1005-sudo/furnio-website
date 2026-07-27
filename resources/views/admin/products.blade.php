@extends('admin.layout')

@section('content')

<div class="container-fluid mt-2 mt-md-4 px-1 px-md-3">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="card shadow-sm border-0 admin-card-standard rounded-3">
        <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center py-3 px-3 px-md-4 gap-3" style="border-bottom: 2px solid var(--theme-primary, #C06B1F);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-4 fs-md-3 text-dark">Products Management</h2>
            <a href="{{ route('admin.product.create') }}" class="btn text-white px-3 px-md-4 py-2 fw-bold text-uppercase shadow-sm mt-1 mt-sm-0" style="background-color: var(--theme-primary, #C06B1F); border-radius: 6px; font-size: 13px; white-space: nowrap;">
                <i class="fas fa-plus me-1"></i> Add Product
            </a>
        </div>
        <div class="card-body p-2 p-md-4">

           @if(session('success'))
                <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <script>
                    setTimeout(function () {
                        let msg = document.getElementById('successMessage');
                        if (msg) {
                            msg.classList.remove('show');
                            setTimeout(() => msg.remove(), 300);
                        }
                    }, 3000);
                </script>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 650px;">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold" style="width: 60px; font-size: 13px;">ID</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold" style="width: 75px; font-size: 13px;">Image</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold" style="font-size: 13px;">Name</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold" style="width: 100px; font-size: 13px;">Price</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold" style="width: 120px; font-size: 13px;">Category</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold" style="width: 130px; font-size: 13px;">Stock</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold text-center" style="width: 100px; font-size: 13px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr class="{{ $product->hasInvalidPrice() ? 'table-warning' : '' }}">
                        <td class="fw-semibold text-secondary" style="font-size: 14px;">{{ $product->id }}</td>
                        <td>
                            <img src="{{ $product->imageUrl() }}"
                                 alt="{{ $product->name }}"
                                 class="rounded"
                                 style="width: 48px; height: 48px; object-fit: cover; border: 1px solid #eee;">
                        </td>
                        <td>
                            <span class="fw-bold text-dark d-block" style="font-size: 15px;">{{ $product->name }}</span>
                            @if($product->hasInvalidPrice())
                                <span class="badge bg-danger mt-1">Price ₹0</span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark" style="font-size: 15px;">₹{{ number_format($product->price) }}</td>
                        <td><span class="badge-category-pill">{{ strtoupper($product->category) }}</span></td>
                        <td>
                            @if($product->stock > 0)
                                <span class="badge-stock-pill-in">{{ $product->stock }} IN STOCK</span>
                            @else
                                <span class="badge-stock-pill-out">OUT OF STOCK</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                   class="btn-action-icon btn-action-edit" title="Edit Product">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.product.delete', $product->id) }}"
                                      method="POST"
                                      class="d-inline m-0"
                                      onsubmit="return confirm('Are you sure you want to delete {{ addslashes($product->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-icon btn-action-delete" title="Delete Product">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
