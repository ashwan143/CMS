

@extends('frontend.layouts.app')

@section('title', 'Aviannextgen | Technology & Software Solutions')

@section('content')



{{-- =========================================================
     1. HOMEPAGE HERO / CMS SLIDERS
========================================================= --}}

@if($sliders->isNotEmpty())

    <section class="aviannextgen-hero hero-slider-wrapper">

        <div
            id="homeHeroSlider"
            class="carousel slide carousel-fade"
            data-bs-ride="carousel"
            data-bs-interval="6000"
        >

            <div class="carousel-inner">

                @foreach($sliders as $index => $slider)

                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">

                        <section
                            class="aviannextgen-hero-slide"
                            style="
                                background-image:
                                    linear-gradient(
                                        90deg,
                                        rgba(5,15,30,.90) 0%,
                                        rgba(5,15,30,.68) 52%,
                                        rgba(5,15,30,.40) 100%
                                    ),
                                    url('{{ asset('storage/' . $slider->image) }}');
                            "
                        >

                            <div class="container">

                                <div class="row align-items-center min-vh-100 py-5">

                                    <div class="col-lg-7">

                                        <div class="hero-badge mb-4">

                                            <span class="hero-badge-dot"></span>

                                            {{ $settings['site_tagline'] ?? 'Technology & Software Solutions' }}

                                        </div>


                                        <h1 class="hero-title text-white">

                                            {{ $slider->title }}

                                        </h1>


                                        @if($slider->subtitle)

                                            <p class="hero-description text-white-50">

                                                {{ $slider->subtitle }}

                                            </p>

                                        @endif


                                        @if($slider->button_text && $slider->button_url)

                                            <div class="hero-actions">

                                                <a
                                                    href="{{ $slider->button_url }}"
                                                    target="{{ $slider->button_target }}"
                                                    class="btn btn-primary btn-lg rounded-pill px-4"
                                                    @if($slider->button_target === '_blank')
                                                        rel="noopener noreferrer"
                                                    @endif
                                                >

                                                    {{ $slider->button_text }}

                                                    <i class="bi bi-arrow-up-right ms-2"></i>

                                                </a>

                                            </div>

                                        @endif

                                    </div>


                                    <div class="col-lg-5 d-none d-lg-block">

                                        <div class="hero-visual-card">

                                            <div class="hero-window-bar">

                                                <div class="hero-window-dots">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>

                                                <span>
                                                    aviannextgen
                                                </span>

                                            </div>


                                            <div class="hero-window-body">

                                                <div class="small text-white-50 mb-2">
                                                    DIGITAL SOLUTIONS
                                                </div>

                                                <h3 class="text-white fw-bold mb-4">
                                                    Build.
                                                    <span class="text-info">
                                                        Scale.
                                                    </span>
                                                    Evolve.
                                                </h3>


                                                <div class="hero-feature">

                                                    <div class="hero-feature-icon">
                                                        <i class="bi bi-lightbulb"></i>
                                                    </div>

                                                    <div>
                                                        <strong>
                                                            Innovation
                                                        </strong>

                                                        <small>
                                                            Ideas into digital products
                                                        </small>
                                                    </div>

                                                </div>


                                                <div class="hero-feature">

                                                    <div class="hero-feature-icon">
                                                        <i class="bi bi-code-slash"></i>
                                                    </div>

                                                    <div>
                                                        <strong>
                                                            Engineering
                                                        </strong>

                                                        <small>
                                                            Strong technical foundations
                                                        </small>
                                                    </div>

                                                </div>


                                                <div class="hero-feature">

                                                    <div class="hero-feature-icon">
                                                        <i class="bi bi-graph-up-arrow"></i>
                                                    </div>

                                                    <div>
                                                        <strong>
                                                            Growth
                                                        </strong>

                                                        <small>
                                                            Ready for tomorrow
                                                        </small>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </section>

                    </div>

                @endforeach

            </div>


            @if($sliders->count() > 1)

                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#homeHeroSlider"
                    data-bs-slide="prev"
                    aria-label="Previous slide"
                >
                    <span
                        class="carousel-control-prev-icon"
                        aria-hidden="true"
                    ></span>
                </button>


                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#homeHeroSlider"
                    data-bs-slide="next"
                    aria-label="Next slide"
                >
                    <span
                        class="carousel-control-next-icon"
                        aria-hidden="true"
                    ></span>
                </button>


                <div class="carousel-indicators">

                    @foreach($sliders as $index => $slider)

                        <button
                            type="button"
                            data-bs-target="#homeHeroSlider"
                            data-bs-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}"
                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"
                        ></button>

                    @endforeach

                </div>

            @endif

        </div>

    </section>

