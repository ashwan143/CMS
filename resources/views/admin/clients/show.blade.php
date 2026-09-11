@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Client Details</h1>
            <p class="text-muted mb-0">View client information.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">
                Edit
            </a>

            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                Back to Clients
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">

                {{-- Logo --}}
                <div class="col-md-3 text-center mb-4">
                    @if($client->logo)
                        <img
                            src="{{ asset('storage/' . $client->logo) }}"
                            alt="{{ $client->name }}"
                            class="img-fluid rounded border"
                            style="max-height: 200px; object-fit: contain;"
                        >
                    @else
                        <div class="text-muted">
                            No Logo
                        </div>
                    @endif
                </div>

                {{-- Basic Information --}}
                <div class="col-md-9">

                    <h3>{{ $client->name }}</h3>

                    <hr>

                    <p>
                        <strong>Industry:</strong>
                        {{ $client->industry ?? '-' }}
                    </p>

                    <p>
                        <strong>Website:</strong>

                        @if($client->website)
                            <a
                                href="{{ $client->website }}"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                {{ $client->website }}
                            </a>
                        @else
                            -
                        @endif
                    </p>

                    <p>
                        <strong>Display Order:</strong>
                        {{ $client->order }}
                    </p>

                    <p>
                        <strong>Status:</strong>

                        @if($client->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </p>

                    <p>
                        <strong>Featured:</strong>

                        @if($client->is_featured)
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

            {{-- Short Description --}}
            <div class="mb-4">
                <h5>Short Description</h5>

                @if($client->short_description)
                    <p>{{ $client->short_description }}</p>
                @else
                    <p class="text-muted">No short description.</p>
                @endif
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <h5>Description</h5>

                @if($client->description)
                    <p>{!! nl2br(e($client->description)) !!}</p>
                @else
                    <p class="text-muted">No description.</p>
                @endif
            </div>

            {{-- SEO --}}
            <div>
                <h5>SEO Information</h5>

                <p>
                    <strong>SEO Title:</strong>
                    {{ $client->seo_title ?? '-' }}
                </p>

                <p>
                    <strong>SEO Keywords:</strong>
                    {{ $client->seo_keywords ?? '-' }}
                </p>

                <p>
                    <strong>SEO Description:</strong>
                    {{ $client->seo_description ?? '-' }}
                </p>
            </div>

        </div>
    </div>

</div>

@endsection
