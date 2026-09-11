@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                <i class="bi bi-gear me-2"></i>
                Settings
            </h4>

            <p class="text-muted mb-0">
                Manage your website and company configuration.
            </p>
        </div>

    </div>


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
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-triangle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Please fix the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        MAIN SETTINGS FORM
    ========================================================== --}}

    <form
        action="{{ route('settings.update') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')


        {{-- =====================================================
            GENERAL SETTINGS
        ====================================================== --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    <i class="bi bi-gear me-2"></i>
                    General Settings
                </h5>

                <small class="text-muted">
                    Basic website configuration.
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- Site Name --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Site Name
                        </label>

                        <input
                            type="text"
                            name="site_name"
                            class="form-control"
                            value="{{ old('site_name', setting('site_name')) }}"
                            placeholder="Your Company Name"
                        >

                    </div>


                    {{-- Site Tagline --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Site Tagline
                        </label>

                        <input
                            type="text"
                            name="site_tagline"
                            class="form-control"
                            value="{{ old('site_tagline', setting('site_tagline')) }}"
                            placeholder="Your company tagline"
                        >

                    </div>


                    {{-- Website Status --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Website Status
                        </label>

                        <select
                            name="website_status"
                            class="form-select"
                        >

                            <option
                                value="1"
                                @selected(
                                    (string) old(
                                        'website_status',
                                        setting('website_status', '1')
                                    ) === '1'
                                )
                            >
                                Online
                            </option>

                            <option
                                value="0"
                                @selected(
                                    (string) old(
                                        'website_status',
                                        setting('website_status', '1')
                                    ) === '0'
                                )
                            >
                                Maintenance
                            </option>

                        </select>

                    </div>


                    {{-- Maintenance Message --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Maintenance Message
                        </label>

                        <textarea
                            name="maintenance_message"
                            class="form-control"
                            rows="3"
                            placeholder="Website maintenance message"
                        >{{ old('maintenance_message', setting('maintenance_message')) }}</textarea>

                    </div>


                    {{-- Site Logo --}}

                    <div class="col-md-4">

                        <label class="form-label">
                            Site Logo
                        </label>

                        <input
                            type="file"
                            name="site_logo"
                            class="form-control image-input"
                            accept="image/*"
                            data-preview="site-logo-preview"
                        >

                        <div class="mt-3">

                            @if(setting('site_logo'))

                                <img
                                    id="site-logo-preview"
                                    src="{{ asset('storage/' . setting('site_logo')) }}"
                                    class="img-thumbnail"
                                    style="max-height:100px; max-width:220px;"
                                >

                            @else

                                <img
                                    id="site-logo-preview"
                                    class="img-thumbnail d-none"
                                    style="max-height:100px; max-width:220px;"
                                >

                            @endif

                        </div>


                        @if(setting('site_logo'))

                            <button
                                type="submit"
                                formaction="{{ route('settings.image.remove', 'site_logo') }}"
                                formmethod="POST"
                                class="btn btn-sm btn-outline-danger mt-2"
                                onclick="return confirm('Remove site logo?')"
                            >

                                @csrf
                                @method('DELETE')

                                <i class="bi bi-trash me-1"></i>
                                Remove Logo

                            </button>

                        @endif

                    </div>


                    {{-- Favicon --}}

                    <div class="col-md-4">

                        <label class="form-label">
                            Favicon
                        </label>

                        <input
                            type="file"
                            name="site_favicon"
                            class="form-control image-input"
                            accept="image/*"
                            data-preview="favicon-preview"
                        >

                        <div class="mt-3">

                            @if(setting('site_favicon'))

                                <img
                                    id="favicon-preview"
                                    src="{{ asset('storage/' . setting('site_favicon')) }}"
                                    class="img-thumbnail"
                                    style="height:80px; width:80px; object-fit:contain;"
                                >

                            @else

                                <img
                                    id="favicon-preview"
                                    class="img-thumbnail d-none"
                                    style="height:80px; width:80px; object-fit:contain;"
                                >

                            @endif

                        </div>


                        @if(setting('site_favicon'))

                            <button
                                type="submit"
                                formaction="{{ route('settings.image.remove', 'site_favicon') }}"
                                formmethod="POST"
                                class="btn btn-sm btn-outline-danger mt-2"
                                onclick="return confirm('Remove favicon?')"
                            >

                                @csrf
                                @method('DELETE')

                                <i class="bi bi-trash me-1"></i>
                                Remove Favicon

                            </button>

                        @endif

                    </div>


                </div>

            </div>

        </div>


        {{-- =====================================================
            CONTACT SETTINGS
        ====================================================== --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    <i class="bi bi-telephone me-2"></i>
                    Contact Information
                </h5>

                <small class="text-muted">
                    Public company contact information.
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- Email --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="contact_email"
                            class="form-control"
                            value="{{ old('contact_email', setting('contact_email')) }}"
                            placeholder="info@example.com"
                        >

                    </div>


                    {{-- Phone --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="contact_phone"
                            class="form-control"
                            value="{{ old('contact_phone', setting('contact_phone')) }}"
                            placeholder="+91 9876543210"
                        >

                    </div>


                    {{-- WhatsApp --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            WhatsApp
                        </label>

                        <input
                            type="text"
                            name="contact_whatsapp"
                            class="form-control"
                            value="{{ old('contact_whatsapp', setting('contact_whatsapp')) }}"
                            placeholder="+91 9876543210"
                        >

                    </div>


                    {{-- Google Maps --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Google Maps URL
                        </label>

                        <input
                            type="url"
                            name="google_maps_url"
                            class="form-control"
                            value="{{ old('google_maps_url', setting('google_maps_url')) }}"
                            placeholder="https://maps.google.com/..."
                        >

                    </div>


                    {{-- Address --}}

                    <div class="col-12">

                        <label class="form-label">
                            Address
                        </label>

                        <textarea
                            name="contact_address"
                            class="form-control"
                            rows="3"
                            placeholder="Company address"
                        >{{ old('contact_address', setting('contact_address')) }}</textarea>

                    </div>


                </div>

            </div>

        </div>


        {{-- =====================================================
            SOCIAL MEDIA
        ====================================================== --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    <i class="bi bi-share me-2"></i>
                    Social Media
                </h5>

                <small class="text-muted">
                    Add your official social media profiles.
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">

                    @php

                        $socialFields = [

                            'facebook_url' => 'Facebook',

                            'instagram_url' => 'Instagram',

                            'linkedin_url' => 'LinkedIn',

                            'youtube_url' => 'YouTube',

                            'twitter_url' => 'Twitter / X',

                            'github_url' => 'GitHub',

                        ];

                    @endphp


                    @foreach($socialFields as $key => $label)

                        <div class="col-md-6">

                            <label class="form-label">
                                {{ $label }}
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-link-45deg"></i>
                                </span>

                                <input
                                    type="url"
                                    name="{{ $key }}"
                                    class="form-control"
                                    value="{{ old($key, setting($key)) }}"
                                    placeholder="https://..."
                                >

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>


        {{-- =====================================================
            SEO SETTINGS
        ====================================================== --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    <i class="bi bi-search me-2"></i>
                    SEO Settings
                </h5>

                <small class="text-muted">
                    Search engine and analytics configuration.
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- Meta Title --}}

                    <div class="col-12">

                        <label class="form-label">
                            Meta Title
                        </label>

                        <input
                            type="text"
                            name="meta_title"
                            class="form-control"
                            value="{{ old('meta_title', setting('meta_title')) }}"
                            placeholder="Your website title"
                        >

                    </div>


                    {{-- Meta Description --}}

                    <div class="col-12">

                        <label class="form-label">
                            Meta Description
                        </label>

                        <textarea
                            name="meta_description"
                            class="form-control"
                            rows="4"
                            placeholder="Website meta description"
                        >{{ old('meta_description', setting('meta_description')) }}</textarea>

                    </div>


                    {{-- Meta Keywords --}}

                    <div class="col-12">

                        <label class="form-label">
                            Meta Keywords
                        </label>

                        <input
                            type="text"
                            name="meta_keywords"
                            class="form-control"
                            value="{{ old('meta_keywords', setting('meta_keywords')) }}"
                            placeholder="software, technology, web development"
                        >

                    </div>


                    {{-- Google Analytics --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Google Analytics ID
                        </label>

                        <input
                            type="text"
                            name="google_analytics_id"
                            class="form-control"
                            value="{{ old('google_analytics_id', setting('google_analytics_id')) }}"
                            placeholder="G-XXXXXXXXXX"
                        >

                    </div>


                    {{-- Search Console --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Google Search Console Verification
                        </label>

                        <input
                            type="text"
                            name="google_search_console"
                            class="form-control"
                            value="{{ old('google_search_console', setting('google_search_console')) }}"
                            placeholder="Verification code"
                        >

                    </div>


                </div>

            </div>

        </div>


        {{-- =====================================================
            COMPANY INFORMATION
        ====================================================== --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    <i class="bi bi-building me-2"></i>
                    Company Information
                </h5>

                <small class="text-muted">
                    Core company information.
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- Company Name --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Company Name
                        </label>

                        <input
                            type="text"
                            name="company_name"
                            class="form-control"
                            value="{{ old('company_name', setting('company_name')) }}"
                            placeholder="Your company name"
                        >

                    </div>


                    {{-- Founded Year --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            Founded Year
                        </label>

                        <input
                            type="number"
                            name="company_founded_year"
                            class="form-control"
                            value="{{ old('company_founded_year', setting('company_founded_year')) }}"
                            placeholder="{{ date('Y') }}"
                        >

                    </div>


                    {{-- Company About --}}

                    <div class="col-12">

                        <label class="form-label">
                            Short About
                        </label>

                        <textarea
                            name="company_about"
                            class="form-control"
                            rows="5"
                            placeholder="Short company description"
                        >{{ old('company_about', setting('company_about')) }}</textarea>

                    </div>


                    {{-- Registration --}}

                    <div class="col-12">

                        <label class="form-label">
                            GST / Registration Information
                        </label>

                        <textarea
                            name="company_registration"
                            class="form-control"
                            rows="3"
                            placeholder="GST, CIN, registration information..."
                        >{{ old('company_registration', setting('company_registration')) }}</textarea>

                    </div>


                </div>

            </div>

        </div>


        {{-- =====================================================
            FOOTER SETTINGS
        ====================================================== --}}

        <div class="card shadow-sm mb-5">

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    <i class="bi bi-layout-text-window-reverse me-2"></i>
                    Footer Settings
                </h5>

                <small class="text-muted">
                    Website footer configuration.
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- Footer Text --}}

                    <div class="col-12">

                        <label class="form-label">
                            Footer Text
                        </label>

                        <textarea
                            name="footer_text"
                            class="form-control"
                            rows="3"
                            placeholder="Footer description"
                        >{{ old('footer_text', setting('footer_text')) }}</textarea>

                    </div>


                    {{-- Copyright --}}

                    <div class="col-md-8">

                        <label class="form-label">
                            Copyright Text
                        </label>

                        <input
                            type="text"
                            name="copyright_text"
                            class="form-control"
                            value="{{ old('copyright_text', setting('copyright_text')) }}"
                            placeholder="© {{ date('Y') }} Your Company. All Rights Reserved."
                        >

                    </div>


                    {{-- Footer Logo --}}

                    <div class="col-md-4">

                        <label class="form-label">
                            Footer Logo
                        </label>

                        <input
                            type="file"
                            name="footer_logo"
                            class="form-control image-input"
                            accept="image/*"
                            data-preview="footer-logo-preview"
                        >


                        <div class="mt-3">

                            @if(setting('footer_logo'))

                                <img
                                    id="footer-logo-preview"
                                    src="{{ asset('storage/' . setting('footer_logo')) }}"
                                    class="img-thumbnail"
                                    style="max-height:100px; max-width:220px;"
                                >

                            @else

                                <img
                                    id="footer-logo-preview"
                                    class="img-thumbnail d-none"
                                    style="max-height:100px; max-width:220px;"
                                >

                            @endif

                        </div>


                        @if(setting('footer_logo'))

                            <button
                                type="submit"
                                formaction="{{ route('settings.image.remove', 'footer_logo') }}"
                                formmethod="POST"
                                class="btn btn-sm btn-outline-danger mt-2"
                                onclick="return confirm('Remove footer logo?')"
                            >

                                @csrf
                                @method('DELETE')

                                <i class="bi bi-trash me-1"></i>
                                Remove Logo

                            </button>

                        @endif

                    </div>


                </div>

            </div>

        </div>


        {{-- =====================================================
            SAVE BUTTON
        ====================================================== --}}

        <div class="d-flex justify-content-end mb-5">

            <button
                type="submit"
                class="btn btn-primary px-4">

                <i class="bi bi-check-lg me-1"></i>

                Save Settings

            </button>

        </div>


    </form>


</div>


{{-- =============================================================
    IMAGE PREVIEW SCRIPT
============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.image-input').forEach(function (input) {

        input.addEventListener('change', function (event) {

            const file = event.target.files[0];

            const previewId = input.dataset.preview;

            const preview = document.getElementById(previewId);

            if (!file || !preview) {
                return;
            }

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                preview.src = e.target.result;

                preview.classList.remove('d-none');

            };

            reader.readAsDataURL(file);

        });

    });

});

</script>

@endsection
