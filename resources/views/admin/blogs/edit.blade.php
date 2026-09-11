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
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Blog
                    </h4>

                    <p class="text-muted mb-0">
                        Update the selected blog article.
                    </p>

                </div>

            </div>

        </div>


        {{-- View Blog --}}
        <div>

            <a
                href="{{ route('blogs.show', $blog) }}"
                class="btn btn-outline-info"
            >
                <i class="bi bi-eye me-1"></i>
                View Blog
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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        EDIT FORM
    ========================================================== --}}
    <form
        action="{{ route('blogs.update', $blog) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')


        {{-- =====================================================
            SHARED BLOG FORM
        ====================================================== --}}
        @include('admin.blogs._form')


        {{-- =====================================================
            FORM ACTIONS
        ====================================================== --}}
        <div class="card border-0 shadow-sm mt-4">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div class="text-muted small">

                        Last updated:

                        @if($blog->updated_at)

                            {{ $blog->updated_at->format('d M Y, h:i A') }}

                        @else

                            —

                        @endif

                    </div>


                    <div class="d-flex gap-2">

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
                            Update Blog
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
