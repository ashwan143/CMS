@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Create Role</h4>
            <p class="text-muted mb-0">
                Create a role and assign permissions.
            </p>
        </div>

        <a href="{{ route('roles.index') }}"
           class="btn btn-secondary">
            Back
        </a>

    </div>


    {{-- Validation Errors --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('roles.store') }}"
          method="POST">

        @csrf


        {{-- ========================================================= --}}
        {{-- ROLE INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <strong>Role Information</strong>

            </div>


            <div class="card-body">

                <div class="row">


                    {{-- Name --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Role Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Example: Content Manager"
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
                            value="{{ old('slug') }}"
                            placeholder="content-manager"
                        >

                        <small class="text-muted">
                            Leave empty to generate automatically.
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
                            placeholder="Describe this role..."
                        >{{ old('description') }}</textarea>

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
                                checked
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


        {{-- ========================================================= --}}
        {{-- PERMISSIONS --}}
        {{-- ========================================================= --}}

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <strong>Permissions</strong>

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


                    <div class="border rounded mb-3">


                        {{-- Module Header --}}

                        <div class="p-3 bg-light">

                            <div class="d-flex justify-content-between align-items-center">

                                <strong>
                                    {{ $module }}
                                </strong>


                                <div class="form-check">

                                    <input
                                        type="checkbox"
                                        class="form-check-input module-select-all"
                                        data-module="{{ \Illuminate\Support\Str::slug($module) }}"
                                        id="module{{ \Illuminate\Support\Str::slug($module) }}"
                                    >

                                    <label
                                        class="form-check-label"
                                        for="module{{ \Illuminate\Support\Str::slug($module) }}"
                                    >
                                        Select All
                                    </label>

                                </div>

                            </div>

                        </div>


                        {{-- Module Permissions --}}

                        <div class="p-3">

                            <div class="row">

                                @foreach($modulePermissions as $permission)

                                    <div class="col-md-3 mb-2">

                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                class="form-check-input permission-checkbox module-{{ \Illuminate\Support\Str::slug($module) }}"
                                                name="permissions[]"
                                                value="{{ $permission->id }}"
                                                id="permission{{ $permission->id }}"
                                            >

                                            <label
                                                class="form-check-label"
                                                for="permission{{ $permission->id }}"
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

                        No permissions available.

                    </div>

                @endforelse


            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- BUTTONS --}}
        {{-- ========================================================= --}}

        <div class="d-flex gap-2">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save Role
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
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | Select All Permissions
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('selectAllPermissions')
        .addEventListener('click', function () {

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


    /*
    |--------------------------------------------------------------------------
    | Clear All Permissions
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('clearAllPermissions')
        .addEventListener('click', function () {

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
                    .forEach(function (permissionCheckbox) {

                        permissionCheckbox.checked =
                            this.checked;

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

                const classes = this.className.split(' ');

                const moduleClass = classes.find(function (className) {

                    return className.startsWith('module-');

                });


                if (!moduleClass) {
                    return;
                }


                const moduleCheckbox =
                    document.querySelector(
                        '.module-select-all[data-module="' +
                        moduleClass.replace('module-', '') +
                        '"]'
                    );


                const modulePermissions =
                    document.querySelectorAll(
                        '.' + moduleClass
                    );


                const checkedPermissions =
                    document.querySelectorAll(
                        '.' + moduleClass + ':checked'
                    );


                if (moduleCheckbox) {

                    moduleCheckbox.checked =
                        modulePermissions.length ===
                        checkedPermissions.length;

                }

            });

        });

});

</script>

@endsection
