@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">
                <i class="bi bi-chat-square-quote me-2"></i>
                Add Testimonial
            </h4>

            <p class="text-muted mb-0">
                Add a new client testimonial to your website.
            </p>

        </div>


        <a
            href="{{ route('testimonials.index') }}"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Back to Testimonials

        </a>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <div class="fw-semibold mb-2">

                <i class="bi bi-exclamation-triangle me-2"></i>

                Please fix the following errors:

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        FORM CARD
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h6 class="mb-0">

                <i class="bi bi-person-vcard me-2"></i>

                Testimonial Information

            </h6>

        </div>


        <div class="card-body">

            <form
                action="{{ route('testimonials.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                @include(
                    'admin.testimonials._form',
                    [
                        'testimonial' => null,
                        'projects' => $projects
                    ]
                )


                {{-- =================================================
                    FORM ACTIONS
                ================================================== --}}
                <div class="border-top mt-4 pt-4">

                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ route('testimonials.index') }}"
                            class="btn btn-light border"
                        >

                            <i class="bi bi-x-lg me-1"></i>

                            Cancel

                        </a>


                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-check-lg me-1"></i>

                            Save Testimonial

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
