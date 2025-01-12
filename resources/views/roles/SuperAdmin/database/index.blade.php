@extends('layouts.app')
@section('title', 'Database Menu')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                {{-- <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Vehicles Overview</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-none d-lg-flex vehicles-progress-labels mb-6">
                            <div class="vehicles-progress-label on-the-way-text" style="width: 39.7%;">On the way</div>
                            <div class="vehicles-progress-label unloading-text" style="width: 28.3%;">Unloading</div>
                            <div class="vehicles-progress-label loading-text" style="width: 17.4%;">Loading</div>
                            <div class="vehicles-progress-label waiting-text text-nowrap" style="width: 14.6%;">Waiting
                            </div>
                        </div>
                        <div class="vehicles-overview-progress progress rounded-3 mb-6 bg-transparent overflow-hidden"
                            style="height: 46px;">
                            <div class="progress-bar fw-medium text-start shadow-none bg-lighter text-heading px-4 rounded-0"
                                role="progressbar" style="width: 39.7%" aria-valuenow="39.7" aria-valuemin="0"
                                aria-valuemax="100">39.7%</div>
                            <div class="progress-bar fw-medium text-start shadow-none bg-primary px-4" role="progressbar"
                                style="width: 28.3%" aria-valuenow="28.3" aria-valuemin="0" aria-valuemax="100">28.3%</div>
                            <div class="progress-bar fw-medium text-start shadow-none text-bg-info px-2 px-sm-4"
                                role="progressbar" style="width: 17.4%" aria-valuenow="17.4" aria-valuemin="0"
                                aria-valuemax="100">17.4%</div>
                            <div class="progress-bar fw-medium text-start shadow-none snackbar text-paper px-1 px-sm-3 rounded-0 px-lg-4"
                                role="progressbar" style="width: 14.6%" aria-valuenow="14.6" aria-valuemin="0"
                                aria-valuemax="100">14.6%</div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-border-top-0">
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="w-50 ps-0">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="me-2">
                                                    <i class="icon-base bx bx-car icon-lg text-heading"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">On the way</h6>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0 text-nowrap">
                                            <h6 class="mb-0">2hr 10min</h6>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span>39.7%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 ps-0">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="me-2">
                                                    <i class="icon-base bx bx-down-arrow-circle icon-lg text-heading"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Unloading</h6>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0 text-nowrap">
                                            <h6 class="mb-0">3hr 15min</h6>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span>28.3%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 ps-0">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="me-2">
                                                    <i class="icon-base bx bx-up-arrow-circle icon-lg text-heading"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Loading</h6>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0 text-nowrap">
                                            <h6 class="mb-0">1hr 24min</h6>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span>17.4%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 ps-0">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="me-2">
                                                    <i class="icon-base bx bx-time-five icon-lg text-heading"></i>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Waiting</h6>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0 text-nowrap">
                                            <h6 class="mb-0">5hr 19min</h6>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span>14.6%</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
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
                                <h5 class="mb-2">Database</h5>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ route('superadmin.database.index-database') }}" class="btn btn-primary">Databases</a>
                            </div>
                        </div>
                        <p class="m-0">Kelola dan lihat semua database dalam sistem.</p>
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
