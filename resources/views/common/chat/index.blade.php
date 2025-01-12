@extends('layouts.app')
@section('title', 'Chat app')

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.iife.min.js"></script>
    <script>
        window.userId = {{ Auth::user()->id }};
        document.addEventListener('keydown', function(event) {
            if (event.ctrlKey && event.key === 'Enter') {
                event.preventDefault();
                document.querySelector('#message-input').focus();
            }
        });
        document.querySelector('#message-input').addEventListener("focus", function() {
            this.placeholder = "Masukkan pesan";
        });
        document.querySelector('#message-input').addEventListener("blur", function() {
            this.placeholder = "Tulis pesan (ctrl + enter)";
        });
    </script>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}">
@endsection

@section('content')
    @php
        $user = Auth::user();
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-chat card border overflow-hidden">
            <div class="row g-0">
                <!-- Sidebar Left -->
                <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                    <div
                        class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-6 pt-12">
                        <div class="avatar avatar-xl avatar-{{ $user->status }} chat-sidebar-avatar">
                            <img src="{{ $user->photo }}" alt="Avatar" class="rounded-circle">
                        </div>
                        <h5 class="mt-4 mb-0">{{ $user->name }}</h5>
                        <span>{{ $user->Role->name }}</span>
                        <i class="fa fa-chevron-left cursor-pointer close-sidebar" data-bs-toggle="sidebar" data-overlay
                            data-target="#app-chat-sidebar-left"></i>
                    </div>
                    <form action="{{ route('chat.edit-user', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="sidebar-body px-6 pb-6">
                            <div class="my-6">
                                <label for="chat-sidebar-left-user-about"
                                    class="text-uppercase text-muted mb-1">About</label>
                                <textarea id="chat-sidebar-left-user-about" class="form-control chat-sidebar-left-user-about" rows="3"
                                    maxlength="120" placeholder="Kasi bio dikitt kek biar kerenn" name="bio">{{ $user->bio }}</textarea>
                            </div>
                            <div class="my-6">
                                <p class="text-uppercase text-muted mb-1">Status</p>
                                <div class="d-grid gap-2 pt-2 text-heading ms-2">
                                    <div class="form-check form-check-success">
                                        <input class="form-check-input" type="radio"
                                            name="status" value="active" id="user-active" {{ $user->status == 'online' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="user-active">Online</label>
                                    </div>
                                    <div class="form-check form-check-warning">
                                        <input class="form-check-input" type="radio"
                                            name="status" value="away" id="user-away" {{ $user->status == 'away' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="user-away">Gabut</label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <input class="form-check-input" type="radio"
                                            name="status" value="busy" id="user-busy" {{ $user->status == 'busy' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="user-busy">Gabisa diganggu</label>
                                    </div>
                                    <div class="form-check form-check-secondary">
                                        <input class="form-check-input" type="radio"
                                            name="status" value="offline" id="user-offline" {{ $user->status == 'offline' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="user-offline">Offline</label>
                                    </div>
                                </div>
                                <div class="my-6">
                                    <button class="btn btn-primary" id="save-status">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Sidebar Left-->

                <!-- Chat & Contacts -->
                <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
                    id="app-chat-contacts">
                    <div class="sidebar-header px-6 border-bottom d-flex align-items-center">
                        <div class="d-flex align-items-center me-6 me-lg-0">
                            <div class="flex-shrink-0 avatar avatar-{{ $user->status }} me-4" data-bs-toggle="sidebar"
                                data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                                <img class="user-avatar rounded-circle cursor-pointer" src="{{ $user->photo }}"
                                    alt="Avatar">
                            </div>
                            <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                                <span class="input-group-text" id="basic-addon-search31"><i
                                        class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" class="form-control chat-search-input" placeholder="Search..."
                                    aria-label="Search..." aria-describedby="basic-addon-search31">
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-left cursor-pointer position-absolute top-50 end-0 pe-3 translate-middle d-lg-none d-block"
                            data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                    </div>
                    <div class="sidebar-body">
                        <!-- Chats -->
                        <ul class="list-unstyled chat-contact-list py-2 mb-0" id="chat-list">
                            <li class="chat-contact-list-item chat-contact-list-item-title mt-0">
                                <h5 class="text-primary mb-0">User</h5>
                            </li>
                            <li class="chat-contact-list-item chat-list-item-0 d-none">
                                <h6 class="text-muted mb-0">Opps...</h6>
                            </li>
                            <div id="contact">

                            </div>
                        </ul>

                    </div>
                </div>
                <!-- /Chat contacts -->

                <!-- Chat History -->
                <div class="col app-chat-history">
                    <div class="chat-history-wrapper">
                        <div class="chat-history-header border-bottom d-block d-lg-none">
                            <div class="d-flex justify-content-between align-items-center" style="min-height:35px">
                                <div class="d-flex overflow-hidden align-items-center">
                                    <i class="fa-solid fa-bars cursor-pointer d-lg-none d-block me-4"
                                        data-bs-toggle="sidebar" data-overlay="" data-target="#app-chat-contacts"></i>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history-body">
                            <ul class="list-unstyled chat-history text-center" id="chat-history">
                                <i class="fa-solid fa-address-book text-primary fa-2xl mb-3"></i>
                                <p class="mt-4">Pilih kontak untuk memulai chat</p>
                            </ul>
                        </div>
                        <form class="d-none" id="message-form">
                            <div
                                class="chat-history-footer form-send-message d-flex justify-content-between align-items-center">
                                <input class="form-control message-input border-0 me-4 shadow-none"
                                    placeholder="Tulis pesan (ctrl + enter)" maxlength="500" id="message-input">
                                <div class="message-actions d-flex align-items-center">
                                    {{-- <label for="attach-doc" class="form-label mb-0">
                                        <div class="btn btn-icon me-2">
                                            <i
                                                class="fa-solid fa-paperclip-vertical fa-md cursor-pointer mx-1 text-heading"></i>
                                        </div>
                                        <input type="file" id="attach-doc" hidden>
                                    </label> --}}
                                    <button class="btn btn-primary d-flex send-msg-btn">
                                        <span class="align-middle"><i class="fa-solid fa-paper-plane-top"></i></span>
                                        {{-- <i class="fa-solid fa-paper-plane-top ms-md-2 ms-0"></i> --}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Chat History -->
                <div class="app-overlay"></div>
            </div>
        </div>
    </div>
@endsection
