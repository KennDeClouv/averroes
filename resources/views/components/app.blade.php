<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="ltr" data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ ucwords(str_replace('_', ' ', env('APP_NAME'))) }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('averroes.svg') }}">

    <!-- SEO -->
    @include('components._partials.seo')

    <!-- Styles -->
    @include('components._partials.styles')

    <!-- Helpers -->
    @include('components._partials.helpers')
</head>


<body style="overflow-x: hidden">
    @include('components.alert')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Sidenav -->
            @include('components.sidenav')

            <div class="layout-page">
                <!-- Navbar -->
                @include('components.nav')

                <!-- Content -->
                <div class="content-wrapper">
                    @yield('content')

                    <!-- Footer -->
                    @include('components.footer')

                    <!-- Content Backdrop -->
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>

    <!-- Scripts -->
    @include('components._partials.scripts')
</body>

</html>
