@extends('layouts.app')
@section('title', 'Data Admin')

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
                <h5 class="card-title">Data Admin</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('superadmin.admin.create') }}" class="btn btn-primary mb-3"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Admin">Tambah Admin</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Username</th>
                            <th>Terakhir diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->Role->name }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ formatDate($admin->updated_at) }}</td>
                                <td>
                                    <a href="{{ route('superadmin.admin.show', $admin->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Admin"
                                        class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('superadmin.admin.edit', $admin->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Admin"
                                        class="btn btn-warning"><i class="fa-solid fa-edit"></i></a>
                                    <x-delete :route="route('superadmin.admin.destroy', $admin->id)" :message="'Apakah kamu yakin ingin menghapus Admin ini?'" :title="'Hapus Admin'"></x-delete>
                                    <a href="{{ route('superadmin.admin.permissions', $admin->id) }}"
                                        class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Ijin Akses">
                                        <i class="fa-solid fa-key"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
