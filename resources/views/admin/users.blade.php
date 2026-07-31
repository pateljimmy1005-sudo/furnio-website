@extends('admin.layout')

@section('content')

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="card shadow border-0 admin-card-standard">
        <div class="card-header bg-white d-flex justify-content-start align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-3 text-start text-break">Users Management</h2>
        </div>

        <div class="card-body p-3 p-md-4">

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
                    }, 3000); 
                </script>
            @endif

            <form action="{{ route('admin.users') }}" method="GET" class="d-flex mb-3 admin-search-form w-100 mx-auto mx-sm-0">
                <input type="text"
                       name="search"
                       id="searchInput"
                       class="search-box form-control"
                       placeholder="Search name..."
                       value="{{ request('search') }}">
            </form>

            <div class="table-responsive" style="-webkit-overflow-scrolling: touch;">
                <table class="table table-hover align-middle mb-0" style="min-width: 650px;">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="width: 50px; font-size: 12px;">ID</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 120px; font-size: 12px;">Name</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 150px; font-size: 12px;">Email</th>
                            <th class="text-secondary text-uppercase fw-bold py-2 py-md-3 px-2 px-md-3" style="min-width: 90px; font-size: 12px;">Role</th>
                            <th class="text-secondary text-uppercase fw-bold text-center py-2 py-md-3 px-2 px-md-3" style="width: 120px; font-size: 12px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="fw-semibold text-secondary py-2 py-md-3 px-2 px-md-3" style="font-size: 13px;">{{ $user->id }}</td>
                            <td class="fw-bold text-dark py-2 py-md-3 px-2 px-md-3" style="font-size: 13.5px;">{{ $user->name }}</td>
                            <td class="py-2 py-md-3 px-2 px-md-3" style="font-size: 13.5px;">{{ $user->email }}</td>
                            <td class="fw-semibold text-dark py-2 py-md-3 px-2 px-md-3" style="font-size: 13.5px;">
                                {{ ucfirst($user->role) }}
                            </td>
                            <td class="py-2 py-md-3 px-2 px-md-3 text-center">
                                <div class="action-buttons d-flex gap-2 flex-nowrap align-items-center justify-content-center">
                                    <a href="{{ route('admin.user.profile', $user->id) }}" class="btn-action btn-profile" title="Profile"><i class="fas fa-user"></i></a>
                                    <form action="{{ route('admin.user.role', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-action btn-role" title="Change Role"><i class="fas fa-user-shield"></i></button>
                                    </form>
                                    <form action="{{ route('admin.user.unblock', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-action btn-unblock" title="Unblock"><i class="fas fa-unlock"></i></button>
                                    </form>
                                    <form action="{{ route('admin.user.block', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-action btn-block-action" title="Block"><i class="fas fa-ban"></i></button>
                                    </form>
                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="row mt-4">
                <div class="col-12 pagination-wrapper">
                    {{ $users->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>

</div>

@endsection


