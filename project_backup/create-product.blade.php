@extends('admin.layout')

@section('content')

<div class="card shadow border-0">

    <div class="card-header">
        <h3>Add Product</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.product.store') }}"
              method="POST">

            @csrf

            {{-- PRODUCT NAME --}}
            <div class="mb-3">

                <label>Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Enter product name">

            </div>

            {{-- PRICE --}}
            <div class="mb-3">

                <label>Price</label>

                <input type="number"
                       name="price"
                       class="form-control"
                       placeholder="Enter product price">

            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-3">

                <label>Description</label>

                <textarea name="description"
                          class="form-control"
                          rows="4"
                          placeholder="Enter product description"></textarea>

            </div>

            {{-- CATEGORY --}}
            <div class="mb-3">

                <label>Category</label>

                <select name="category"
                        class="form-control">

                    <option value="">Select Category</option>

                    <option>Sofa</option>
                    <option>Bed</option>
                    <option>Chair</option>
                    <option>Table</option>

                </select>

            </div>

            {{-- IMAGE --}}
            <div class="mb-3">

                <label>Image</label>

                <input type="text"
                       name="image"
                       class="form-control"
                       placeholder="Example: sofa1.jpg">

            </div>

            {{-- MATERIAL --}}
            <div class="mb-3">

                <label>Material</label>

                <input type="text"
                       name="material"
                       class="form-control"
                       placeholder="Example: Wood">

            </div>

            {{-- COLOR --}}
            <div class="mb-3">

                <label>Color</label>

                <input type="text"
                       name="color"
                       class="form-control"
                       placeholder="Example: Brown">

            </div>

            {{-- STOCK --}}
            <div class="mb-3">

                <label>Stock</label>

                <input type="number"
                       name="stock"
                       class="form-control"
                       placeholder="Enter stock quantity">

            </div>

            {{-- DISCOUNT --}}
            <div class="mb-3">

                <label>Discount (%)</label>

                <input type="number"
                       name="discount"
                       class="form-control"
                       placeholder="Enter discount">

            </div>

            {{-- BUTTON --}}
            <button class="btn btn-success">

                Save Product

            </button>

        </form>

    </div>

</div>

@endsection