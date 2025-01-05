@extends('layouts.error')
@section('title', 'Metode tidak diizinkan')

@section('content')
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">419</h1>
        <h4 class="mb-2 mx-2">Permintaan tidak valid! 🔐</h4>
        <p class="mb-6 mx-2">Maaf, permintaan yang Anda buat tidak valid. Silakan coba lagi!</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
