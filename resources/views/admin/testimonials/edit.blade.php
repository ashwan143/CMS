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

                Edit Testimonial

            </h4>

            <p class="text-muted mb-0">

                Update client testimonial information.

            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('testimonials.show', $testimonial) }}"
                class="btn btn-outline-primary"
            >

                <i class="bi bi-eye me-1"></i>

                View

            </a>


            <a
                href="{{ route('testimonials.index') }}"
                class="btn btn-outline-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Back

            </a>

        </div>

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
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        EDIT FORM
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex align-items-center">

                @if($testimonial->client_photo)

                    <img
                        src="{{ asset('storage/' . $testimonial->client_photo) }}"
                        alt="{{ $testimonial->photo_alt ?? $testimonial->client_name }}"
                        class="rounded-circle me-3"
                        width="50"
                        height="50"
                        style="object-fit:cover;"
                    >

                @else

                    <div
                        class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                        style="width:50px;height:50px;"
                    >

                        <i class="bi bi-person text-muted"></i>

                    </div>

                @endif


                <div>

                    <h6 class="mb-0">

                        {{ $testimonial->client_name }}

                    </h6>

                    <small class="text-muted">

                        {{ $testimonial->company_name ?? 'Testimonial' }}

                    </small>

                </div>

            </div>

        </div>


        <div class="card-body">

            <form
                action="{{ route('testimonials.update', $testimonial) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                @include(
                    'admin.testimonials._form',
                    [
                        'testimonial' => $testimonial,
                        'projects' => $projects
                    ]
                )


                {{-- =================================================
                    FORM ACTIONS
                ================================================== --}}
                <div class="border-top mt-4 pt-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="text-muted small">

                            <i class="bi bi-clock me-1"></i>

                            Last updated:

                            {{ $testimonial->updated_at?->format('d M Y, h:i A') }}

                        </div>


                        <div class="d-flex gap-2">

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

                                Update Testimonial

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
