@extends('components.app')
@section('title', 'Daftar Ijin Santri')

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
                <h5 class="card-title">Daftar Ijin Santri</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.student-permit.create') }}" class="btn btn-primary mb-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Tambah Ijin Santri">Tambah Ijin
                        Santri</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Nama Santri</th>
                            <th>Dari</th>
                            <th>Sampai</th>
                            <th>Kelas</th>
                            <th>Sebab</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentPermits as $studentPermit)
                            <tr>
                                <td>{{ $studentPermit->Student->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($studentPermit->from)->format('d F Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($studentPermit->to)->format('d F Y H:i') }}</td>
                                <td>{{ $studentPermit->Student->Class->name ?? '-' }}</td>
                                <td>{{ Str::limit($studentPermit->reason, 20) }}</td>
                                <td>
                                    <span class="badge bg-{{ $studentPermit->status == 'pending' ? 'warning' : ($studentPermit->status == 'approved' ? 'success' : 'danger') }}">{{ $studentPermit->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.student-permit.show', $studentPermit->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Ijin Santri"
                                        class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('admin.student-permit.edit', $studentPermit->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Ijin Santri"
                                        class="btn btn-warning"><i class="fa-solid fa-edit"></i></a>
                                    <x-delete :route="route('admin.student-permit.destroy', $studentPermit->id)" :message="'Apakah anda yakin ingin menghapus ijin santri ini?'" :title="'Hapus Ijin Santri'"></x-delete>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
