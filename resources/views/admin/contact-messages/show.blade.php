@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">Contact Message</h1>
            <p class="text-muted mb-0">View the message received from the website visitor.</p>
        </div>

        <a href="{{ route('contact-messages.index') }}" class="btn btn-secondary">
            Back to Messages
        </a>

    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">

                {{-- Visitor Information --}}
                <div class="col-md-6 mb-4">

                    <h5 class="mb-3">Visitor Information</h5>

                    <p>
                        <strong>Name:</strong><br>
                        {{ $contactMessage->name }}
                    </p>

                    <p>
                        <strong>Email:</strong><br>

                        <a href="mailto:{{ $contactMessage->email }}">
                            {{ $contactMessage->email }}
                        </a>
                    </p>

                    <p>
                        <strong>Phone:</strong><br>

                        @if($contactMessage->phone)
                            <a href="tel:{{ $contactMessage->phone }}">
                                {{ $contactMessage->phone }}
                            </a>
                        @else
                            <span class="text-muted">Not provided</span>
                        @endif
                    </p>

                </div>

                {{-- Message Information --}}
                <div class="col-md-6 mb-4">

                    <h5 class="mb-3">Message Information</h5>

                    <p>
                        <strong>Subject:</strong><br>
                        {{ $contactMessage->subject ?? '-' }}
                    </p>

                    <p>
                        <strong>Status:</strong><br>

                        @if($contactMessage->is_read)
                            <span class="badge bg-success">
                                Read
                            </span>
                        @else
                            <span class="badge bg-warning text-dark">
                                Unread
                            </span>
                        @endif
                    </p>

                    <p>
                        <strong>Received:</strong><br>
                        {{ $contactMessage->created_at->format('d M Y, h:i A') }}
                    </p>

                </div>

            </div>

            <hr>

            {{-- Message --}}
            <div class="mb-4">

                <h5 class="mb-3">Message</h5>

                <div class="border rounded p-3 bg-light">
                    {!! nl2br(e($contactMessage->message)) !!}
                </div>

            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2">

                @if($contactMessage->is_read)

                    <form
                        action="{{ route('contact-messages.mark-unread', $contactMessage) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="btn btn-secondary">
                            Mark as Unread
                        </button>
                    </form>

                @else

                    <form
                        action="{{ route('contact-messages.mark-read', $contactMessage) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="btn btn-success">
                            Mark as Read
                        </button>
                    </form>

                @endif

                <a
                    href="mailto:{{ $contactMessage->email }}"
                    class="btn btn-primary"
                >
                    Reply by Email
                </a>

                <form
                    action="{{ route('contact-messages.destroy', $contactMessage) }}"
                    method="POST"
                    class="delete-form"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>

            </div>

        </div>
    </div>

</div>

@endsection
