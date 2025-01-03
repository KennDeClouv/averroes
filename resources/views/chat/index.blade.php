@extends('components.app')
@section('title', 'Chat app')

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.iife.min.js"></script>
    <script>
        window.userId = {{ Auth::user()->id }};
        // Echo.channel("user-status").listen("UserStatusUpdated", (event) => {
        //     console.log("user status updated:", event.user);

        //     // update status di UI
        //     const userElement = document.querySelector(
        //         `.user[data-id="${event.user.id}"]`
        //     );
        //     if (userElement) {
        //         userElement.dataset.status = event.user.status;
        //         userElement.classList.toggle(
        //             "online",
        //             event.user.status === "online"
        //         );
        //         userElement.classList.toggle("away", event.user.status === "away");
        //         userElement.classList.toggle(
        //             "offline",
        //             event.user.status === "offline"
        //         );

        //         const statusElement = userElement.querySelector(".status");
        //         if (statusElement) {
        //             statusElement.textContent = event.user.status;
        //         }
        //     }
        // });
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
                        <div class="avatar avatar-xl avatar-online chat-sidebar-avatar">
                            <img src="{{ $user->photo }}" alt="Avatar" class="rounded-circle">
                        </div>
                        <h5 class="mt-4 mb-0">{{ $user->name }}</h5>
                        <span>{{ $user->Role->name }}</span>
                        <i class="fa fa-chevron-left cursor-pointer close-sidebar" data-bs-toggle="sidebar" data-overlay
                            data-target="#app-chat-sidebar-left"></i>
                    </div>
                    <form action="" method="post">
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
                                        <input name="chat-user-status" class="form-check-input" type="radio"
                                            name="status" value="active" id="user-active" checked>
                                        <label class="form-check-label" for="user-active">Online</label>
                                    </div>
                                    <div class="form-check form-check-warning">
                                        <input name="chat-user-status" class="form-check-input" type="radio"
                                            name="status" value="away" id="user-away">
                                        <label class="form-check-label" for="user-away">Gabut</label>
                                    </div>
                                    <div class="form-check form-check-danger">
                                        <input name="chat-user-status" class="form-check-input" type="radio"
                                            name="status" value="busy" id="user-busy">
                                        <label class="form-check-label" for="user-busy">Gabisa diganggu</label>
                                    </div>
                                    <div class="form-check form-check-secondary">
                                        <input name="chat-user-status" class="form-check-input" type="radio"
                                            name="status" value="offline" id="user-offline">
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
                            <div class="flex-shrink-0 avatar avatar-online me-4" data-bs-toggle="sidebar"
                                data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                                <img class="user-avatar rounded-circle cursor-pointer" src="{{ $user->photo }}"
                                    alt="Avatar">
                            </div>
                            <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                                <span class="input-group-text" id="basic-addon-search31"><i
                                        class="bx bx-search bx-sm"></i></span>
                                <input type="text" class="form-control chat-search-input" placeholder="Search..."
                                    aria-label="Search..." aria-describedby="basic-addon-search31">
                            </div>
                        </div>
                        <i class="bx bx-x bx-lg cursor-pointer position-absolute top-50 end-0 translate-middle d-lg-none d-block"
                            data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                    </div>
                    <div class="sidebar-body">
                        <!-- Chats -->
                        <ul class="list-unstyled chat-contact-list py-2 mb-0" id="chat-list">
                            <li class="chat-contact-list-item chat-contact-list-item-title mt-0">
                                <h5 class="text-primary mb-0">Santri</h5>
                            </li>
                            <li class="chat-contact-list-item chat-list-item-0 d-none">
                                <h6 class="text-muted mb-0">Opps...</h6>
                            </li>
                            <div id="contact">
                                {{-- @foreach ($admins as $admin)
                                    <li class="chat-contact-list-item mb-1 contact" data-id="{{ $admin->id }}">
                                        <a class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar avatar-{{ $admin->status }}">
                                                <img src="{{ $admin->photo }}" alt="Avatar" class="rounded-circle">
                                            </div>
                                            <div class="chat-contact-info flex-grow-1 ms-4">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="chat-contact-name text-truncate m-0 fw-normal">
                                                        {{ $admin->name }}
                                                    </h6>
                                                    <small
                                                        class="text-muted">{{ $admin->status === 'online' ? 'online' : $admin->updated_at->diffForHumans() }}</small>
                                                </div>
                                                <small class="chat-contact-status text-truncate">{{ $admin->bio }}</small>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach --}}
                            </div>
                        </ul>
                        {{-- <ul class="list-unstyled chat-contact-list py-2 mb-0" id="chat-list">
                            <li class="chat-contact-list-item chat-contact-list-item-title mt-0">
                                <h5 class="text-primary mb-0">Santri</h5>
                            </li>
                            <li class="chat-contact-list-item chat-list-item-0 d-none">
                                <h6 class="text-muted mb-0">Opps...</h6>
                            </li>
                            @foreach ($students as $student)
                                <li class="chat-contact-list-item mb-1 contact" data-id="{{ $student->User->id }}">
                                    <a class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar avatar-{{ $student->User->status }}">
                                            <img src="{{ $student->User->photo }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="chat-contact-name text-truncate m-0 fw-normal">
                                                    {{ $student->full_name }}
                                                </h6>
                                                <small
                                                    class="text-muted">{{ $student->User->status === 'online' ? 'online' : $student->User->updated_at->diffForHumans() }}</small>
                                            </div>
                                            <small class="chat-contact-status text-truncate">{{ $student->major }}</small>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul> --}}

                    </div>
                </div>
                <!-- /Chat contacts -->

                <!-- Chat History -->
                <div class="col app-chat-history">
                    <div class="chat-history-wrapper">
                        <div class="chat-history-body">
                            <ul class="list-unstyled chat-history" id="chat-history">
                                <p>Pilih kontak untuk memulai chat</p>
                            </ul>
                        </div>
                        <form class="d-none" id="message-form">
                            <div
                                class="chat-history-footer form-send-message d-flex justify-content-between align-items-center">
                                <input class="form-control message-input border-0 me-4 shadow-none"
                                    placeholder="Kirim pesann...">
                                <div class="message-actions d-flex align-items-center">
                                    <label for="attach-doc" class="form-label mb-0">
                                        <div class="btn btn-icon me-2">
                                            <i
                                                class="fa-solid fa-paperclip-vertical fa-md cursor-pointer mx-1 text-heading"></i>
                                        </div>
                                        <input type="file" id="attach-doc" hidden>
                                    </label>
                                    <button class="btn btn-primary d-flex send-msg-btn">
                                        <span class="align-middle d-md-inline-block d-none"><i
                                                class="fa-solid fa-paper-plane-top"></i></span>
                                        <i class="bx bx-paper-plane bx-sm ms-md-2 ms-0"></i>
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
