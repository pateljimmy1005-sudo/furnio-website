@extends('admin.layout')

@section('content')

<style>
    /* Completely disable card lift, movement, and transforms on hover */
    .card,
    .card:hover,
    .admin-card-standard,
    .admin-card-standard:hover,
    .admin-section-card,
    .admin-section-card:hover,
    .dashboard-btn,
    .dashboard-btn:hover,
    .admin-btn-primary,
    .admin-btn-primary:hover,
    .admin-btn-secondary,
    .admin-btn-secondary:hover,
    .admin-form-input,
    .admin-form-input:hover,
    .admin-form-select,
    .admin-form-select:hover,
    .admin-form-textarea,
    .admin-form-textarea:hover,
    div,
    div:hover {
        transform: none !important;
        transition: none !important;
        animation: none !important;
    }
</style>

<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.products') }}" class="dashboard-btn"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase text-start text-break">Add Product</h2>
        </div>
        <div class="card-body p-2 p-md-4 ">

            @if ($errors->any())
                <div class="admin-alert-error mb-4">
                    <ul class="admin-extracted-style-4 m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <!-- Left Column: Main Product Info & Image -->
                    <div class="col-lg-8">
                        <div class="admin-section-card p-3 p-md-4 h-100">
                            <h5 class="admin-section-title fs-5 fs-md-4"><i class="fas fa-info-circle me-2"></i> Product Information</h5>

                            <div class="admin-form-group mb-4">
                                <label class="admin-form-label">Product Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="admin-form-input" required>
                            </div>

                            <div class="admin-form-group mb-4">
                                <label class="admin-form-label">Description</label>
                                <textarea name="description" rows="5" class="admin-form-textarea" required>{{ old('description') }}</textarea>
                            </div>

                            <h5 class="admin-section-title mt-4 pt-2"><i class="fas fa-image me-2"></i> Product Image</h5>

                            <div class="admin-form-group mb-0">
                                <label class="admin-form-label">Upload Image</label>
                                <input type="file" name="image" class="admin-form-file" accept="image/*" required>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Settings, Pricing, Inventory -->
                    <div class="col-lg-4 d-flex flex-column gap-4">
                        
                        <!-- Category -->
                        <div class="admin-section-card p-3 p-md-4">
                            <h5 class="admin-section-title fs-5 fs-md-4"><i class="fas fa-list me-2"></i> Category</h5>
                            <div class="admin-form-group mb-0">
                                <label class="admin-form-label">Select Category</label>
                                <select name="category" class="admin-form-select" required>
                                    <option value="">Select Category</option>
                                    <option>Sofa</option>
                                    <option>Bed</option>
                                    <option>Chair</option>
                                    <option>Table</option>
                                </select>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="admin-section-card p-3 p-md-4 mb-0">
                            <h5 class="admin-section-title fs-5 fs-md-4"><i class="fas fa-tag me-2"></i> Pricing</h5>

                            <div class="admin-form-group mb-3">
                                <label class="admin-form-label">Price (₹)</label>
                                <input type="number" name="price" class="admin-form-input" placeholder="Enter product price" min="1" required>
                            </div>

                            <div class="admin-form-group mb-0">
                                <label class="admin-form-label">Discount (%)</label>
                                <input type="number" name="discount" class="admin-form-input" placeholder="Enter discount" value="0" min="0" max="100">
                            </div>
                        </div>

                        <!-- Inventory & Status -->
                        <div class="admin-section-card p-3 p-md-4 mb-0">
                            <h5 class="admin-section-title fs-5 fs-md-4"><i class="fas fa-boxes me-2"></i> Inventory & Status</h5>

                            <div class="admin-form-group mb-3">
                                <label class="admin-form-label">Stock Quantity</label>
                                <input type="number" name="stock" class="admin-form-input" placeholder="Enter stock quantity" min="0" required>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="admin-form-label">Material</label>
                                    <input type="text" name="material" class="admin-form-input" placeholder="Material" required>
                                </div>
                                <div class="col-6">
                                    <label class="admin-form-label">Color</label>
                                    <input type="text" name="color" class="admin-form-input" placeholder=" Color" required>
                                </div>
                            </div>

                            <div class="admin-form-group mb-0 pt-2 border-top">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked style="cursor: pointer; width: 40px; height: 20px;">
                                    <label class="form-check-label fw-bold text-dark ms-2" for="is_active" style="cursor: pointer;">Product Active (Visible to Customers)</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="admin-form-actions mt-4 d-flex flex-wrap justify-content-start gap-3 border-top pt-4">
                    <a href="{{ route('admin.products') }}" class="admin-btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="admin-btn-primary">
                        Save Product
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
