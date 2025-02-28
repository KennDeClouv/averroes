<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Averroes Digital Islamic School</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/averroes.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/nav.css') }}" />
</head>

<body class="pb-5" data-bs-theme="light">
    <!-- nav -->
    <div class="menu-float is-visible">
        <div class="inner">
            <div class="menu-float__inner">
                <div class="menu-float__wrapper bg-dark bg-opacity-50">
                    <div class="menu-float__layout menu-float__layout--primary">
                        <div class="menu-float__content">
                            <a href="/" class="menu-float__logo">
                                <img src="{{ asset('assets/img/averroes.png') }}" alt="" style="padding: 2px" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-float__wrapper bg-dark bg-opacity-50 mx-1">
                    <div class="menu-float__bottom">
                        <div class="menu-float__layout menu-float__layout--secondary m-0">
                            <div class="menu-float__content">
                                <div class="menu-float__progress">
                                    <div class="menu-float__bar js-menu-progress"></div>
                                </div>
                                <ul class="menu-float__nav m-0 p-0">
                                    <li>
                                        <a class="menu-float__item js-menu-anchor m-0 is-active" href="#home"
                                            data-target="home">Beranda</a>
                                    </li>
                                    <li>
                                        <a class="menu-float__item js-menu-anchor" href="#jurusan"
                                            data-target="jurusan">Tentang</a>
                                    </li>
                                    <li>
                                        <a class="menu-float__item js-menu-anchor" href="#mengapa"
                                            data-target="ppdb">PPDB</a>
                                    </li>
                                    <li>
                                        <a class="menu-float__item js-menu-anchor" href="">Kontak</a>
                                    </li>
                                    <li>
                                        <a class="menu-float__item js-menu-anchor" href="">Karya siswa</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-float__wrapper bg-dark bg-opacity-50">
                    <div class="menu-float__bottom">
                        <div class="menu-float__layout menu-float__layout">
                            <div class="menu-float__content p-0">
                                <strong>
                                    <a target="_blank" href="{{ route('login') }}"
                                        class="btn btn-primary text-decoration-none py-3 px-4">daftar</a>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /nav -->

    <!-- header -->
    <section class="" id="home">
        <div class="container vh-100 vw-100 pb-5">
            <div class="row align-items-center h-100">
                <div class="col-6 text-primary">
                    <h1 class="display-1 fw-normal">Averroes Digital Islamic School</h1>
                    <h2 class="opacity-50">Jiwanya santri, skillnya it.</h2>
                </div>
                <div class="col-6 p-5">
                    <img src="assets/img/banner.png" alt="banner" class="w-100" />
                </div>
            </div>
        </div>
    </section>
    <!-- / header -->
    <!-- jurusan -->
    <section id="jurusan">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 px-5">
                    <div class="rounded-3 bg-primary text-light p-4 shadow-lg">
                        <h2>Jurusan RPL</h2>
                        <p style="line-height: 140%">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero
                            reprehenderit minus dolorum odio! Unde nihil voluptate neque
                            accusamus officia dignissimos porro, obcaecati eaque, nisi hic
                            minima eum aliquid odit omnis!
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 px-5">
                    <div class="rounded-3 shadow-lg text-primary p-4">
                        <h2>Jurusan DKV</h2>
                        <p style="line-height: 140%">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero
                            reprehenderit minus dolorum odio! Unde nihil voluptate neque
                            accusamus officia dignissimos porro, obcaecati eaque, nisi hic
                            minima eum aliquid odit omnis!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / jurusan -->
    <!-- mengapa -->
    <section id="mengapa">
        <div class="container min-vh-100" style="background: url(assets/img/bg.png) center / cover">
            <div class="mt-5 d-flex flex-column">
                <div class="mx-auto d-flex flex-column">
                    <div class="rounded bg-secondary mx-auto" style="width: 150px;height: 8px;"></div>
                    <h2 class="text-primary fs-1 mt-2">Mengapa sekolah di ADIS</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 p-0">
                    <div class="rounded bg-primary bg-opacity-50">
                        <div class="row my-5">
                            <div class="col-4 p-0"><img src="assets/img/01.png" alt="" class="w-100"></div>
                            <div class="col-8 bg-primary rounded p-4 text-light d-flex">
                                <div class="my-auto">
                                    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h3>
                                    <p>
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                        Accusantium deleniti quidem corrupti ex cupiditate debitis
                                        doloribus illum neque. Incidunt dolore placeat blanditiis
                                        autem expedita?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ms-auto col-12 col-lg-8 p-0">
                    <div class="rounded bg-primary bg-opacity-50">
                        <div class="row">
                            <div class="col-8 bg-primary rounded p-4 text-light text-end d-flex">
                                <div class="my-auto">
                                    <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h3>
                                    <p>
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                        Accusantium deleniti quidem corrupti ex cupiditate debitis
                                        doloribus illum neque. Incidunt dolore placeat blanditiis
                                        autem expedita?
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 p-0"><img src="assets/img/02.png" alt="" class="w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / mengapa -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
</body>

</html>
