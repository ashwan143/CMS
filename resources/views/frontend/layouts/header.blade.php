<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            {{-- Logo / Company Name --}}
            <a
                href="{{ url('/') }}"
                class="navbar-brand fw-bold"
            >
                {{ $settings['company_name'] ?? $settings['site_name'] ?? 'Aviannextgen' }}
            </a>


            {{-- Mobile Toggle --}}
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavigation"
                aria-controls="mainNavigation"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>


            {{-- Navigation --}}
            <div
                class="collapse navbar-collapse"
                id="mainNavigation"
            >

                <ul class="navbar-nav ms-auto">

                    @foreach ($menus as $menu)

                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | Menu URL
                            |--------------------------------------------------------------------------
                            */

                            $hasChildren = $menu->children->isNotEmpty();

                            if ($menu->type === 'page' && $menu->page) {

                                $menuUrl = route('frontend.page', [
                                    'slug' => $menu->page->slug,
                                ]);

                            } elseif ($menu->type === 'external_url') {

                                $menuUrl = $menu->url;

                            } else {

                                $menuUrl = url(
                                    '/' . ltrim($menu->url ?? '', '/')
                                );

                            }

                            $isActive = request()->url() === $menuUrl;

                        @endphp


                        {{-- =====================================================
                            MENU WITH CHILDREN
                        ====================================================== --}}

                        @if ($hasChildren)

                            <li class="nav-item dropdown">

                                <a
                                    class="nav-link dropdown-toggle {{ $isActive ? 'active' : '' }}"
                                    href="{{ $menuUrl }}"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    target="{{ $menu->target }}"
                                >
                                    {{ $menu->title }}
                                </a>


                                <ul class="dropdown-menu">

                                    @foreach ($menu->children as $child)

                                        @php

                                            /*
                                            |--------------------------------------------------------------------------
                                            | Child Menu URL
                                            |--------------------------------------------------------------------------
                                            */

                                            if ($child->type === 'page' && $child->page) {

                                                $childUrl = route('frontend.page', [
                                                    'slug' => $child->page->slug,
                                                ]);

                                            } elseif ($child->type === 'external_url') {

                                                $childUrl = $child->url;

                                            } else {

                                                $childUrl = url(
                                                    '/' . ltrim($child->url ?? '', '/')
                                                );

                                            }

                                            $childIsActive = request()->url() === $childUrl;

                                        @endphp


                                        <li>

                                            <a
                                                class="dropdown-item {{ $childIsActive ? 'active' : '' }}"
                                                href="{{ $childUrl }}"
                                                target="{{ $child->target }}"
                                            >
                                                {{ $child->title }}
                                            </a>

                                        </li>

                                    @endforeach

                                </ul>

                            </li>


                        {{-- =====================================================
                            NORMAL MENU
                        ====================================================== --}}

                        @else

                            <li class="nav-item">

                                <a
                                    class="nav-link {{ $isActive ? 'active' : '' }}"
                                    href="{{ $menuUrl }}"
                                    target="{{ $menu->target }}"
                                >
                                    {{ $menu->title }}
                                </a>

                            </li>

                        @endif

                    @endforeach

                </ul>

            </div>

        </div>
    </nav>
</header>
