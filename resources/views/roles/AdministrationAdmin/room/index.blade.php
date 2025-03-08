@extends('layouts.app')
@section('title', 'Daftar Kamar')

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
    @php
        $permissions = collect(Auth::user()->getPermissionCodes());
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title">Daftar Kamar</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                @if ($permissions->contains('create_room'))
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('administrationadmin.room.create') }}" class="btn btn-primary mb-3"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Kamar">Tambah Kamar</a>
                    </div>
                @endif
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            @if ($permissions->contains('edit_room') || $permissions->contains('delete_room') || $permissions->contains('show_room'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->code ?? '-' }}</td>
                                @if ($permissions->contains('edit_room') || $permissions->contains('delete_room') || $permissions->contains('show_room'))
                                    <td>
                                        <a href="{{ route('administrationadmin.room.show', $room->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Kamar"
                                            class="btn btn-info "><i class="fa-solid fa-eye fs-6"></i></a>
                                        @if ($permissions->contains('edit_room'))
                                            <a href="{{ route('administrationadmin.room.edit', $room->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Kamar"
                                                class="btn btn-warning "><i class="fa-solid fa-edit fs-6"></i></a>
                                        @endif
                                        <a href="{{ route('administrationadmin.room.list', $room->id) }}"
                                            class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Santri Kamar"><i class="fa-solid fa-users"></i></a>
                                        @if ($permissions->contains('delete_room'))
                                            <x-delete :route="route('administrationadmin.room.destroy', $room->id)" :message="'Apakah kamu yakin ingin menghapus data kamar ini?'" :title="'Hapus Kamar'" />
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
