<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>@yield('title') | {{ ucwords(str_replace('_', ' ', env('APP_NAME')) ?? '-') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('averroes.svg') }}">

    <!-- SEO -->
    @include('components._partials.seo')

    <!-- Styles -->
    @include('components._partials.styles')

    <!-- Helpers -->
    @include('components._partials.helpers')
</head>

<body>
    <div class="loader">
        <div class="sk-fold sk-primary d-none d-lg-block m-2" style="width: 80px; height:80px">
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
        </div>
    </div>
    @yield('content')

    <!-- Main JS -->
    @include('components._partials.scripts')
</body>

</html>
