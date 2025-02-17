<x-auth-app>
    <div class="authentication-wrapper authentication-basic px-4">
        <div class="authentication-inner">
            <!-- Verify Email -->
            <div class="card px-sm-6 px-0">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name') . ' logo' }}"
                                    style="border-radius:5px; width: 200px">
                            </span>
                            {{-- <span class="app-brand-text demo text-heading fw-bold">{{ config('app.name') }}</span> --}}
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-1">Verifikasi email Anda ✉️</h4>
                    <p class="text-start mb-0">
                        Tautan aktivasi akun telah dikirim ke alamat email Anda: <span
                            class="fw-medium text-heading">{{ Auth::user()->email }}</span> Silakan ikuti tautan di
                        dalamnya untuk
                        melanjutkan.
                    </p>
                    <a class="btn btn-primary w-100 my-6" href="{{ route('account') }}">
                        Lewati untuk sekarang
                    </a>
                    <div class="d-flex justify-content-center">
                        <p class="mb-0 me-2">Tidak menerima email?
                        <form method="POST" action="{{ route('verification.send') }}"
                            class="d-flex justify-content-center" id="resendForm">
                            @csrf
                            <a href="javascript:void(0)" class=""
                                onclick="document.getElementById('resendForm').submit();">Kirim Ulang</a>
                        </form>
                    </div>
                    </p>
                </div>
            </div>
            <!-- /Verify Email -->
        </div>
    </div>
    <x-slot:css>
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    </x-slot:css>
</x-auth-app>
