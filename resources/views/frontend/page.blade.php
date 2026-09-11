@extends('frontend.layouts.app')

@section('content')

<section class="py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                {{-- Page Header --}}
                <div class="mb-5">

                    <h1 class="display-5 fw-bold mb-3">
                        {{ $page->title }}
                    </h1>

                    @if($page->short_description)

                        <p class="lead text-muted mb-0">
                            {{ $page->short_description }}
                        </p>

                    @endif

                </div>


                {{-- Featured Image --}}
                @if($page->featured_image)

                    <div class="mb-5">

                        <img
                            src="{{ asset('storage/' . $page->featured_image) }}"
                            alt="{{ $page->title }}"
                            class="img-fluid rounded-4 shadow-sm"
                        >

                    </div>

                @endif


                {{-- Page Content --}}
                @if($page->content)

                    <div class="page-content">

                        {!! $page->content !!}

                    </div>

                @else

                    <div class="alert alert-light border">
                        This page does not have any content yet.
                    </div>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection
