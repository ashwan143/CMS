
@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Edit Role</h4>

            <p class="text-muted mb-0">
                Update role information and permissions.
            </p>
        </div>

        <a href="{{ route('roles.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <form
        action="{{ route('roles.update', $role) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        {{-- ===================================================== --}}
        {{-- ROLE INFORMATION --}}
        {{-- ===================================================== --}}

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0">
                    Role Information
                </h5>

            </div>


            <div class="card-body">

                <div class="row">

                    {{-- Role Name --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Role Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $role->name) }}"
                            required
                        >

                    </div>


                    {{-- Slug --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            class="form-control"
                            value="{{ old('slug', $role->slug) }}"
                        >

                        <small class="text-muted">
                            Example: content-manager
                        </small>

                    </div>


                    {{-- Description --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                        >{{ old('description', $role->description) }}</textarea>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-12">

                        <div class="form-check form-switch">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="status"
                                value="1"
                                id="status"
                                {{ old('status', $role->status) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="status"
                            >
                                Active
                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- PERMISSIONS --}}
        {{-- ===================================================== --}}

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        Permissions
                    </h5>

                    <div>

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-primary"
                            id="selectAllPermissions"
                        >
                            Select All
                        </button>

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-secondary"
                            id="clearAllPermissions"
                        >
                            Clear All
                        </button>

                    </div>

                </div>

            </div>


            <div class="card-body">

                @forelse($permissions as $module => $modulePermissions)

                    @php

                        $moduleSlug = \Illuminate\Support\Str::slug($module);

                        $modulePermissionIds =
                            $modulePermissions->pluck('id')->toArray();

                        $selectedCount =
                            count(array_intersect(
                                $modulePermissionIds,
                                $selectedPermissions
                            ));

                        $allModuleSelected =
                            count($modulePermissionIds) > 0 &&
                            $selectedCount === count($modulePermissionIds);

                    @endphp


                    {{-- Module --}}
                    <div class="border rounded mb-3">

                        {{-- Module Header --}}
                        <div class="bg-light p-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <strong>
                                    {{ $module ?: 'General' }}
                                </strong>

                                <div class="form-check">

                                    <input
                                        type="checkbox"
                                        class="form-check-input module-select-all"
                                        data-module="{{ $moduleSlug }}"
                                        id="module_{{ $moduleSlug }}"
                                        {{ $allModuleSelected ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="module_{{ $moduleSlug }}"
                                    >
                                        Select All
                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- Permission List --}}
                        <div class="p-3">

                            <div class="row">

                                @foreach($modulePermissions as $permission)

                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">

                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                class="form-check-input permission-checkbox module-{{ $moduleSlug }}"
                                                name="permissions[]"
                                                value="{{ $permission->id }}"
                                                id="permission_{{ $permission->id }}"
                                                {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}
                                            >

                                            <label
                                                class="form-check-label"
                                                for="permission_{{ $permission->id }}"
                                            >
                                                {{ $permission->name }}
                                            </label>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="alert alert-warning mb-0">

                        No permissions found.

                    </div>

                @endforelse

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- ACTION BUTTONS --}}
        {{-- ===================================================== --}}

        <div class="d-flex gap-2 mb-4">

            <button
                type="submit"
                class="btn btn-primary"
            >
                <i class="bi bi-check-lg"></i>
                Update Role
            </button>


            <a
                href="{{ route('roles.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

        </div>

    </form>

</div>


{{-- ============================================================= --}}
{{-- PERMISSION JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Select All Permissions
    |--------------------------------------------------------------------------
    */

    const selectAllButton =
        document.getElementById('selectAllPermissions');

    if (selectAllButton) {

        selectAllButton.addEventListener('click', function () {

            document
                .querySelectorAll('.permission-checkbox')
                .forEach(function (checkbox) {

                    checkbox.checked = true;

                });

            document
                .querySelectorAll('.module-select-all')
                .forEach(function (checkbox) {

                    checkbox.checked = true;

                });

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Clear All Permissions
    |--------------------------------------------------------------------------
    */

    const clearAllButton =
        document.getElementById('clearAllPermissions');

    if (clearAllButton) {

        clearAllButton.addEventListener('click', function () {

            document
                .querySelectorAll('.permission-checkbox')
                .forEach(function (checkbox) {

                    checkbox.checked = false;

                });

            document
                .querySelectorAll('.module-select-all')
                .forEach(function (checkbox) {

                    checkbox.checked = false;

                });

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Module Select All
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.module-select-all')
        .forEach(function (moduleCheckbox) {

            moduleCheckbox.addEventListener('change', function () {

                const module = this.dataset.module;

                document
                    .querySelectorAll('.module-' + module)
                    .forEach(function (permission) {

                        permission.checked = this.checked;

                    }, this);

            });

        });


    /*
    |--------------------------------------------------------------------------
    | Individual Permission Change
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.permission-checkbox')
        .forEach(function (permissionCheckbox) {

            permissionCheckbox.addEventListener('change', function () {

                const moduleClass = Array
                    .from(this.classList)
                    .find(function (className) {

                        return className.startsWith('module-');

                    });


                if (!moduleClass) {
                    return;
                }


                const module = moduleClass.replace(
                    'module-',
                    ''
                );


                const moduleCheckbox =
                    document.querySelector(
                        '.module-select-all[data-module="' +
                        module +
                        '"]'
                    );


                const total =
                    document.querySelectorAll(
                        '.' + moduleClass
                    ).length;


                const checked =
                    document.querySelectorAll(
                        '.' + moduleClass + ':checked'
                    ).length;


                if (moduleCheckbox) {

                    moduleCheckbox.checked =
                        total === checked;

                }

            });

        });

});

</script>

@endsection

