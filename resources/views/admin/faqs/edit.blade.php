@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit FAQ</h1>
            <p class="text-muted mb-0">Update FAQ information.</p>
        </div>

        <a href="{{ route('faqs.index') }}" class="btn btn-secondary">
            Back to FAQs
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('faqs.update', $faq) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Question --}}
                    <div class="col-md-6 mb-3">
                        <label for="question" class="form-label">
                            Question <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="question"
                            id="question"
                            class="form-control @error('question') is-invalid @enderror"
                            value="{{ old('question', $faq->question) }}"
                            required
                        >

                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $faq->slug) }}"
                        >

                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Short Question --}}
                    <div class="col-md-6 mb-3">
                        <label for="short_question" class="form-label">
                            Short Question
                        </label>

                        <input
                            type="text"
                            name="short_question"
                            id="short_question"
                            class="form-control @error('short_question') is-invalid @enderror"
                            value="{{ old('short_question', $faq->short_question) }}"
                        >

                        @error('short_question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">
                            Category
                        </label>

                        <input
                            type="text"
                            name="category"
                            id="category"
                            class="form-control @error('category') is-invalid @enderror"
                            value="{{ old('category', $faq->category) }}"
                        >

                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Answer --}}
                    <div class="col-md-12 mb-3">
                        <label for="answer" class="form-label">
                            Answer <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="answer"
                            id="answer"
                            rows="8"
                            class="form-control @error('answer') is-invalid @enderror"
                            required
                        >{{ old('answer', $faq->answer) }}</textarea>

                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Display Order --}}
                    <div class="col-md-4 mb-3">
                        <label for="order" class="form-label">
                            Display Order
                        </label>

                        <input
                            type="number"
                            name="order"
                            id="order"
                            class="form-control @error('order') is-invalid @enderror"
                            value="{{ old('order', $faq->order) }}"
                            min="0"
                        >

                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label d-block">
                            Status
                        </label>

                        <div class="form-check form-switch mt-2">

                            <input
                                type="hidden"
                                name="status"
                                value="0"
                            >

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                id="status"
                                value="1"
                                {{ old('status', $faq->status) ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="status">
                                Active
                            </label>

                        </div>
                    </div>

                    {{-- Featured --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label d-block">
                            Featured
                        </label>

                        <div class="form-check form-switch mt-2">

                            <input
                                type="hidden"
                                name="is_featured"
                                value="0"
                            >

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_featured"
                                id="is_featured"
                                value="1"
                                {{ old('is_featured', $faq->is_featured) ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="is_featured">
                                Featured FAQ
                            </label>

                        </div>
                    </div>

                    {{-- SEO Title --}}
                    <div class="col-md-12 mb-3">
                        <label for="seo_title" class="form-label">
                            SEO Title
                        </label>

                        <input
                            type="text"
                            name="seo_title"
                            id="seo_title"
                            class="form-control @error('seo_title') is-invalid @enderror"
                            value="{{ old('seo_title', $faq->seo_title) }}"
                        >

                        @error('seo_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- SEO Keywords --}}
                    <div class="col-md-12 mb-3">
                        <label for="seo_keywords" class="form-label">
                            SEO Keywords
                        </label>

                        <textarea
                            name="seo_keywords"
                            id="seo_keywords"
                            rows="2"
                            class="form-control @error('seo_keywords') is-invalid @enderror"
                        >{{ old('seo_keywords', $faq->seo_keywords) }}</textarea>

                        @error('seo_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- SEO Description --}}
                    <div class="col-md-12 mb-3">
                        <label for="seo_description" class="form-label">
                            SEO Description
                        </label>

                        <textarea
                            name="seo_description"
                            id="seo_description"
                            rows="3"
                            class="form-control @error('seo_description') is-invalid @enderror"
                        >{{ old('seo_description', $faq->seo_description) }}</textarea>

                        @error('seo_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Update FAQ
                    </button>

                    <a href="{{ route('faqs.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
