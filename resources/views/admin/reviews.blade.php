@extends('admin.layout')

@section('content')

<style>
    .admin-reviews-search {
        max-width: 350px;
        width: 100%;
    }
    .admin-reviews-search .form-control {
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #d1d5db;
    }
    .admin-reviews-search .form-control:focus {
        border-color: var(--theme-primary, #C06B1F);
        box-shadow: none;
    }
</style>

<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    
    @if(session('success'))
        <div id="successMessage" class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex justify-content-start align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase text-start text-break">Reviews Management</h2>
        </div>
        <div class="card-body p-3 p-md-4">
            
            <!-- SEARCH BAR -->
            <form action="{{ route('admin.reviews') }}" method="GET" class="mb-3 admin-reviews-search">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           id="searchInput"
                           class="form-control"
                           placeholder="Search user, product, or review..."
                           value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('admin.reviews') }}" class="btn btn-outline-secondary border-start-0" title="Clear Search"><i class="fas fa-times"></i></a>
                    @endif
                </div>
            </form>

            @if($reviews->isEmpty())
                <div class="admin-empty-contacts py-4 text-center">
                    <p class="admin-empty-contacts-text text-secondary mb-0">No reviews found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Product Name</th>
                                <th>Rating</th>
                                <th>Review</th>
                                <th class="text-nowrap">Date</th>
                                <th class="text-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr>
                                <td>#{{ $review->id }}</td>
                                <td class="fw-semibold">{{ $review->user->name ?? 'N/A' }}</td>
                                <td>{{ $review->product->name ?? 'N/A' }}</td>
                                <td class="text-nowrap">
                                    <span class="badge bg-warning text-dark"><i class="fas fa-star text-dark me-1"></i>{{ $review->rating }} / 5</span>
                                </td>
                                <td>
                                    @if($review->title)
                                        <div class="fw-bold small">{{ $review->title }}</div>
                                    @endif
                                    <div class="text-secondary small">{{ Str::limit($review->review, 60) }}</div>
                                </td>
                                <td class="text-nowrap small text-muted">{{ $review->created_at ? $review->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td class="text-nowrap">
                                    <form action="{{ route('admin.review.delete', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?')" class="admin-form-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn delete-btn" type="submit" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="row mt-4">
                    <div class="col-12 pagination-wrapper">
                        {{ $reviews->appends(['search' => $search])->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
