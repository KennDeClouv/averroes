@extends('layouts.app')
@section('title', 'Detail Pengumuman')

@section('content')
    @php
        $permissions = collect(Auth::user()->getPermissionCodes());
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"><a href="{{ route('administrationadmin.announcement.index') }}">Daftar
                    Pengumuman</a> / </span>
            Detail Pengumuman
        </h5>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Pengumuman</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tujuan</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $announcement->Target->name ?? '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Judul</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $announcement->title }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Konten</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ $announcement->content }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tanggal</strong>
                    </div>
                    <div class="col-md-8">
                        : {{ formatDate($announcement->date) }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Status</strong>
                    </div>
                    <div class="col-md-8">
                        : <span
                            class="badge bg-{{ $announcement->status == 'active' ? 'success' : 'danger' }}">{{ $announcement->status }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('administrationadmin.announcement.index') }}" class="btn btn-secondary"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali"><i
                                class="fa-solid fa-arrow-left"></i></a>
                        @if ($permissions->contains('edit_announcement'))
                            <a href="{{ route('administrationadmin.announcement.edit', $announcement->id) }}"
                                class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Edit Pengumuman"><i class="fa-solid fa-edit"></i></a>
                        @endif
                        @if ($permissions->contains('delete_announcement'))
                            <x-delete :route="route('administrationadmin.announcement.destroy', $announcement->id)" :message="'Apakah kamu yakin ingin menghapus pengumuman ini?'" :title="'Hapus Pengumuman'" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
