@extends('layouts.error')
@section('title', 'Tidak diizinkan')

@section('content')
    <div class="misc-wrapper text-center">
        <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">403</h1>
        <h4 class="mb-2 mx-2">Kamu tidak diizinkan! 🔐</h4>
        <p class="mb-6 mx-2">Maaf kamu tidak memiliki akses ke halaman ini. Kembali ke beranda!</p>
        <div class="d-flex gap-2">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
@endsection
