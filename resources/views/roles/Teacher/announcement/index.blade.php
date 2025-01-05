@extends('layouts.app')
@section('title', 'Daftar Pengumuman Santri')

@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title">Daftar Pengumuman Santri</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('teacher.announcement.create') }}" class="btn btn-primary mb-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Tambah Pengumuman">Tambah Pengumuman</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Tujuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                            <tr>
                                <td>{{ formatDate($announcement->date) }}</td>
                                <td>{{ $announcement->title }}</td>
                                <td>{{ $announcement->Target->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $announcement->status == 'active' ? 'success' : 'danger' }}">{{ getStatusLabel($announcement->status, 'activation') }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('teacher.announcement.show', $announcement->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Pengumuman"
                                        class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('teacher.announcement.edit', $announcement->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Pengumuman"
                                        class="btn btn-warning"><i class="fa-solid fa-edit"></i></a>
                                    <x-delete :route="route('teacher.announcement.destroy', $announcement->id)" :message="'Apakah anda yakin ingin menghapus pengumuman ini?'" :title="'Hapus Pengumuman'"></x-delete>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
