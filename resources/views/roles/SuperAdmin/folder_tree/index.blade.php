@extends('layouts.app')
@section('title', 'Struktur Folder ')

@section('page-script')
    <script src="{{ asset('assets/vendor/libs/jstree/jstree.js') }}"></script>
    <script>
        $(function() {
            var theme = $("html").hasClass("light-style") ? "default" : "default-dark";
            var treeElement = $("#jstree-custom-icons");
            const icons = {
                // folder
                folder: "fa-regular fa-folder text-warning",
                app: "fa-solid fa-browser text-warning",
                config: "fa-regular fa-folder-gear text-warning",
                php: "fa-brands fa-php text-info",
                md: "fa-brands fa-markdown",
                git: "fa-brands fa-git-alt",
                // file
                file: "fa fa-file text-secondary",
                html: "fa-brands fa-html5 text-danger",
                css: "fa-brands fa-css3-alt text-info",
                img: "fa fa-image text-success",
                js: "fa-brands fa-square-js text-warning",
                blade: "fa-brands fa-laravel text-danger",
                json: "fa-solid fa-brackets-curly",
                database: "fa-solid fa-database",
            };

            // Menyiapkan konfigurasi `types`
            const types = {};
            for (const [key, icon] of Object.entries(icons)) {
                types[key] = {
                    icon
                };
            }
            if (treeElement.length) {
                treeElement.jstree({
                    core: {
                        themes: {
                            name: theme
                        },
                        data: {!! $jsTreeData !!},
                    },
                    plugins: ["types"],
                    types: types,
                });
            }
        });
    </script>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jstree/jstree.css') }}">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <h5 class="card-header">Struktur Folder</h5>
            <div class="card-body">
                <i class="fa-regular fa-folder text-warning"></i> {{ config('app.name') }}
                <div id="jstree-custom-icons"></div>
            </div>
        </div>
    </div>
@endsection
