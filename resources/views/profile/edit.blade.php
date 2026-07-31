@extends('layouts.app')

@section('content')
<div class="profile-page">
<div class="container my-5">
        <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="back-btn" style="display: inline-block; margin-top: -30px; margin-bottom: 20px;">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        <div class="profile-header" style="text-align: center; width: 100%;">
            <h1>My Profile</h1>
            <p>Manage your account settings and preferences</p>
        </div>

        <div class="profile-grid">
            <!-- Left Column: Profile Card & Delete Account -->
            <div class="profile-left-col">
                <div class="profile-card">
                    <div class="profile-pic-section">
                        @if($user->profile_photo)
                            <img src="{{ asset($user->profile_photo) }}" alt="Profile Photo" class="profile-pic">
                        @else
                            <div class="profile-pic-placeholder">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <h2>{{ $user->name }}</h2>
                        <p class="user-email">{{ $user->email }}</p>
                        <p class="user-since">Member since {{ $user->created_at->format('M, Y') }}</p>
                    </div>

                    <div class="quick-links">
                        <a href="{{ route('orders') }}" class="quick-link">
                            <div class="quick-link-icon">
                                <i class="bi bi-bag-check"></i>
                            </div>
                            <div class="quick-link-text">
                                <strong>{{ $totalOrders }}</strong>
                                <span>Orders</span>
                            </div>
                        </a>
                        <a href="{{ route('wishlist') }}" class="quick-link">
                            <div class="quick-link-icon">
                                <i class="bi bi-heart"></i>
                            </div>
                            <div class="quick-link-text">
                                <strong>{{ \App\Models\Wishlist::where('user_id', $user->id)->count() }}</strong>
                                <span>Wishlist</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="profile-section">
                    <h3><i class="bi bi-exclamation-triangle"></i> Delete Account</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Right Column: Profile Info & Password -->
            <div class="profile-right-col">
                <div class="profile-section">
                    <h3><i class="bi bi-person-lines-fill"></i> Profile Information</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="profile-section">
                    <h3><i class="bi bi-shield-lock"></i> Password</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
