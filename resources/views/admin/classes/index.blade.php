@extends('components.app')
@section('title', 'Daftar Kelas')

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
                <h5 class="card-title">Daftar Kelas</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.class.create') }}" class="btn btn-primary mb-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Tambah Kelas">Tambah Kelas</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->code ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.class.show', $class->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Detail Kelas" class="btn btn-info "><i
                                            class="fa-solid fa-eye fs-6"></i></a>
                                    <a href="{{ route('admin.class.edit', $class->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Kelas" class="btn btn-warning "><i
                                            class="fa-solid fa-edit fs-6"></i></a>
                                    <a href="{{ route('admin.class.list', $class->id) }}" class="btn btn-secondary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Santri Kelas"><i
                                            class="fa-solid fa-users"></i></a>
                                    <x-delete :route="route('admin.class.destroy', $class->id)" :message="'Apakah anda yakin ingin menghapus data ' . $class->name . '?'" :title="'Hapus Kelas'" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
