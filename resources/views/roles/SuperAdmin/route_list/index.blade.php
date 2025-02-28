@extends('layouts.app')
@section('title', 'Route List')

@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new ClipboardJS('.btn');
        });
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'Copied to clipboard!',
                    timer: 1500,
                    showConfirmButton: false,
                    background: isDarkMode ? '#2b2c40' : '#fff',
                    color: isDarkMode ? '#b2b2c4' : '#000',
                });
            });
        });
    </script>
@endsection

@section('page-style')
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <h5 class="card-header">Route List</h5>
            <div class="card-body">
                <div class="table-responsive table-responsive ">
                    <table class="table table-bordered table-responsive-sm table-responsive-md table-responsive-xl w-100"
                        id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Method</th>
                                <th>URI</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routes as $route)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $route->methods[0] }}</td>
                                    <td>{{ $route->uri }}</td>
                                    <td>{{ $route->getName() }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-primary" data-clipboard-text="{{ $route->uri }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Copy URI">
                                                <i class="fa-solid fa-clipboard"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary"
                                                data-clipboard-text="{{ $route->getName() }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Copy Name">
                                                <i class="fa-solid fa-clipboard"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
