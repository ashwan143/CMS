@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Roles</h4>
            <p class="text-muted mb-0">
                Manage administrator roles and permissions.
            </p>
        </div>

        <a href="{{ route('roles.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Add Role
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Slug</th>
                            <th>Users</th>
                            <th>Permissions</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($roles as $role)

                            <tr>

                                <td>
                                    {{ $roles->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $role->name }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $role->slug }}
                                    </span>
                                </td>

                                <td>
                                    {{ $role->users_count }}
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $role->permissions_count }}
                                    </span>
                                </td>

                                <td>

                                    @if($role->status)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('roles.show', $role) }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <a href="{{ route('roles.edit', $role) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-4 text-muted">

                                    No roles found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $roles->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
