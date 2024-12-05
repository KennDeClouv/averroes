@extends('components.app')
@section('title', 'Detail Ijin Santri')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"><a href="{{ route('admin.student-permit.index') }}">Daftar Ijin Santri</a> / </span>
            Detail Ijin Santri
        </h5>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Ijin Santri</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Nama Santri</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentPermit->Student->name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Ustadz</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentPermit->Teacher->name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Dari</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ \Carbon\Carbon::parse($studentPermit->from)->format('d-m-Y H:i') }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Sampai</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ \Carbon\Carbon::parse($studentPermit->to)->format('d-m-Y H:i') }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Sebab</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentPermit->reason }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Keterangan</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentPermit->description ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Status</strong>
                    </div>
                    <div class="col-md-8">
                        : <span class="badge bg-{{ $studentPermit->status == 'pending' ? 'warning' : ($studentPermit->status == 'approved' ? 'success' : 'danger') }}">{{ $studentPermit->status }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Catatan</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $studentPermit->note ?? '-' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('admin.student-permit.index') }}" class="btn btn-secondary" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Kembali"><i class="fa-solid fa-arrow-left"></i></a>
                        <a href="{{ route('admin.student-permit.edit', $studentPermit->id) }}" class="btn btn-warning"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Ijin Santri"><i
                                class="fa-solid fa-edit"></i></a>
                        <x-delete :route="route('admin.student-permit.destroy', $studentPermit->id)" :message="'Apakah anda yakin ingin menghapus ijin santri ini?'" :title="'Hapus Ijin Santri'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