@else

    {{-- =====================================================
         FALLBACK HERO
    ====================================================== --}}

    <section class="hero-section">

        <div class="hero-grid"></div>

        <div class="container position-relative">

            <div class="row align-items-center min-vh-100 py-5">

                <div class="col-lg-7">

                    <div class="hero-badge mb-4">

                        <span class="hero-badge-dot"></span>

                        {{ $settings['site_tagline'] ?? 'Technology & Software Solutions' }}

                    </div>

                    <h1 class="hero-title">

                        We build
                        <span class="gradient-text">
                            digital experiences
                        </span>
                        that move businesses forward.

                    </h1>

                    <p class="hero-description">

                        {{ $settings['company_about'] ??
                            'Aviannextgen helps businesses turn bold ideas into powerful software, websites and digital products designed for growth.'
                        }}

                    </p>

                </div>

            </div>

        </div>

    </section>

@endif



{{-- =========================================================
     2. SERVICES
========================================================= --}}

<section class="section-padding bg-light" id="services">

    <div class="container">

        <div class="section-heading text-center">

            <span class="section-label">
                OUR SERVICES
            </span>

            <h2>
                Technology solutions
                <span class="gradient-text-dark">
                    built around your goals.
                </span>
            </h2>

            <p>
                We combine technology, creativity and strategy to
                build solutions that solve real business problems.
            </p>

        </div>


        @if($services->isNotEmpty())

            <div class="row g-4 mt-4">

                @foreach($services as $service)

                    <div class="col-lg-4 col-md-6">

                        <div class="service-card">

                            {{-- Icon --}}
                            <div class="service-icon">

                                @if($service->icon)

                                    <i class="{{ $service->icon }}"></i>

                                @else

                                    <i class="bi bi-code-slash"></i>

                                @endif

                            </div>


                            {{-- Title --}}
                            <h4>
                                {{ $service->title }}
                            </h4>


                            {{-- Description --}}
                            @if($service->short_description)

                                <p>
                                    {{ $service->short_description }}
                                </p>

                            @elseif($service->description)

                                <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 160) }}
                                </p>

                            @endif


                            {{-- Link --}}
                            <a
                                href="{{ url('/services/' . $service->slug) }}"
                            >
                                Learn more

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>


        @else

            {{-- =================================================
                 FALLBACK
            ================================================== --}}

            <div class="row justify-content-center mt-4">

                <div class="col-lg-7">

                    <div class="text-center p-5 bg-white rounded-4 border">

                        <div class="service-icon mx-auto mb-4">

                            <i class="bi bi-grid"></i>

                        </div>

                        <h4>
                            Our services are coming soon.
                        </h4>

                        <p class="text-muted mb-0">
                            We're preparing our technology services.
                            Please check back soon.
                        </p>

                    </div>

                </div>

            </div>

        @endif

    </div>

</section>


{{-- =========================================================
     3. ABOUT
========================================================= --}}

<section class="section-padding" id="about">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <span class="section-label">
                    ABOUT AVIANNEXTGEN
                </span>

                <h2 class="section-title">
                    We turn ambitious ideas into
                    <span class="gradient-text-dark">
                        meaningful digital products.
                    </span>
                </h2>

                <p class="text-muted fs-5">
                    We believe technology should simplify business,
                    improve experiences and create measurable value.
                </p>

                <p class="text-muted">
                    Aviannextgen brings together engineering, design
                    and business thinking to create digital solutions
                    that are practical today and ready for tomorrow.
                </p>

                <a
                    href="#contact"
                    class="btn btn-dark rounded-pill px-4 mt-3"
                >
                    Work With Us
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>

            </div>

            <div class="col-lg-6">

                <div class="about-panel">

                    <div class="about-stat">
                        <strong>01</strong>
                        <span>Strategy</span>
                    </div>

                    <div class="about-stat">
                        <strong>02</strong>
                        <span>Design</span>
                    </div>

                    <div class="about-stat">
                        <strong>03</strong>
                        <span>Engineering</span>
                    </div>

                    <div class="about-stat">
                        <strong>04</strong>
                        <span>Growth</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     4. TECHNOLOGIES
========================================================= --}}

<section class="section-padding dark-section" id="technologies">

    <div class="container">

        <div class="row align-items-end mb-5">

            <div class="col-lg-7">

                <span class="section-label light">
                    TECHNOLOGIES
                </span>

                <h2 class="text-white section-title">
                    Built with modern
                    <span class="gradient-text">
                        technology.
                    </span>
                </h2>

            </div>

            <div class="col-lg-5">

                <p class="text-white-50">
                    We choose reliable technologies that help us
                    create secure, scalable and maintainable products.
                </p>

            </div>

        </div>


        @if($technologies->isNotEmpty())

            <div class="technology-cloud">

                @foreach($technologies as $technology)

                    <div class="technology-pill">

                        @if($technology->icon)

                            <img
                                src="{{ asset('storage/' . $technology->icon) }}"
                                alt="{{ $technology->name }}"
                                width="24"
                                height="24"
                                style="object-fit:contain;"
                            >

                        @else

                            <i class="bi bi-cpu"></i>

                        @endif

                        <span>
                            {{ $technology->name }}
                        </span>

                    </div>

                @endforeach

            </div>


        @else

            <div class="text-center py-5">

                <div class="text-white-50 mb-3">
                    <i class="bi bi-cpu fs-1"></i>
                </div>

                <h5 class="text-white">
                    Technologies coming soon.
                </h5>

                <p class="text-white-50 mb-0">
                    Our technology stack will appear here.
                </p>

            </div>

        @endif

    </div>

</section>
{{-- =========================================================
     5. PROJECTS
========================================================= --}}

<section class="section-padding bg-light" id="projects">

    <div class="container">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">

            <div>

                <span class="section-label">
                    OUR WORK
                </span>

                <h2 class="section-title mb-0">
                    Selected projects
                </h2>

            </div>

            <a
                href="#contact"
                class="btn btn-outline-dark rounded-pill px-4 mt-3 mt-md-0"
            >
                Start a Project
                <i class="bi bi-arrow-up-right ms-1"></i>
            </a>

        </div>


        @if($projects->isNotEmpty())

            <div class="row g-4">

                @foreach($projects as $project)

                    <div class="col-lg-6">

                        <a
                            href="{{ url('/projects/' . $project->slug) }}"
                            class="project-card project-large d-block"
                            @if($project->project_url)
                                target="_blank"
                                rel="noopener noreferrer"
                            @endif
                        >

                            {{-- Project Image --}}
                            @if($project->image)

                                <img
                                    src="{{ asset('storage/' . $project->image) }}"
                                    alt="{{ $project->title }}"
                                    class="project-image"
                                >

                            @endif


                            {{-- Overlay --}}
                            <div class="project-overlay"></div>


                            {{-- Content --}}
                            <div class="project-content">

                                @if($project->category)

                                    <span>
                                        {{ strtoupper($project->category) }}
                                    </span>

                                @else

                                    <span>
                                        PROJECT
                                    </span>

                                @endif


                                <h3>
                                    {{ $project->title }}
                                </h3>


                                @if($project->short_description)

                                    <p class="project-description">
                                        {{ $project->short_description }}
                                    </p>

                                @endif


                                <div class="d-flex align-items-center gap-2 mt-3">

                                    <span class="project-link">
                                        View Project

                                        <i class="bi bi-arrow-up-right"></i>
                                    </span>

                                </div>

                            </div>

                        </a>

                    </div>

                @endforeach

            </div>


        @else

            {{-- =================================================
                 FALLBACK
            ================================================== --}}

            <div class="row justify-content-center">

                <div class="col-lg-7">

                    <div class="text-center bg-white border rounded-4 p-5">

                        <div class="service-icon mx-auto mb-4">

                            <i class="bi bi-briefcase"></i>

                        </div>

                        <h4>
                            Projects coming soon.
                        </h4>

                        <p class="text-muted mb-0">
                            Our latest work will appear here soon.
                        </p>

                    </div>

                </div>

            </div>

        @endif

    </div>

