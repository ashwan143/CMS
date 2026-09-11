
@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- ===================================================== --}}
    {{-- PAGE HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Role Details</h4>

            <p class="text-muted mb-0">
                View role information, users and assigned permissions.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('roles.edit', $role) }}"
               class="btn btn-primary">
                Edit Role
            </a>

            <a href="{{ route('roles.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- ROLE INFORMATION --}}
    {{-- ===================================================== --}}

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        Role Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        {{-- Name --}}

                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block">
                                Role Name
                            </small>

                            <strong class="fs-5">
                                {{ $role->name }}
                            </strong>

                        </div>


                        {{-- Slug --}}

                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block">
                                Slug
                            </small>

                            <code>
                                {{ $role->slug }}
                            </code>

                        </div>


                        {{-- Status --}}

                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block mb-1">
                                Status
                            </small>

                            @if($role->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </div>


                        {{-- Created --}}

                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block">
                                Created At
                            </small>

                            <strong>
                                {{ $role->created_at?->format('d M Y, h:i A') }}
                            </strong>

                        </div>


                        {{-- Description --}}

                        <div class="col-md-12">

                            <small class="text-muted d-block">
                                Description
                            </small>

                            <p class="mb-0">

                                {{ $role->description ?: 'No description available.' }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- PERMISSIONS --}}
            {{-- ================================================= --}}

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">
                            Assigned Permissions
                        </h5>

                        <span class="badge bg-primary">

                            {{ $role->permissions->count() }}

                            Permissions

                        </span>

                    </div>

                </div>


                <div class="card-body">

                    @php

                        $groupedPermissions =
                            $role->permissions->groupBy('module');

                    @endphp


                    @forelse($groupedPermissions as $module => $permissions)

                        <div class="border rounded mb-3">

                            <div class="bg-light p-3">

                                <strong>
                                    {{ $module ?: 'General' }}
                                </strong>

                                <span class="badge bg-secondary ms-2">
                                    {{ $permissions->count() }}
                                </span>

                            </div>


                            <div class="p-3">

                                <div class="row">

                                    @foreach($permissions as $permission)

                                        <div class="col-lg-4 col-md-6 mb-2">

                                            <div class="d-flex align-items-center">

                                                <span class="text-success me-2">
                                                    ✓
                                                </span>

                                                <span>
                                                    {{ $permission->name }}
                                                </span>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="alert alert-warning mb-0">

                            No permissions assigned to this role.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- SIDEBAR --}}
        {{-- ===================================================== --}}

        <div class="col-lg-4">


            {{-- Statistics --}}

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        Role Statistics
                    </h5>

                </div>


                <div class="card-body">

                    <div class="d-flex justify-content-between border-bottom pb-3 mb-3">

                        <span class="text-muted">
                            Users
                        </span>

                        <strong>
                            {{ $role->users->count() }}
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between border-bottom pb-3 mb-3">

                        <span class="text-muted">
                            Permissions
                        </span>

                        <strong>
                            {{ $role->permissions->count() }}
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-muted">
                            Status
                        </span>

                        @if($role->status)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Inactive
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Assigned Users --}}

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        Assigned Users
                    </h5>

                </div>


                <div class="card-body p-0">

                    @forelse($role->users as $user)

                        <div class="d-flex align-items-center p-3 border-bottom">

                            <div
                                class="rounded-circle bg-primary text-white
                                       d-flex align-items-center justify-content-center
                                       me-3"
                                style="width:40px;height:40px;"
                            >

                                {{ strtoupper(substr($user->name, 0, 1)) }}

                            </div>


                            <div>

                                <strong class="d-block">
                                    {{ $user->name }}
                                </strong>

                                <small class="text-muted">
                                    {{ $user->email }}
                                </small>

                            </div>

                        </div>

                    @empty

                        <div class="p-3 text-muted">

                            No users assigned to this role.

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- Actions --}}

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        Actions
                    </h5>

                </div>


                <div class="card-body">

                    <a
                        href="{{ route('roles.edit', $role) }}"
                        class="btn btn-primary w-100 mb-2"
                    >
                        Edit Role
                    </a>


                    <a
                        href="{{ route('roles.index') }}"
                        class="btn btn-secondary w-100"
                    >
                        Back to Roles
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

