@extends('admin.layout')

@section('content')

<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn m-0 d-inline-block">← Back</a>
    </div>
    

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
        }, 3000); // 3 seconds
    </script>
@endif

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex justify-content-center justify-content-sm-start align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-3 text-center text-sm-start text-break">Reviews Management</h2>
        </div>
        <div class="card-body p-3 p-md-4">
            @if($reviews->isEmpty())
                <div class="admin-empty-contacts">
                    <p class="admin-empty-contacts-text">No reviews found.</p>
                </div>
            @else
                <div class="table-responsive"><table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Product Name</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->user->name ?? 'N/A' }}</td>
                            <td>{{ $review->product->name ?? 'N/A' }}</td>
                            <td>{{ $review->rating }} / 5</td>
                            <td>{{ Str::limit($review->review, 50) }}</td>
                            <td>{{ $review->created_at->format('d M Y H:i') }}</td>
                            <td>
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
                </table></div>
            @endif
        </div>
    </div>
</div>

@endsection

