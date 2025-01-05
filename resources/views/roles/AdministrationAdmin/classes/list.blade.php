@extends('layouts.app')
@section('title', 'Data Santri Kelas ' . $class->name)

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
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"><a href="{{ route('administrationadmin.class.index') }}">Daftar Kelas</a> / </span> Kelas {{ $class->name }}
        </h5>
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title">Data Santri Kelas {{ $class->name }}</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('administrationadmin.class.index') }}" class="btn btn-secondary mb-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Kembali ke daftar kelas">Kembali</a>
                    <a href="{{ route('administrationadmin.class.add.student-to-class.form', $class->id) }}" class="btn btn-primary mb-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Tambah Santri Kelas {{ $class->name }}">Tambah Santri Kelas {{ $class->name }}</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>
                                    <a href="{{ route('administrationadmin.student.show', $student->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Detail Santri" class="btn btn-info "><i
                                            class="fa-solid fa-eye fs-6"></i></a>
                                    <x-delete :route="route('administrationadmin.class.delete.student-from-class', $student->id)" :message="'Apakah anda yakin ingin menghapus santri ' . $student->name . ' dari kelas ini?'" :title="'Hapus Santri dari Kelas'" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
