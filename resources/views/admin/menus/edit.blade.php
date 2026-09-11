@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Menu
            </h4>

            <p class="text-muted mb-0">
                Update the selected menu item.
            </p>
        </div>

        <div class="mt-3 mt-md-0">

            <a
                href="{{ route('menus.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back to Menus
            </a>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <div class="fw-semibold mb-2">
                <i class="bi bi-exclamation-triangle me-1"></i>
                Please correct the following errors:
            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        EDIT FORM
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0">
                <i class="bi bi-list-nested me-2"></i>
                Menu Information
            </h5>

        </div>

        <div class="card-body">

            <form
                action="{{ route('menus.update', $menu) }}"
                method="POST"
            >

                @csrf

                @method('PUT')

                @include('admin.menus._form')

                {{-- =================================================
                    FORM ACTIONS
                ================================================== --}}
                <div class="border-top mt-4 pt-4">

                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ route('menus.index') }}"
                            class="btn btn-outline-secondary"
                        >
                            <i class="bi bi-x-lg me-1"></i>
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-check-lg me-1"></i>
                            Update Menu
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
