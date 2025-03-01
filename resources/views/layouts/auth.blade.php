<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="layout-navbar-fixed layout-menu-fixed customizer-hide" dir="ltr"
    data-theme="{{ config('app.theme') }}" data-assets-path="{{ config('app.assets_path') }}"
    data-template="{{ config('app.template') }}" data-style="{{ config('app.style') }}"
    data-primary-color="{{ config('app.primary_color') }}" data-themes="{{ config('app.themes') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>@yield('title') | {{ ucwords(str_replace('_', ' ', config('app.name')) ?? '-') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('averroes.svg') }}">

    <!-- SEO -->
    @include('layouts.layout_partials.seo')

    <!-- Styles -->
    @include('layouts.layout_partials.styles')

    <!-- Helpers -->
    @include('layouts.layout_partials.helpers')
    @include('layouts.layout_partials.pwa')
</head>

<body>
    {{-- <div class="loader">
        <div class="sk-fold sk-primary d-none d-lg-block m-2" style="width: 80px; height:80px">
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
        </div>
    </div> --}}
    @yield('content')

    <!-- Main JS -->
    @include('layouts.layout_partials.scripts')
    <script>
        let deferredPrompt;

        window.addEventListener("beforeinstallprompt", (event) => {
            event.preventDefault();
            deferredPrompt = event;

            const installBtn = document.createElement("button");
            installBtn.textContent = "Install Averroes Mobile";
            installBtn.classList.add("btn", "btn-primary", "position-fixed", "bottom-0", "end-0", "m-3");
            installBtn.style.zIndex = "1000";

            document.body.appendChild(installBtn);

            installBtn.addEventListener("click", () => {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === "accepted") {
                        console.log("User accepted the install prompt");
                    }
                    installBtn.remove();
                });
            });
        });
    </script>

</body>

</html>
