@extends('layouts.app')
@section('title', 'Detail Kelas')

@section('content')
    @php
        $permissions = collect(Auth::user()->getPermissionCodes());
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"><a href="{{ route('administrationadmin.class.index') }}">Daftar Kelas</a> /
            </span>
            Detail Kelas
        </h5>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Kelas</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Nama</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $class->name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Kode</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $class->code ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('administrationadmin.class.index') }}" class="btn btn-secondary"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali"><i
                                class="fa-solid fa-arrow-left"></i></a>
                        @if ($permissions->contains('edit_class'))
                            <a href="{{ route('administrationadmin.class.edit', $class->id) }}" class="btn btn-warning"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Kelas"><i
                                    class="fa-solid fa-edit"></i></a>
                        @endif
                        @if ($permissions->contains('delete_class'))
                            <x-delete :route="route('administrationadmin.class.destroy', $class->id)" :message="'Apakah kamu yakin ingin menghapus data ' . $class->name . '?'" :title="'Hapus Kelas'" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
