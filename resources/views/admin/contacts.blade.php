@extends('admin.layout')

@section('content')

<div class="container-fluid mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn"><i class="fas fa-arrow-left"></i> Back</a>
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
        <div class="card-header bg-white d-flex justify-content-start align-items-center py-3 admin-card-header-standard" style="border-bottom: 2px solid var(--theme-primary);">
            <h2 class="page-title m-0 fw-bold text-uppercase fs-3 text-start text-break">Contact Form Submissions</h2>
        </div>
        
            <!-- SEARCH -->
           <div class="card-body p-3 p-md-4">

            <form action="{{ route('admin.contacts') }}" method="GET" class="d-flex mb-3 admin-search-form w-100 mx-auto mx-sm-0">
                <input type="text"
                       name="search"
                       id="searchInput"
                       class="search-box form-control"
                       placeholder="Search..."
                       value="{{ request('search') }}">
            </form>

            @if($contacts->isEmpty())
                <div class="admin-empty-contacts">
                    <p class="admin-empty-contacts-text">No contact form submissions found.</p>
                </div>
            @else
                <div class="table-responsive"><table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th class="text-nowrap">Date</th>
                            <th class="text-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td class="admin-contact-name">{{ $contact->name }}</td>
                            <td><a href="mailto:{{ $contact->email }}" class="admin-contact-email">{{ $contact->email }}</a></td>
                            <td class="text-nowrap">+91 {{ $contact->phone ?? 'N/A' }}</td>
                            <td class="admin-contact-subject">{{ $contact->subject ?? 'N/A' }}</td>
                            <td class="admin-contact-message">
                                {{ $contact->message }}
                            </td>
                            <td class="text-nowrap">{{ $contact->created_at ? $contact->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                            <td class="text-nowrap">
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this submission?')" class="admin-form-inline">
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

                <!-- PAGINATION -->
                <div class="row mt-4">
                    <div class="col-12 pagination-wrapper">
                        {{ $contacts->appends(['search' => $search])->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection



