<footer class="bg-dark text-white py-5">

    <div class="container">

        <div class="row g-4">

            {{-- Company --}}
            <div class="col-lg-5">

                <h5 class="fw-bold mb-3">
                    {{ $settings['company_name'] ?? 'Aviannextgen' }}
                </h5>

                <p class="text-white-50 mb-0">
                    {{ $settings['site_tagline'] ?? 'Technology & Software Solutions' }}
                </p>

            </div>


            {{-- Contact --}}
            <div class="col-lg-4">

                <h6 class="fw-semibold mb-3">
                    Contact
                </h6>

                @if(!empty($settings['contact_email']))

                    <div class="mb-2">
                        <i class="bi bi-envelope me-2"></i>

                        <a
                            href="mailto:{{ $settings['contact_email'] }}"
                            class="text-white-50 text-decoration-none"
                        >
                            {{ $settings['contact_email'] }}
                        </a>
                    </div>

                @endif


                @if(!empty($settings['contact_phone']))

                    <div class="mb-2">
                        <i class="bi bi-telephone me-2"></i>

                        <a
                            href="tel:{{ $settings['contact_phone'] }}"
                            class="text-white-50 text-decoration-none"
                        >
                            {{ $settings['contact_phone'] }}
                        </a>
                    </div>

                @endif


                @if(!empty($settings['contact_address']))

                    <div class="text-white-50">
                        <i class="bi bi-geo-alt me-2"></i>
                        {{ $settings['contact_address'] }}
                    </div>

                @endif

            </div>


            {{-- Social --}}
            <div class="col-lg-3">

                <h6 class="fw-semibold mb-3">
                    Follow Us
                </h6>

                <div class="d-flex gap-3">

                    @if(!empty($settings['facebook_url']))
                        <a
                            href="{{ $settings['facebook_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-white"
                            aria-label="Facebook"
                        >
                            <i class="bi bi-facebook"></i>
                        </a>
                    @endif


                    @if(!empty($settings['instagram_url']))
                        <a
                            href="{{ $settings['instagram_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-white"
                            aria-label="Instagram"
                        >
                            <i class="bi bi-instagram"></i>
                        </a>
                    @endif


                    @if(!empty($settings['linkedin_url']))
                        <a
                            href="{{ $settings['linkedin_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-white"
                            aria-label="LinkedIn"
                        >
                            <i class="bi bi-linkedin"></i>
                        </a>
                    @endif


                    @if(!empty($settings['youtube_url']))
                        <a
                            href="{{ $settings['youtube_url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-white"
                            aria-label="YouTube"
                        >
                            <i class="bi bi-youtube"></i>
                        </a>
                    @endif

                </div>

            </div>

        </div>


        {{-- Bottom --}}
        <div class="border-top border-secondary mt-4 pt-4">

            <div class="d-flex flex-column flex-md-row justify-content-between gap-2">

                <small class="text-white-50">

                    {{ $settings['copyright_text'] ?? '© ' . date('Y') . ' Aviannextgen. All rights reserved.' }}

                </small>


                @if(!empty($settings['footer_text']))

                    <small class="text-white-50">
                        {{ $settings['footer_text'] }}
                    </small>

                @endif

            </div>

        </div>

    </div>

</footer>
