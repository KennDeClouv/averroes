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

            // Tangani submit form
            $('form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('superadmin.database.sql') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        sql: $('#sql').val()
                    },
                    success: function(data) {
                        console.log(data); // pastikan respons diterima
                        $('#display').removeClass('alert-danger');
                        $('#display').addClass('alert-success');
                        if (data.formatted) {
                            $('#display').val(data.formatted);
                        } else {
                            $('#display').val(data.message || 'Terjadi kesalahan.');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        $('#display').removeClass('alert-success');
                        $('#display').addClass('alert-danger');
                        $('#display').val('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title">SQL</h5>
            </div>
            <div class="card-body pt-4">
                <form method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-11">
                            <textarea class="form-control" name="sql" id="sql" cols="30" rows="10"
                                placeholder="Masukkan query SQL"></textarea>
                        </div>
                        <div class="col-12 col-lg-1">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
                <textarea id="display" cols="30" rows="10" class="form-control mt-4"
                    placeholder="Hasil akan ditampilkan di sini" readonly></textarea>
            </div>
        </div>
    </div>
@endsection
