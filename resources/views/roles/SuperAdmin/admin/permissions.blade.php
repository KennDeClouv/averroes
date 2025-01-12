@extends('layouts.app')

@section('title', 'Ijin Admin')

@section('page-script')
    <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                }
            });
            $('.select2').select2({
                dropdownParent: $('.form-group')
            });
        });
    </script>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <div class="card mb-3">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('superadmin.admin.index') }}">Daftar Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ijin Akses</li>
                    </ol>
                </nav>
            </div>
        </div> --}}
        <div class="card">
            <div class="card-header border-bottom mb-4">
                <h5 class="card-title">Daftar Admin</h5>
            </div>
            <div class="card-body pb-0">
                @include('components.alert')
                <div class="card-actions d-flex">
                    @if (!$admin->Permissions->contains('feature_id', 1))
                        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                            data-bs-target="#featureModal">
                            Tambah Ijin Akses
                        </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="featureModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="featureModalLabel">Pilih Fitur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('superadmin.admin.permissions-store', $admin->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="features">Fitur</label>
                                            <select class="form-control select2" id="features" name="feature_id[]"
                                                multiple>
                                                @foreach ($features as $feature)
                                                    <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive text-start text-nowrap">
                <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                    id="dataTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Fitur Akses</th>
                            <th>Terakhir diubah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->Feature->name }}</td>
                                <td>{{ $permission->updated_at->format('d F Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <x-delete :route="route('superadmin.admin.permissions-destroy', [
                                            'admin' => $admin->id,
                                            'permission' => $permission->id,
                                        ])" title="Hapus Ijin Akses" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
