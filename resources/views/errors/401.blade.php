@extends('components.error')
@section('title', 'Tidak diizinkan')

@section('content')
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">401</h1>
        <h4 class="mb-2 mx-2">Unauthorized! 🔐</h4>
        <p class="mb-6 mx-2">Maaf anda tidak diizinkan untuk mengakses halaman ini. Silahkan coba lagi!</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
