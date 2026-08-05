@extends('admin.layout')

@section('content')

<style>
    /* Clean Admin Contact Table Formatting */
    .admin-contacts-card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #ebebeb;
        overflow: hidden;
    }
    .admin-contacts-header {
        background-color: #ffffff;
        padding: 20px 25px;
        border-bottom: 2px solid var(--theme-primary, #C06B1F);
    }
    .admin-contacts-search {
        max-width: 350px;
        width: 100%;
    }
    .admin-contacts-search .form-control {
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #d1d5db;
    }
    .admin-contacts-search .form-control:focus {
        border-color: var(--theme-primary, #C06B1F);
        box-shadow: none;
    }

    .admin-contacts-table {
        width: 100%;
        margin-bottom: 0;
    }
    .admin-contacts-table th {
        background-color: #ffffff;
        color: #000000;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        padding: 14px 16px;
        border-bottom: 1px solid #e5e7eb;
    }
    .admin-contacts-table td {
        padding: 14px 16px;
        vertical-align: middle;
        font-size: 14px;
        border-bottom: 1px solid #f3f4f6;
    }
    .admin-contacts-table tbody tr:hover {
        background-color: #f9fafb;
    }

    /* Column Width Controls */
    .col-id { width: 60px; font-weight: 700; color: #4b5563; }
    .col-name { min-width: 150px; font-weight: 600; color: #111827; }
    .col-email { min-width: 170px; }
    .col-phone { min-width: 120px; white-space: nowrap; color: #374151; }
    .col-subject { min-width: 140px; font-weight: 600; color: #1f2937; }
    .col-message { min-width: 260px; max-width: 420px; word-break: break-word; white-space: normal; color: #374151; line-height: 1.5; }
    .col-date { min-width: 150px; white-space: nowrap; color: #4b5563; }
    .col-actions { min-width: 160px; text-align: center; white-space: nowrap; }
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

    @if(session('error'))
        <div id="errorMessage" class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success') || session('error'))
        <script>
            setTimeout(function() {
                var successMsg = document.getElementById('successMessage');
                if (successMsg) {
                    successMsg.style.transition = 'opacity 0.5s ease';
                    successMsg.style.opacity = '0';
                    setTimeout(function() { successMsg.style.display = 'none'; }, 500);
                }
                var errorMsg = document.getElementById('errorMessage');
                if (errorMsg) {
                    errorMsg.style.transition = 'opacity 0.5s ease';
                    errorMsg.style.opacity = '0';
                    setTimeout(function() { errorMsg.style.display = 'none'; }, 500);
                }
            }, 3000);
        </script>
    @endif

    <div class="admin-contacts-card">
        <div class="admin-contacts-header d-flex justify-content-between align-items-center">
            <h2 class="page-title m-0 fw-bold text-uppercase">Contact Form Submissions</h2>
        </div>
        
        <div class="card-body p-4">

            <!-- SEARCH BAR -->
            <form action="{{ route('admin.contacts') }}" method="GET" class="mb-3 admin-contacts-search">
                <input type="text"
                       name="search"
                       id="searchInput"
                       class="form-control"
                       placeholder="Search..."
                       value="{{ request('search') }}">
            </form>

            @if($contacts->isEmpty())
                <div class="admin-empty-contacts py-4 text-center">
                    <p class="admin-empty-contacts-text text-secondary mb-0">No contact form submissions found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle admin-contacts-table mb-0">
                        <thead>
                            <tr>
                                <th class="col-id">ID</th>
                                <th class="col-name">Name</th>
                                <th class="col-email">Email</th>
                                <th class="col-phone">Phone</th>
                                <th class="col-subject">Subject</th>
                                <th class="col-message">Message</th>
                                <th class="col-date">Date</th>
                                <th class="col-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <td class="col-id">#{{ $contact->id }}</td>
                                <td class="col-name">{{ $contact->name }}</td>
                                <td class="col-email">
                                    <a href="mailto:{{ $contact->email }}" class="admin-contact-email text-decoration-none" style="color: var(--theme-primary, #C06B1F);">{{ $contact->email }}</a>
                                </td>
                                <td class="col-phone">{{ $contact->phone ?? 'N/A' }}</td>
                                <td class="col-subject">{{ $contact->subject ?? 'N/A' }}</td>
                                <td class="col-message">
                                    {{ $contact->message }}
                                    @if($contact->replies->count() > 0)
                                        <div class="mt-1">
                                            <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 11px;">
                                                <i class="fas fa-check-circle me-1"></i> Replied ({{ $contact->replies->count() }})
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td class="col-date">{{ $contact->created_at ? $contact->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td class="col-actions">
                                    <!-- REPLY BUTTON -->
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#replyModal{{ $contact->id }}" 
                                            title="Reply to customer">
                                        <i class="fas fa-reply me-1"></i> Reply
                                    </button>

                                    <!-- DELETE BUTTON -->
                                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this submission?')" class="admin-form-inline d-inline-block m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn delete-btn" type="submit" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- REPLY MODAL -->
                            <div class="modal fade" id="replyModal{{ $contact->id }}" tabindex="-1" aria-labelledby="replyModalLabel{{ $contact->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header text-white" style="background-color: var(--theme-primary, #C06B1F);">
                                            <h5 class="modal-title fw-bold" id="replyModalLabel{{ $contact->id }}">
                                                <i class="fas fa-reply me-2"></i> Reply to {{ $contact->name }}
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body p-4 text-start">
                                                <div class="mb-3 p-3 bg-light rounded border">
                                                    <div class="small text-muted fw-bold text-uppercase">Customer Email:</div>
                                                    <div class="fw-semibold text-dark">{{ $contact->email }}</div>
                                                    
                                                    @if($contact->subject)
                                                        <div class="small text-muted fw-bold text-uppercase mt-2">Subject:</div>
                                                        <div class="text-dark">{{ $contact->subject }}</div>
                                                    @endif

                                                    <div class="small text-muted fw-bold text-uppercase mt-2">User Message:</div>
                                                    <div class="small text-secondary" style="white-space: pre-wrap;">"{{ $contact->message }}"</div>
                                                </div>

                                                <!-- PREVIOUS REPLIES -->
                                                @if($contact->replies->count() > 0)
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-secondary">Previous Replies:</label>
                                                        @foreach($contact->replies as $reply)
                                                            <div class="p-2 mb-2 bg-white rounded border small text-dark">
                                                                <div class="text-muted" style="font-size: 11px;">
                                                                    <strong>{{ $reply->admin ? $reply->admin->name : 'Admin' }}</strong> • {{ $reply->created_at->format('d M Y, h:i A') }}
                                                                </div>
                                                                <div style="white-space: pre-wrap;">{{ $reply->message }}</div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold small text-dark">Your Response Message <span class="text-danger">*</span></label>
                                                    <textarea name="message" class="form-control" rows="4" placeholder="Write your email response here..." required></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer bg-light py-2">
                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-sm btn-primary fw-bold" style="background-color: var(--theme-primary, #C06B1F); border-color: var(--theme-primary, #C06B1F);">
                                                    <i class="fas fa-paper-plane me-1"></i> Send Reply Email
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>

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
