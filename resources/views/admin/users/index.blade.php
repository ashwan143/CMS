@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-0">User Management</h2>
            <small class="text-muted">
                Manage all system users
            </small>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Add User
        </a>

    </div>

    <!-- Card -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <!-- Search -->
            <div class="row mb-3">

                <div class="col-md-6">

                    <form method="GET" action="{{ route('users.index') }}">

                        <div class="input-group">

                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Search by name or email..."
                                   value="{{ request('search') }}">

                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i> Search
                            </button>

                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                Reset
                            </a>

                        </div>

                    </form>

                </div>

            </div>

            <!-- Table -->
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="220">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                                         class="rounded-circle"
                                         width="45"
                                         height="45"
                                         alt="{{ $user->name }}">

                                </td>

                                <td>

                                    <strong>{{ $user->name }}</strong>

                                </td>

                                <td>{{ $user->email }}</td>

                                <td>

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                </td>

                                <td>{{ $user->created_at->format('d M Y') }}</td>

                               <td>

    <!-- View -->
    <a href="{{ route('users.show', $user->id) }}"
       class="btn btn-info btn-sm">
        <i class="bi bi-eye"></i>
    </a>

    <!-- Edit -->
    <a href="{{ route('users.edit', $user->id) }}"
       class="btn btn-warning btn-sm">
        <i class="bi bi-pencil"></i>
    </a>

    <!-- Delete -->
    <form action="{{ route('users.destroy', $user->id) }}"
      method="POST"
      class="d-inline delete-form">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger btn-sm">
        <i class="bi bi-trash"></i>
    </button>

</form>

</td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-4">

                                    No users found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="mt-3">

                {{ $users->links() }}

            </div>

        </div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-form').forEach(function (form) {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});
</script>
@endsection