</section>

{{-- =========================================================
     6. CLIENTS
========================================================= --}}

<section class="section-padding" id="clients">

    <div class="container">

        <div class="section-heading text-center">

            <span class="section-label">
                OUR CLIENTS
            </span>

            <h2>
                Trusted by businesses
                <span class="gradient-text-dark">
                    moving forward.
                </span>
            </h2>

            <p>
                We work with businesses to create practical digital
                solutions and lasting technology partnerships.
            </p>

        </div>


        @if($clients->isNotEmpty())

            <div class="row g-4 mt-4">

                @foreach($clients as $client)

                    <div class="col-6 col-md-4 col-lg-3">

                        <div class="client-card">

                            <div class="client-logo">

                                @if($client->logo)

                                    <img
                                        src="{{ asset('storage/' . $client->logo) }}"
                                        alt="{{ $client->name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <span class="client-name-placeholder">
                                        {{ $client->name }}
                                    </span>

                                @endif

                            </div>


                            <div class="client-info">

                                <h6>
                                    {{ $client->name }}
                                </h6>

                                @if($client->industry)

                                    <span>
                                        {{ $client->industry }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center py-5">

                <div class="client-empty-icon mb-3">
                    <i class="bi bi-buildings"></i>
                </div>

                <h5>
                    Our clients are coming soon.
                </h5>

                <p class="text-muted mb-0">
                    Client partnerships will appear here.
                </p>

            </div>

        @endif

    </div>

</section>

{{-- =========================================================
     TESTIMONIALS
========================================================= --}}

<section class="section-padding bg-light" id="testimonials">
    <div class="container">

        <div class="section-heading text-center">
            <span class="section-label">TESTIMONIALS</span>

            <h2>
                What our
                <span class="gradient-text-dark">clients say.</span>
            </h2>

            <p>
                Real feedback from businesses that have worked with Aviannextgen.
            </p>
        </div>

        @if($testimonials->isNotEmpty())

            <div class="row g-4 mt-4">

                @foreach($testimonials as $testimonial)

                    <div class="col-md-6 col-lg-4">

                        <div class="testimonial-card h-100">

                            {{-- Rating --}}
                            <div class="testimonial-stars mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $testimonial->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>

                            {{-- Testimonial --}}
                            <div class="testimonial-quote">
                                <i class="bi bi-quote"></i>

                                <p>
                                    {{ $testimonial->testimonial }}
                                </p>
                            </div>

                            {{-- Client --}}
                            <div class="testimonial-author">

                                @if($testimonial->client_photo)
                                    <img
                                        src="{{ asset('storage/' . $testimonial->client_photo) }}"
                                        alt="{{ $testimonial->photo_alt ?: $testimonial->client_name }}"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="testimonial-avatar">
                                        {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                                    </div>
                                @endif

                                <div>
                                    <h6>{{ $testimonial->client_name }}</h6>

                                    @if($testimonial->designation)
                                        <span>{{ $testimonial->designation }}</span>
                                    @endif

                                    @if($testimonial->company_name)
                                        <small>{{ $testimonial->company_name }}</small>
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center py-5">

                <div class="testimonial-empty-icon mb-3">
                    <i class="bi bi-chat-quote"></i>
                </div>

                <h5>No testimonials available yet.</h5>

                <p class="text-muted mb-0">
                    Client testimonials will appear here once added from the CMS.
                </p>

            </div>

        @endif

    </div>
</section>


{{-- =========================================================
     6. WHY CHOOSE US
========================================================= --}}

<section class="section-padding" id="why-us">

    <div class="container">

        <div class="section-heading text-center">

            <span class="section-label">
                WHY AVIANNEXTGEN
            </span>

            <h2>
                Built around
                <span class="gradient-text-dark">
                    outcomes.
                </span>
            </h2>

            <p>
                We focus on creating technology that makes a
                difference to the businesses we work with.
            </p>

        </div>

        <div class="row g-4 mt-4">

            <div class="col-lg-3 col-md-6">

                <div class="why-card">

                    <span>01</span>

                    <i class="bi bi-bullseye"></i>

                    <h5>
                        Business First
                    </h5>

                    <p>
                        Technology decisions are always connected
                        to your actual business goals.
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="why-card">

                    <span>02</span>

                    <i class="bi bi-lightning-charge"></i>

                    <h5>
                        Fast Execution
                    </h5>

                    <p>
                        Clear communication and focused development
                        keep projects moving.
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="why-card">

                    <span>03</span>

                    <i class="bi bi-shield-check"></i>

                    <h5>
                        Reliable Quality
                    </h5>

                    <p>
                        We build with performance, security and
                        maintainability in mind.
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="why-card">

                    <span>04</span>

                    <i class="bi bi-graph-up-arrow"></i>

                    <h5>
                        Built to Grow
                    </h5>

                    <p>
                        Our solutions are designed to evolve
                        alongside your business.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     7. TESTIMONIALS
========================================================= --}}

