@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">FAQ Details</h1>
            <p class="text-muted mb-0">View FAQ information.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('faqs.edit', $faq) }}" class="btn btn-warning">
                Edit
            </a>

            <a href="{{ route('faqs.index') }}" class="btn btn-secondary">
                Back to FAQs
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">

                <div class="col-md-8">

                    <h3>{{ $faq->question }}</h3>

                    @if($faq->short_question)
                        <p class="text-muted">
                            {{ $faq->short_question }}
                        </p>
                    @endif

                    <hr>

                    <p>
                        <strong>Category:</strong>
                        {{ $faq->category ?? '-' }}
                    </p>

                    <p>
                        <strong>Slug:</strong>
                        {{ $faq->slug ?? '-' }}
                    </p>

                    <p>
                        <strong>Display Order:</strong>
                        {{ $faq->order }}
                    </p>

                    <p>
                        <strong>Status:</strong>

                        @if($faq->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </p>

                    <p>
                        <strong>Featured:</strong>

                        @if($faq->is_featured)
                            <span class="badge bg-warning text-dark">
                                Featured
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                No
                            </span>
                        @endif
                    </p>

                </div>

            </div>

            <hr>

            <div class="mb-4">
                <h5>Answer</h5>

                <div>
                    {!! nl2br(e($faq->answer)) !!}
                </div>
            </div>

            <div>
                <h5>SEO Information</h5>

                <p>
                    <strong>SEO Title:</strong>
                    {{ $faq->seo_title ?? '-' }}
                </p>

                <p>
                    <strong>SEO Keywords:</strong>
                    {{ $faq->seo_keywords ?? '-' }}
                </p>

                <p>
                    <strong>SEO Description:</strong>
                    {{ $faq->seo_description ?? '-' }}
                </p>
            </div>

        </div>
    </div>

</div>

@endsection
