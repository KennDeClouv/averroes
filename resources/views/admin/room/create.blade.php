@extends('components.app')

@section('title', 'Tambah Kamar')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('admin.room.store') }}" method="POST">
        @csrf
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('admin.room.index') }}">Daftar Kamar</a> / </span>
                Tambah Kamar
            </h5>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Kamar</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Nama Kamar" value="{{ old('name') }}">
                                @errorFeedback('name')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="code">Kode</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" placeholder="Kode Kamar" value="{{ old('code') }}">
                                @errorFeedback('code')
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection