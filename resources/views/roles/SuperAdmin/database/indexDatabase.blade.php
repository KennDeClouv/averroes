@extends('layouts.app')
@section('title', 'Database ')

@section('page-script')
    <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endsection

@section('page-style')
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title">Database</h5>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered mt-4" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Tabel</th>
                            <th>Ukuran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tables as $table)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $table->table_name }}</td>
                                <td>{{ $table->size }}</td>
                                <td>
                                    <a href="{{ route('superadmin.database.show', $table->table_name) }}"
                                        class="btn btn-primary" data-bs-toggle="tooltip" title="Lihat tabel">
                                        <i class="fa-regular fa-table"></i>
                                    </a>
                                    <x-delete :route="route('superadmin.database.empty', [
                                                'tableName' => $table->table_name,
                                            ])" title="Kosongkan tabel" icon="fa-solid fa-empty-set" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
