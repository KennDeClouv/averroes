@extends('layouts.app')
@section('title', 'Chat app')

@section('page-script')
    <script src="{{ asset('assets/js/app-kanban.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jkanban/jkanban.js') }}"></script>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-kanban.css') }}">
@endsection

@section('content')
    {{-- @php
        $user = Auth::user();
    @endphp --}}
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-kanban">
            <div class="row">
                <div class="col-12">
                    <form class="kanban-add-new-board">
                        <label class="kanban-add-board-btn" for="kanban-add-board-input">
                            <i class="fa fa-plus"></i>
                            <span class="align-middle">Add new</span>
                        </label>
                        <input type="text" class="form-control w-px-250 kanban-add-board-input mb-4 d-none"
                            placeholder="Add Board Title" id="kanban-add-board-input" required />
                        <div class="mb-4 kanban-add-board-input d-none">
                            <button class="btn btn-primary btn-sm me-3">Add</button>
                            <button type="button"
                                class="btn btn-label-secondary btn-sm kanban-add-board-cancel-btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kanban Wrapper -->
            <div class="kanban-wrapper"></div>

            <!-- Edit Task/Task & Activities -->
            <div class="offcanvas offcanvas-end kanban-update-item-sidebar">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-0">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs mb-6 rounded-0">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-update">
                                    <i class="fa fa-edit fa-sm me-1_5"></i>
                                    <span class="align-middle">Edit</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content p-0">
                        <!-- Update item/tasks -->
                        <div class="tab-pane fade show active" id="tab-update" role="tabpanel">
                            <form>
                                <div class="mb-8 mt-2">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" id="title" class="form-control" placeholder="Enter Title" />
                                </div>
                                <div class="mb-8">
                                    <label class="form-label" for="due-date">Due Date</label>
                                    <input type="text" id="due-date" class="form-control"
                                        placeholder="Enter Due Date" />
                                </div>
                                <div class="mb-8">
                                    <label class="form-label" for="label"> Label</label>
                                    <select class="select2 select2-label form-select" id="label">
                                        <option data-color="bg-label-success" value="UX">UX</option>
                                        <option data-color="bg-label-warning" value="Images">
                                            Images
                                        </option>
                                        <option data-color="bg-label-info" value="Info">Info</option>
                                        <option data-color="bg-label-danger" value="Code Review">
                                            Code Review
                                        </option>
                                        <option data-color="bg-label-secondary" value="App">
                                            App
                                        </option>
                                        <option data-color="bg-label-primary" value="Charts & Maps">
                                            Charts & Maps
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label">Assigned</label>
                                    <div class="assigned d-flex flex-wrap"></div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="attachments">Attachments</label>
                                    <div>
                                        <input type="file" class="form-control" id="attachments" />
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex flex-wrap">
                                        <button type="button" class="btn btn-primary me-4" data-bs-dismiss="offcanvas">
                                            Update
                                        </button>
                                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="offcanvas">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
