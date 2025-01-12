@extends('layouts.app')
@section('title', 'Detail Santri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"> <a href="{{ route('administrationadmin.studentregistrant.index') }}">Data </a>
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
                        : {{ indonesianCurrency($studentRegistrant->father_income) ?? '-' }}
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
                        : {{ indonesianCurrency($studentRegistrant->mother_income) ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Status Siswa</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->student_status ?? '-' }}
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
                        <strong>Juz yang dihafal</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentRegistrant->quran_memorization ?? '-' }} juz
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Link bacaan Quran</strong>
                    </div>
                    <div class="col-md-8">
                        : <a href="{{ $studentRegistrant->quran_record_link ?? '-' }}" target="_blank">{{ $studentRegistrant->quran_record_link ?? '-' }}</a>
                    </div>
                </div>
                @if ($studentRegistrant->attachment_family_register)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>File KK</strong>
                        </div>
                        <div class="col-md-8">
                            : <a href="{{ $studentRegistrant->attachment_family_register }}" target="_blank">klik untuk melihat</a>
                        </div>
                    </div>
                @endif
                @if ($studentRegistrant->attachment_birth_certificate)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>File Akta kelahiran</strong>
                        </div>
                        <div class="col-md-8">
                            : <a href="{{ $studentRegistrant->attachment_birth_certificate }}" target="_blank">klik untuk melihat</a>
                        </div>
                    </div>
                @endif
                @if ($studentRegistrant->attachment_diploma)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>File Ijazah</strong>
                        </div>
                        <div class="col-md-8">
                            : <a href="{{ $studentRegistrant->attachment_diploma }}" target="_blank">klik untuk melihat</a>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('administrationadmin.studentregistrant.index') }}" class="btn btn-secondary"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali"><i
                                class="fa-solid fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
