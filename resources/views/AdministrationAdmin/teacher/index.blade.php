@extends('components.app')
@section('title', 'Daftar Ustadz')

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
                <h5 class="card-title">Daftar Ustadz</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('administrationadmin.teacher.create') }}" class="btn btn-primary mb-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Tambah Ustadz">Tambah Ustadz</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ teacherType($teacher->type) ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('administrationadmin.teacher.show', $teacher->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Detail Ustadz" class="btn btn-info "><i
                                            class="fa-solid fa-eye fs-6"></i></a>
                                    <a href="{{ route('administrationadmin.teacher.edit', $teacher->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Ustadz" class="btn btn-warning "><i
                                            class="fa-solid fa-edit fs-6"></i></a>
                                    <x-delete :route="route('administrationadmin.teacher.destroy', $teacher->id)" :message="'Apakah anda yakin ingin menghapus data ' . $teacher->name . '?'" :title="'Hapus Ustadz'" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
