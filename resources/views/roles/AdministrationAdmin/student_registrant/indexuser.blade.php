@extends('layouts.app')
@section('title', 'Data Santri')

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

        function handleFormSubmit(event, form) {
            event.preventDefault();
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Setelah dihapus, Kamu tidak akan dapat memulihkan data ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: 'var(--bs-primary)',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                background: isDarkMode ? '#2b2c40' : '#fff',
                color: isDarkMode ? '#b2b2c4' : '#000',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endsection

@section('content')
    @php
        $permissions = collect(Auth::user()->getPermissionCodes());
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title">Data Akun Calon Santri</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                <div class="d-flex justify-content-end">
                    @if ($permissions->contains('create_student_registrant_user'))
                        <a href="{{ route('administrationadmin.studentregistrant.create-user') }}"
                            class="btn btn-primary mb-3" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Tambah Akun Calon Santri">Tambah Akun Calon
                            Santri</a>
                    @endif
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Terakhir diubah</th>
                            @if ($permissions->contains('edit_student_registrant_user') || $permissions->contains('delete_student_registrant_user'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentRegistrants as $studentRegistrant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $studentRegistrant->name }}</td>
                                <td>{{ $studentRegistrant->username }}</td>
                                <td>{{ formatDate($studentRegistrant->updated_at, 'd F Y H:i') }}</td>
                                @if ($permissions->contains('edit_student_registrant_user') || $permissions->contains('delete_student_registrant_user'))
                                    <td>
                                        @if ($permissions->contains('edit_student_registrant_user'))
                                            <a href="{{ route('administrationadmin.studentregistrant.edit-user', $studentRegistrant->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Edit User Calon Santri" class="btn btn-warning "><i
                                                    class="fa-solid fa-edit fs-6"></i></a>
                                        @endif
                                        @if ($permissions->contains('delete_student_registrant_user'))
                                            <x-delete :route="route(
                                                'administrationadmin.studentregistrant.destroy-user',
                                                $studentRegistrant->id,
                                            )" :message="'Apakah kamu yakin ingin menghapus user calon santri ini?'" :title="'Hapus User Calon Santri'" />
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
