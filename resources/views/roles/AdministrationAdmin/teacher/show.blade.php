@extends('layouts.app')
@section('title', 'Detail Ustadz')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"> <a href="{{ route('administrationadmin.teacher.index') }}">Daftar Ustadz</a> /</span>
            Detail Ustadz
        </h5>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Ustadz</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Nama</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $teacher->name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>KTP</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $teacher->ktp ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Kamar</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $teacher->Room->name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Jenis Kelamin</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ getGender($teacher->gender) ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Alamat</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $teacher->address ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Telepon</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $teacher->phone ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Email</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $teacher->User->email ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tanggal Lahir</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ formatDate($teacher->birth_date) ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tempat Lahir</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $teacher->birth_place ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tipe</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ teacherType($teacher->type) ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tipe Sekunder</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ teacherType($teacher->secondary_type) ?? '-' }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('administrationadmin.teacher.index') }}" class="btn btn-secondary" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Kembali"><i class="fa-solid fa-arrow-left"></i></a>
                        <a href="{{ route('administrationadmin.teacher.edit', $teacher->id) }}" class="btn btn-warning"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Ustadz"><i
                                class="fa-solid fa-edit"></i></a>
                        <x-delete :route="route('administrationadmin.teacher.destroy', $teacher->id)" :message="'Apakah anda yakin ingin menghapus data ' . $teacher->name . '?'" :title="'Hapus Ustadz'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
