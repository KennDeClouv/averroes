@extends('layouts.app')
@section('title', 'Route List')

@section('page-script')
    <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
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
        var chart = new ApexCharts(document.querySelector('#radialBar'), {
            chart: {
                height: 348,
                type: "radialBar"
            },
            colors: ['var(--bs-primary)', 'var(--bs-danger)', 'var(--bs-info)'],
            plotOptions: {
                radialBar: {
                    size: 185,
                    hollow: {
                        size: "40%"
                    },
                    track: {
                        margin: 10,
                        background: "#f0f0f0"
                    },
                    dataLabels: {
                        name: {
                            fontSize: "2rem",
                            fontFamily: "Arial, sans-serif"
                        },
                        value: {
                            fontSize: "1.2rem",
                            color: "#6c757d",
                            fontFamily: "Arial, sans-serif"
                        },
                        total: {
                            show: true,
                            fontWeight: 400,
                            fontSize: "1.3rem",
                            color: "#6c757d",
                            label: "CPU",
                            formatter: function() {
                                return {{  $performanceData['cpuUsage'] }} + "%";
                            }
                        }
                    }
                }
            },
            grid: {
                borderColor: "#e9ecef",
                padding: {
                    top: -25,
                    bottom: -20
                }
            },
            legend: {
                show: true,
                position: "bottom",
                labels: {
                    colors: "#6c757d", // Ganti dengan warna default jika `t` tidak tersedia
                    useSeriesColors: false
                }
            },
            stroke: {
                lineCap: "round"
            },
            series: [{{ $performanceData['cpuUsage'] }}, {{ $performanceData['diskUsage'] }}, {{ $performanceData['memoryUsage'] }}],
            labels: ["CPU", "Disk", "Memory"]
        });

        // Render chart
        chart.render();
    </script>
@endsection

@section('page-style')
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-6">
            <div class="col-12 col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div id="radialBar"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="fa-solid fa-microchip"></i></span>
                                </div>
                                <h4 class="mb-0">{{ $performanceData['cpuUsage'] }}%</h4>
                            </div>
                            <p class="m-0">CPU Usage</p>
                            <small class="mb-2 opacity-50">{{ $performanceData['systemInfo']['cpu'] }}</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="card card-border-shadow-info h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-info"><i
                                            class="fa-solid fa-memory"></i></span>
                                </div>
                                <h4 class="mb-0">{{ $performanceData['memoryUsage'] }}%</h4>
                            </div>
                            <p class="m-0">Memory Usage</p>
                            <small class="mb-2 opacity-50">{{ $performanceData['systemInfo']['memory'] }}</small>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="card card-border-shadow-danger h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-danger"><i
                                            class="fa-solid fa-hard-drive"></i></span>
                                </div>
                                <h4 class="mb-0">{{ $performanceData['diskUsage'] }}%</h4>
                            </div>
                            <p class="mb-2">Disk Usage</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
