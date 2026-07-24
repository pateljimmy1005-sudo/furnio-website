@auth
<div class="user-dropdown-new position-relative">
    <a href="#" class="icon-link-new d-flex align-items-center gap-2 text-decoration-none">
        <i class="bi bi-person-circle fs-5"></i>
        <span>{{ auth()->user()->name }}</span>
    </a>
    <ul class="user-dropdown-menu">
        <li>
            <a href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> My Profile</a>
        </li>
        <li>
            <a href="/orders"><i class="bi bi-box"></i> My Orders</a>
        </li>
        @if(auth()->user()->role == 'admin')
        <li>
            <a href="/admin/dashboard"><i class="bi bi-speedometer2"></i> Admin Panel</a>
        </li>
        @endif
        <hr>
        <li>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </li>
    </ul>
</div>
@endauth