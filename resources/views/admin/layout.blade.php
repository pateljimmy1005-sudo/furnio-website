<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furnio Admin</title>
    <link href="{{ asset('css/style.css?v=' . time()) }}" rel="stylesheet">        

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css?v=' . time()) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts: Roboto for Body, Nunito for Headings -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body, p, span, a, div, li, input, button, textarea, select {
            font-family: 'Roboto', sans-serif !important;
        }
        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .page-title, .section-title, .hero-title-shadow {
            font-family: 'Nunito', sans-serif !important;
        }
        /* Ensure font weights look good */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700 !important;
        }
    </style>

</head>

<body>

<!-- Mobile Header (Visible only on mobile) -->
<div class="mobile-admin-header">
    <h3 class="m-0 text-white">FURNIO ADMIN</h3>
    <button class="mobile-toggle-btn" onclick="toggleAdminSidebar()">
        <i class="fas fa-bars"></i>
    </button>
</div>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleAdminSidebar()"></div>

<div class="sidebar" id="adminSidebar">

    <!-- Close button for mobile -->
    <div class="sidebar-close-btn" onclick="toggleAdminSidebar()">
        <i class="fas fa-times"></i>
    </div>

    <h3 class="text-white mb-4 sidebar-desktop-title">
        FURNIO ADMIN
    </h3>

    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" >
        <i class="fas fa-home me-2"></i> Dashboard
    </a>

    <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products') || request()->routeIs('admin.product.*') ? 'active' : '' }}" >
        <i class="fas fa-list-alt me-2"></i> Products
    </a>

    <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}" >
        <i class="fas fa-shopping-cart me-2"></i> Orders
    </a>

    <a href="{{ route('admin.sales-report') }}" class="{{ request()->routeIs('admin.sales-report') ? 'active' : '' }}" >
        <i class="fas fa-chart-line me-2"></i> Sales Reports
    </a>

    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') || request()->routeIs('admin.user.*') ? 'active' : '' }}" >
        <i class="fas fa-users me-2"></i> Users
    </a>

    <a href="{{ route('admin.contacts') }}" class="{{ request()->routeIs('admin.contacts') ? 'active' : '' }}" >
        <i class="fas fa-headset me-2"></i> Contacts
    </a>

    <a href="{{ route('admin.reviews') }}" class="{{ request()->routeIs('admin.reviews') ? 'active' : '' }}" >
        <i class="fas fa-star me-2"></i> Reviews
    </a>

<form method="POST" action="{{ route('logout') }}" class="mt-4 px-2">
    @csrf

    <button type="submit" class="admin-logout-btn w-100">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </button>
</form>

</div>

<div class="content">
    <div class="container my-4">
        @yield('content')
    </div>
</div>

<script>
    function toggleAdminSidebar() {
        var sidebar = document.getElementById('adminSidebar');
        var overlay = document.getElementById('sidebarOverlay');
        if (sidebar) sidebar.classList.toggle('active');
        if (overlay) overlay.classList.toggle('active');
    }
</script>

</body>
</html>
