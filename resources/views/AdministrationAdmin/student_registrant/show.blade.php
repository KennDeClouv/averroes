@extends('components.app')
@section('title', 'Detail Santri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"> <a href="{{ route('administrationadmin.student.index') }}">Data Santri</a>
                /</span>
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
                        : {{ $studentRegistrant->name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Nama Lengkap</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->full_name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>NISN</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->nisn }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Kelas</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->Classes->name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Kamar</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->Room->name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Jenis Kelamin</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ getGender($studentRegistrant->gender) ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Alamat</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->address ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Telepon</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->phone ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Email</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->User->email ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tanggal Lahir</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ formatDate($studentRegistrant->birth_date) ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tempat Lahir</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->birth_place ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Riwayat Medis</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->medical_history ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Nama Ayah</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->father_name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Pekerjaan Ayah</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->father_occupation ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Penghasilan Ayah</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->father_income ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Nama Ibu</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->mother_name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Pekerjaan Ibu</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->mother_occupation ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Penghasilan Ibu</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->mother_income ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Status Siswa</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->studentRegistrant_status ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Informasi Saudara</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->sibling_info ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Motivasi Sekolah</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->school_motivation ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Prestasi</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->achievements ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Memorization Quran</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->quran_memorization ?? '-' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('administrationadmin.student.index') }}" class="btn btn-secondary"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali"><i
                                class="fa-solid fa-arrow-left"></i></a>
                        <a href="{{ route('administrationadmin.student.edit', $studentRegistrant->id) }}"
                            class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Santri"><i
                                class="fa-solid fa-edit"></i></a>
                        <x-delete :route="route('administrationadmin.student.destroy', $studentRegistrant->id)" :message="'Apakah anda yakin ingin menghapus data ' . $studentRegistrant->name . '?'" :title="'Hapus Santri'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
