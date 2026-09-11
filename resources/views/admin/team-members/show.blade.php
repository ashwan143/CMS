@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Team Member Details</h1>
            <p class="text-muted mb-0">View team member information.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('team-members.edit', $teamMember) }}" class="btn btn-warning">
                Edit
            </a>

            <a href="{{ route('team-members.index') }}" class="btn btn-secondary">
                Back to Team Members
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">

                {{-- Profile Image --}}
                <div class="col-md-3 text-center mb-4">

                    @if($teamMember->profile_image)

                        <img
                            src="{{ asset('storage/' . $teamMember->profile_image) }}"
                            alt="{{ $teamMember->name }}"
                            class="img-fluid rounded border"
                            style="width: 200px; height: 200px; object-fit: cover;"
                        >

                    @else

                        <div class="text-muted">
                            No Profile Image
                        </div>

                    @endif

                </div>

                {{-- Basic Information --}}
                <div class="col-md-9">

                    <h3>{{ $teamMember->name }}</h3>

                    @if($teamMember->designation)
                        <p class="text-muted mb-3">
                            {{ $teamMember->designation }}
                        </p>
                    @endif

                    <hr>

                    <p>
                        <strong>Display Order:</strong>
                        {{ $teamMember->order }}
                    </p>

                    <p>
                        <strong>Status:</strong>

                        @if($teamMember->status)
                            <span class="badge bg-success">
                                Active
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Inactive
                            </span>
                        @endif
                    </p>

                </div>

            </div>

            <hr>

            {{-- Biography --}}
            <div class="mb-4">

                <h5>Biography</h5>

                @if($teamMember->bio)
                    <div>
                        {!! nl2br(e($teamMember->bio)) !!}
                    </div>
                @else
                    <p class="text-muted">
                        No biography available.
                    </p>
                @endif

            </div>

            {{-- Social Links --}}
            <div>

                <h5>Social Links</h5>

                @php
                    $socialLinks = $teamMember->social_links ?? [];
                @endphp

                @if(!empty($socialLinks))

                    <div class="d-flex flex-wrap gap-2">

                        @if(!empty($socialLinks['linkedin']))
                            <a
                                href="{{ $socialLinks['linkedin'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-sm btn-primary"
                            >
                                LinkedIn
                            </a>
                        @endif

                        @if(!empty($socialLinks['facebook']))
                            <a
                                href="{{ $socialLinks['facebook'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-sm btn-primary"
                            >
                                Facebook
                            </a>
                        @endif

                        @if(!empty($socialLinks['instagram']))
                            <a
                                href="{{ $socialLinks['instagram'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-sm btn-danger"
                            >
                                Instagram
                            </a>
                        @endif

                    </div>

                @else

                    <p class="text-muted">
                        No social links available.
                    </p>

                @endif

            </div>

        </div>
    </div>

</div>

@endsection
