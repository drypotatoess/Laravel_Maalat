@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h5 class="fw-semibold mb-0">Users</h5>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-plus-lg me-1"></i> Add User
    </button>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-warning"
                            style="width:32px; height:32px; padding:0;"
                            title="Edit"
                            data-bs-toggle="modal"
                            data-bs-target="#editUserModal"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}">
                            <i class="bi bi-pencil-fill" style="font-size:13px;"></i>
                        </button>
                        <button class="btn btn-sm btn-danger"
                            style="width:32px; height:32px; padding:0;"
                            title="Delete"
                            onclick="confirmDelete('{{ route('users.destroy', $user->id) }}')">
                            <i class="bi bi-trash-fill" style="font-size:13px;"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ADD USER MODAL -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-semibold">Add User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT USER MODAL -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-semibold">Edit User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px">Full Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:13px">Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DELETE CONFIRMATION MODAL -->
<div class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content border-0 shadow" style="background:#fff; border-radius:12px;">
            <div class="modal-body text-center py-4 px-4">
                <div class="mb-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width:60px; height:60px; background:#fff0f0;">
                        <i class="bi bi-trash-fill text-danger" style="font-size:26px;"></i>
                    </div>
                </div>
                <h6 class="fw-semibold mb-1">Delete User</h6>
                <p class="text-muted mb-0" style="font-size:13px;">Are you sure you want to delete this user? This action cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4 pt-0 gap-2">
                <button type="button" class="btn btn-sm px-4"
                    style="background:#0d9488; color:#fff; border:none; border-radius:6px;"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-sm px-4"
                    style="border-radius:6px;"
                    id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="deleteUserForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
    function confirmDelete(actionUrl) {
        document.getElementById('deleteUserForm').action = actionUrl;
        new bootstrap.Modal(document.getElementById('deleteUserModal')).show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        document.getElementById('deleteUserForm').submit();
    });

    const editUserModal = document.getElementById('editUserModal');
    editUserModal.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        document.getElementById('editName').value = btn.getAttribute('data-name');
        document.getElementById('editEmail').value = btn.getAttribute('data-email');
        document.getElementById('editUserForm').action = '/users/' + btn.getAttribute('data-id');
    });
</script>
@endpush