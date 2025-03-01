@extends('layouts.app')
@section('title', 'Data Push Subscription')

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
                <h5 class="card-title">Data Push Subscription</h5>
            </div>
            @foreach ($pushSubscriptions as $pushSubscription)
                <form action="{{ route('superadmin.notification.send', $pushSubscription->id) }}" method="POST">
                    @csrf
                    <div class="card-body border-top">
                        <p>{{ $pushSubscription->user->name }}</p>
                        <div class="form-group mb-3">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group mb-3">
                            <label for="body">Pesan</label>
                            <textarea class="form-control" id="body" name="body"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            @endforeach
        </div>
        <div class="card mt-5">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title">Kirim ke semua</h5>
            </div>
            <form action="{{ route('superadmin.notification.send-all') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="body">Pesan</label>
                        <textarea class="form-control" id="body" name="body"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