<section class="section-padding bg-light" id="testimonials">

    <div class="container">

        <div class="section-heading text-center">

            <span class="section-label">
                CLIENT FEEDBACK
            </span>

            <h2>
                What our clients
                <span class="gradient-text-dark">
                    say about us.
                </span>
            </h2>

        </div>

        <div class="row g-4 mt-4">

            <div class="col-lg-4">

                <div class="service-card">

                    <div class="mb-3 text-warning">
                        ★★★★★
                    </div>

                    <p>
                        “Aviannextgen helped us turn our idea into a
                        professional digital product. The process was
                        smooth and the team understood our goals.”
                    </p>

                    <strong>
                        Business Client
                    </strong>

                    <small class="text-muted d-block">
                        CEO & Founder
                    </small>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="service-card">

                    <div class="mb-3 text-warning">
                        ★★★★★
                    </div>

                    <p>
                        “The team was responsive, professional and
                        focused on delivering a solution that actually
                        worked for our business.”
                    </p>

                    <strong>
                        Technology Client
                    </strong>

                    <small class="text-muted d-block">
                        Managing Director
                    </small>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="service-card">

                    <div class="mb-3 text-warning">
                        ★★★★★
                    </div>

                    <p>
                        “We appreciated the combination of technical
                        expertise and practical business thinking
                        throughout the project.”
                    </p>

                    <strong>
                        Enterprise Client
                    </strong>

                    <small class="text-muted d-block">
                        Product Lead
                    </small>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     8. CTA
========================================================= --}}

<section class="cta-section" id="contact">

    <div class="container">

        <div class="cta-panel">

            <div class="position-relative">

                <span class="section-label light">
                    LET'S BUILD SOMETHING GREAT
                </span>

                <h2>
                    Have an idea?
                    <br>
                    Let's make it real.
                </h2>

                <p>
                    Tell us what you're building and let's explore
                    how Aviannextgen can help bring it to life.
                </p>

                <a
                    href="#"
                    class="btn btn-light btn-lg rounded-pill px-4"
                >
                    Start a Conversation
                    <i class="bi bi-arrow-up-right ms-2"></i>
                </a>

            </div>

        </div>

    </div>

</section>

@endsection
