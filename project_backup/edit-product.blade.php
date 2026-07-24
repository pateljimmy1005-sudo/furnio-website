@extends('admin.layout')

@section('content')

<div class="container mt-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">
            <h4>Edit Product</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.product.update', $product->id ?? 0) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- NAME --}}
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text"
                           name="name"
                           value="{{ $product->name }}"
                           class="form-control"
                           required>
                </div>

                {{-- PRICE --}}
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number"
                           name="price"
                           value="{{ $product->price }}"
                           class="form-control"
                           required>
                </div>

                {{-- CATEGORY --}}
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category" class="form-control" required>
                        <option value="Sofa" {{ $product->category == 'Sofa' ? 'selected' : '' }}>Sofa</option>
                        <option value="Bed" {{ $product->category == 'Bed' ? 'selected' : '' }}>Bed</option>
                        <option value="Chair" {{ $product->category == 'Chair' ? 'selected' : '' }}>Chair</option>
                        <option value="Table" {{ $product->category == 'Table' ? 'selected' : '' }}>Table</option>
                    </select>
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                </div>

                {{-- IMAGE (simple text input) --}}
                <div class="mb-3">
                    <label>Image URL</label>
                    <input type="text"
                           name="image"
                           value="{{ $product->image }}"
                           class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    Update Product
                </button>

                <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection