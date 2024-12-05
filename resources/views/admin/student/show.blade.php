@extends('components.app')
@section('title', 'Detail Santri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"> <a href="{{ route('admin.student.index') }}">Daftar Santri</a> /</span>
            Detail Santri
        </h5>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Santri</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Nama</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>NISN</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->nisn }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Kelas</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->Classes->name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Kamar</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->Room->name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Jenis Kelamin</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->gender ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Alamat</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->address ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Telepon</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->phone ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Email</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->User->email ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tanggal Lahir</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->birthdate ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tempat Lahir</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $student->birthplace ?? '-' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('admin.student.index') }}" class="btn btn-secondary" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Kembali"><i class="fa-solid fa-arrow-left"></i></a>
                        <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-warning"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Santri"><i
                                class="fa-solid fa-edit"></i></a>
                        <x-delete :route="route('admin.student.destroy', $student->id)" :message="'Apakah anda yakin ingin menghapus data ' . $student->name . '?'" :title="'Hapus Santri'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
