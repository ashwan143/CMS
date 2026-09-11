@extends('admin.layouts.app')

@section('title', 'View Service')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">Service Details</h2>
        <p class="text-muted mb-0">
            View complete service information.
        </p>
    </div>


    <div>

        <a href="{{ route('services.edit', $service->id) }}"
           class="btn btn-warning">

            <i class="bi bi-pencil"></i>
            Edit

        </a>


        <a href="{{ route('services.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Back

        </a>

    </div>

</div>


<div class="row">


    <!-- Left Content -->

    <div class="col-lg-8">


        <!-- Basic Information -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    Basic Information
                </h5>

            </div>


            <div class="card-body">


                <h3>
                    {{ $service->title }}
                </h3>


                <p class="text-muted">
                    {{ $service->short_description }}
                </p>


                <hr>


                <h5>
                    Description
                </h5>


                <div>
                    {!! $service->description !!}
                </div>


            </div>

        </div>



        <!-- SEO Information -->

        <div class="card shadow-sm">


            <div class="card-header">

                <h5 class="mb-0">
                    SEO Information
                </h5>

            </div>


            <div class="card-body">


                <p>
                    <strong>SEO Title:</strong><br>

                    {{ $service->seo_title ?? 'N/A' }}

                </p>


                <p>
                    <strong>SEO Keywords:</strong><br>

                    {{ $service->seo_keywords ?? 'N/A' }}

                </p>


                <p>
                    <strong>SEO Description:</strong><br>

                    {{ $service->seo_description ?? 'N/A' }}

                </p>


            </div>


        </div>


    </div>




    <!-- Right Sidebar -->

    <div class="col-lg-4">


        <!-- Image -->

        <div class="card shadow-sm mb-4">


            <div class="card-header">

                <h5 class="mb-0">
                    Service Image
                </h5>

            </div>


            <div class="card-body text-center">


                @if($service->image)

                    <img src="{{ asset('storage/'.$service->image) }}"
                         class="img-fluid rounded"
                         style="max-height:250px;">

                @else

                    <span class="badge bg-secondary">
                        No Image
                    </span>

                @endif


            </div>


        </div>



        <!-- Settings -->

        <div class="card shadow-sm">


            <div class="card-header">

                <h5 class="mb-0">
                    Settings
                </h5>

            </div>


            <div class="card-body">


                <p>
                    <strong>Slug:</strong>

                    <br>

                    {{ $service->slug }}

                </p>


                <p>
                    <strong>Status:</strong>


                    @if($service->status)

                        <span class="badge bg-success">
                            Active
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Inactive
                        </span>

                    @endif


                </p>


                <p>
                    <strong>Display Order:</strong>

                    {{ $service->display_order }}

                </p>


                <p>
                    <strong>Icon:</strong>

                    <br>

                    <i class="{{ $service->icon }}"></i>

                    {{ $service->icon }}

                </p>


                <p>
                    <strong>Created:</strong>

                    <br>

                    {{ $service->created_at->format('d M Y') }}

                </p>


            </div>


        </div>


    </div>


</div>


@endsection
