<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Aviannextgen')
    </title>

    <meta
        name="description"
        content="@yield('meta_description', 'Aviannextgen - Technology & Software Solutions')"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="{{ asset('frontend/css/style.css') }}"
    >

    @stack('styles')

</head>

<body>

    <div id="frontend-app">

        @include('frontend.layouts.header')

        <main>
            @yield('content')
        </main>

        @include('frontend.layouts.footer')

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <script src="{{ asset('frontend/js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>
