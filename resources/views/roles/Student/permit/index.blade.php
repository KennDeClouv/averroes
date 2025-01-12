@extends('layouts.app')
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
                <h5 class="card-title">Daftar Ijin Kamu</h5>
            </div>
            <div class="card-body pb-0 pt-4">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('student.permit.create') }}" class="btn btn-primary mb-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Tambah Ijin Santri">Tambah Ijin Kamu</a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Dari</th>
                            <th>Sampai</th>
                            <th>Sebab</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentPermits as $studentPermit)
                            <tr>
                                <td>{{ formatDate($studentPermit->from, 'd F Y H:i') }}</td>
                                <td>{{ formatDate($studentPermit->to, 'd F Y H:i') }}</td>
                                <td>{{ Str::limit($studentPermit->reason, 20) }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ getStatusLabel($studentPermit->status, 'color') }}">{{ getStatusLabel($studentPermit->status, 'approval') }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('student.permit.show', $studentPermit->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Ijin Santri"
                                        class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                    @if ($studentPermit->status == 'pending')
                                        <a href="{{ route('student.permit.edit', $studentPermit->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Ijin Santri"
                                            class="btn btn-warning"><i class="fa-solid fa-edit"></i></a>
                                    @endif
                                    <x-delete :route="route('student.permit.destroy', $studentPermit->id)" :message="'Apakah kamu yakin ingin menghapus ijin santri ini?'" :title="'Hapus Ijin Santri'"></x-delete>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
