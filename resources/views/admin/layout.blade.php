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
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700 !important;
        }
        h2.page-title, .page-title {
            font-size: 18px !important;
            line-height: 1.3 !important;
        }
        @media (max-width: 991.98px) {
            h2.page-title, .page-title {
                font-size: 15px !important;
            }
        }
        @media (max-width: 575.98px) {
            h2.page-title, .page-title {
                font-size: 13px !important;
            }
        }
        .admin-btn-add {
            background-color: var(--theme-primary, #C06B1F) !important;
            color: #ffffff !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            padding: 6px 14px !important;
            border-radius: 6px !important;
            white-space: nowrap !important;
            text-transform: uppercase !important;
            line-height: 1.2 !important;
            display: inline-flex !important;
            align-items: center !important;
        }
        @media (max-width: 575.98px) {
            .admin-btn-add {
                font-size: 10.5px !important;
                padding: 4px 8px !important;
                border-radius: 4px !important;
            }
        }
    </style>

</head>

<body>

<!-- Mobile Header (Visible only on mobile/tablet) -->
<div class="mobile-admin-header">
    <h3 class="m-0 text-white fw-bold">FURNIO ADMIN</h3>
    <button class="mobile-toggle-btn" onclick="toggleAdminSidebar()" aria-label="Toggle Navigation">
        <i class="fas fa-bars"></i>
    </button>
</div>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleAdminSidebar()"></div>

<div class="sidebar" id="adminSidebar">

    <div class="sidebar-header">
        <h3 class="sidebar-title">FURNIO ADMIN</h3>
        <div class="sidebar-close-btn" onclick="toggleAdminSidebar()">
            <i class="fas fa-times"></i>
        </div>
    </div>

    <div class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i> <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products') || request()->routeIs('admin.product.*') ? 'active' : '' }}">
            <i class="fas fa-list-alt me-2"></i> <span>Products</span>
        </a>

        <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart me-2"></i> <span>Orders</span>
        </a>

        <a href="{{ route('admin.sales-report') }}" class="{{ request()->routeIs('admin.sales-report') ? 'active' : '' }}">
            <i class="fas fa-chart-line me-2"></i> <span>Sales Reports</span>
        </a>

        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') || request()->routeIs('admin.user.*') ? 'active' : '' }}">
            <i class="fas fa-users me-2"></i> <span>Users</span>
        </a>

        <a href="{{ route('admin.contacts') }}" class="{{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
            <i class="fas fa-headset me-2"></i> <span>Contacts</span>
        </a>

        <a href="{{ route('admin.reviews') }}" class="{{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
            <i class="fas fa-star me-2"></i> <span>Reviews</span>
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="sidebar-logout-form">
        @csrf
        <button type="submit" class="admin-logout-btn">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </button>
    </form>

</div>

<div class="content">
    <div class="container-fluid my-3 px-2 px-md-4">
        @yield('content')
    </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
