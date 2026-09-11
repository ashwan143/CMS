@extends('admin.layouts.app')

@section('title', 'View User')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>View User</h2>

            <small class="text-muted">
                User Details
            </small>

        </div>

        <a href="{{ route('users.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="row">

                <div class="col-md-3 text-center">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                         class="rounded-circle mb-3"
                         width="120"
                         height="120">

                </div>

                <div class="col-md-9">

                    <table class="table">

                        <tr>
                            <th width="200">Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-success">
                                    Active
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $user->created_at->format('d M Y h:i A') }}</td>
                        </tr>

                        <tr>
                            <th>Updated At</th>
                            <td>{{ $user->updated_at->format('d M Y h:i A') }}</td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
