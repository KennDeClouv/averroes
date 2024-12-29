@extends('components.app')
@section('title', 'Log ' . $filename)


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

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light"><a href="{{ route('administrationadmin.logs') }}">Daftar Log</a> / </span>
            Log {{ $filename }}
        </h5>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="m-0">Log {{ $filename }}</h5>
            </div>
        </div>
        <div class="accordion accordion-popout" id="logAccordion">
            @foreach ($logs as $index => $log)
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $index }}">
                        <button class="accordion-button collapsed gap-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $index }}" aria-expanded="false"
                            aria-controls="collapse-{{ $index }}">
                            @if ($log['env'] == 'local')
                                <span class="badge bg-label-primary">LOCAL</span>
                            @else
                                <span class="badge bg-label-success">PRODUCTION</span>
                            @endif
                            @if ($log['type'] == 'INFO')
                                <span class="badge bg-label-info">INFO</span>
                            @elseif ($log['type'] == 'ERROR')
                                <span class="badge bg-label-danger">ERROR</span>
                            @endif
                            {{ $log['timestamp'] }}
                            {{-- <span class="badge bg-label-warning">{{ $log['level']['name'] }}</span> --}}
                        </button>
                    </h2>
                    <div id="collapse-{{ $index }}" class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ $index }}" data-bs-parent="#logAccordion">
                        <div class="accordion-body">
                            <pre>{{ $log['message'] }}</pre>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
