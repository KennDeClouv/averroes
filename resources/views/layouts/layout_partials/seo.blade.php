<meta name="description"
    content="Averroes - Web Sekolah Digital modern untuk manajemen jadwal, aktivitas pendidikan, dan kolaborasi siswa.">
<meta name="keywords" content="averroes, web sekolah digital, manajemen jadwal, aktivitas pendidikan, platform belajar">
<meta name="robots" content="index, follow">
<meta name="author" content="Averroes Digital Team">

<!-- Open Graph meta tags -->
<meta property="og:title" content="{{ ucwords(str_replace('_', ' ', config('app.name'))) }}">
<meta property="og:description" content="Web Sekolah Averroes Digital untuk manajemen jadwal dan aktivitas.">
<meta property="og:image" content="{{ asset('assets/img/og.png') }}">
<meta property="og:image:alt" content="Logo Averroes Digital - Platform Sekolah Modern">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:locale" content="{{ config('app.faker_locale') }}">
<meta property="og:locale:alternate" content="en_US">

<!-- Twitter Card meta tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ ucwords(str_replace('_', ' ', config('app.name'))) }}">
<meta name="twitter:description" content="Web Sekolah Averroes Digital untuk manajemen jadwal dan aktivitas.">
<meta name="twitter:image" content="{{ asset('assets/img/og.png') }}">
<meta name="twitter:url" content="{{ url()->current() }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">
