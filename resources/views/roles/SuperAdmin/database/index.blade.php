@extends('layouts.app')
@section('title', 'Database Menu')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Database Overview</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($tables as $table)
                            <div class="mb-4">
                                <h6 class="fw-bold">{{ $table['name'] }}</h6>
                                <p>Total Rows: {{ $table['row_count'] }}</p>
                                {{-- <p>Columns: {{ implode(', ', $table['columns']) }}</p> --}}
                                <div class="progress rounded-3 mb-2" style="height: 20px;">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                         style="width: {{ min($table['row_count'] / 1, 100) }}%;"
                                         aria-valuenow="{{ $table['row_count'] }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
            <div class="col-6">
                <div class="card  mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="mb-0">Database Menu</h5>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="fa-solid fa-database"></i></span>
                                    </div>
                                    <h4 class="mb-0">{{ $databases }}</h4>
                                </div>
                                <h5 class="mb-2">Database {{ $databaseName }}</h5>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ route('superadmin.database.index-database') }}" class="btn btn-primary">Database </a>
                            </div>
                        </div>
                        <p class="m-0">Kelola dan lihat semua tabel di database dalam sistem.</p>
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-danger"><i
                                                class="fa-solid fa-code"></i></span>
                                    </div>
                                    <h4 class="mb-0">SQL</h4>
                                </div>
                                <h5 class="mb-2">Structured Query Language</h5>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ route('superadmin.database.index-sql') }}" class="btn btn-primary">SQL</a>
                            </div>
                        </div>
                        <p class="mb-0">inject query ke database secara langsung.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
