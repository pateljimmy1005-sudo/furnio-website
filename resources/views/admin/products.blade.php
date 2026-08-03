@extends('admin.layout')

@section('content')

<div class="container-fluid mt-2 mt-md-4 px-2 px-md-3">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="card shadow-sm border-0 admin-card-standard rounded-3">
        <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center py-2 px-3 px-md-4 gap-2" style="border-bottom: 2px solid var(--theme-primary, #C06B1F);">
            <h2 class="page-title m-0 fw-bold text-uppercase text-dark align-self-start align-self-sm-center text-nowrap">Products Management</h2>
            <a href="{{ route('admin.product.create') }}" class="btn admin-btn-add shadow-sm align-self-start align-self-sm-center flex-shrink-0">
                <i class="fas fa-plus me-1"></i> Add Product
            </a>
        </div>
        <div class="card-body pt-0 p-2 p-md-4">

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

            <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                <table class="table table-hover align-middle mb-0" style="min-width: 600px;">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="width: 50px; font-size: 12px;">ID</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="width: 65px; font-size: 12px;">Image</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="font-size: 12px;">Name</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="width: 95px; font-size: 12px;">Price</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="width: 110px; font-size: 12px;">Category</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="width: 110px; font-size: 12px;">Stock</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold text-center py-2 py-md-3 px-2 px-md-3" style="width: 100px; font-size: 12px;">Status</th>
                            <th class="dash-table-th text-secondary text-uppercase fw-bold text-center py-2 py-md-3 px-2 px-md-3" style="width: 90px; font-size: 12px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr class="{{ $product->hasInvalidPrice() ? 'table-warning' : (!$product->is_active ? 'table-secondary opacity-75' : '') }}">
                        <td class="fw-semibold text-secondary py-2 py-md-3 px-2 px-md-3" style="font-size: 13px;">{{ $product->id }}</td>
                        <td class="py-2 py-md-3 px-2 px-md-3">
                            <img src="{{ $product->imageUrl() }}"
                                 alt="{{ $product->name }}"
                                 class="rounded"
                                 style="width: 42px; height: 42px; object-fit: cover; border: 1px solid #eee;">
                        </td>
                        <td class="py-2 py-md-3 px-2 px-md-3">
                            <span class="fw-bold text-dark d-block" style="font-size: 14px; line-height: 1.3;">{{ $product->name }}</span>
                            @if($product->hasInvalidPrice())
                                <span class="badge bg-danger mt-1">Price ₹0</span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark py-2 py-md-3 px-2 px-md-3" style="font-size: 14px; white-space: nowrap;">₹{{ number_format($product->price) }}</td>
                        <td class="py-2 py-md-3 px-2 px-md-3"><span class="text-secondary fw-semibold" style="font-size: 13px; white-space: nowrap;">{{ strtoupper($product->category) }}</span></td>
                        <td class="py-2 py-md-3 px-2 px-md-3">
                            @if($product->stock > 0)
                                <span class="text-dark fw-semibold" style="font-size: 13px; white-space: nowrap;">{{ $product->stock }} IN STOCK</span>
                            @else
                                <span class="badge bg-danger fw-semibold" style="font-size: 11px; white-space: nowrap;">OUT OF STOCK</span>
                            @endif
                        </td>
                        <td class="text-center py-2 py-md-3 px-2 px-md-3 text-nowrap">
                            <form action="{{ route('admin.product.toggle-status', $product->id) }}" method="POST" class="d-inline m-0">
                                @csrf
                                @method('PATCH')
                                @if($product->is_active)
                                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 py-1 fw-bold shadow-sm" style="font-size: 11px;" title="Click to Deactivate">
                                        <i class="fas fa-check-circle me-1"></i> Active
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-secondary rounded-pill px-3 py-1 fw-bold shadow-sm" style="font-size: 11px;" title="Click to Activate">
                                        <i class="fas fa-times-circle me-1"></i> Inactive
                                    </button>
                                @endif
                            </form>
                        </td>
                        <td class="text-center py-2 py-md-3 px-2 px-md-3 text-nowrap">
                            <div class="d-inline-flex align-items-center gap-3">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                   class="text-primary text-decoration-none me-2 fs-5" title="Edit Product">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.product.delete', $product->id) }}"
                                      method="POST"
                                      class="d-inline m-0 p-0"
                                      onsubmit="return confirm('Are you sure you want to delete {{ addslashes($product->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 bg-transparent text-danger fs-5" title="Delete Product">
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
