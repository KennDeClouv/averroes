@extends('components.error')
@section('title', 'Internal Server Error')

@section('content')
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">500</h1>
        <h4 class="mb-2 mx-2">Internal Server Error! 🔐</h4>
        <p class="mb-6 mx-2">Maaf server tidak dapat memproses permintaan anda. Silahkan coba lagi!</p>
        <a href="{{ url()->previous()  }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
