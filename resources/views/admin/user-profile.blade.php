@extends('admin.layout')

@section('content')

<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.users') }}" class="dashboard-btn"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-3">User Profile</h2>
        </div>
        <div class="card-body p-4">

        <div class="admin-profile-header mb-5 border-bottom pb-3 d-flex align-items-center gap-3">
            <h3 class="admin-profile-name mb-0">
                {{ $user->name }}
            </h3>
            <span class="dash-badge px-3 py-1 rounded-pill text-uppercase admin-extracted-style-18" >
                {{ ucfirst($user->role) }}
            </span>
        </div>

        <div class="admin-profile-details">
            <div class="mb-4">
                <strong class="admin-profile-label d-block text-muted mb-1">Email Address:</strong>
                <div class="admin-profile-value fs-5">{{ $user->email }}</div>
            </div>

            <div class="mb-4">
                <strong class="admin-profile-label d-block text-muted mb-1">Account Status:</strong>
                <div class="admin-profile-status fs-5">
                    @if($user->status == 'blocked')
                        <span class="text-danger font-weight-bold admin-profile-status-text">Blocked</span>
                    @else
                        <span class="text-success font-weight-bold admin-profile-status-text">Active</span>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <strong class="admin-profile-label d-block text-muted mb-1">Date Joined:</strong>
                <div class="admin-profile-value fs-5">{{ $user->created_at ? $user->created_at->format('d M Y H:i') : 'N/A' }}</div>
            </div>

            @if($user->last_login)
            <div class="mb-4">
                <strong class="admin-profile-label d-block text-muted mb-1">Last Login:</strong>
                <div class="admin-profile-value fs-5">{{ $user->last_login->format('d M Y H:i') }}</div>
            </div>
            @endif
        </div>

        </div>
    </div>
</div>
@endsection