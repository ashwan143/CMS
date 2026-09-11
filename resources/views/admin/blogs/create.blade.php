@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <div class="d-flex align-items-center gap-2">

                <a
                    href="{{ route('blogs.index') }}"
                    class="btn btn-sm btn-outline-secondary"
                    title="Back"
                >
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div>

                    <h4 class="mb-1">
                        <i class="bi bi-journal-plus me-2"></i>
                        Create Blog
                    </h4>

                    <p class="text-muted mb-0">
                        Create a new company blog article.
                    </p>

                </div>

            </div>

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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        CREATE FORM
    ========================================================== --}}
    <form
        action="{{ route('blogs.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- =====================================================
            SHARED BLOG FORM
        ====================================================== --}}
        @include('admin.blogs._form')


        {{-- =====================================================
            FORM ACTIONS
        ====================================================== --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('blogs.index') }}"
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
                        Create Blog
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
