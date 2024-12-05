<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme pb-5">
    <div class="app-brand demo" style="padding-left: 22px">
        <a href="{{ route(str_replace('_', '', Auth::user()->Role->code) . '.home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                {{-- <img src="{{ asset(env('APP_LOGO')) }}" alt="{{ env('APP_NAME') . ' logo' }}"
                    style="max-width:40px; border-radius:5px"> --}}
                <i class="icon-averroes fs-2 text-primary"></i>
            </span>
            <span class="app-brand-text demo menu-text text-primary fw-semibold ms-2">{{ env('APP_NAME') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="fa-solid fa-chevron-left d-flex align-items-center justify-content-center"></i>
        </a>
    </div>
    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->routeIs('*.home') ? 'active' : '' }}">
            <a href="{{ route(str_replace('_', '', Auth::user()->Role->code) . '.home') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-house fs-6"></i>
                <div class="text-truncate">
                    Beranda
                </div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu</span>
        </li>
        @switch(Auth::user()->Role->code)
            @case('admin')
                @include('components.sidebar.admin')
            @break

            @case('student')
                @include('components.sidebar.student')
            @break

            @case('teacher')
                @include('components.sidebar.teacher')
            @break

            @default
        @endswitch

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Profile</span>
        </li>
        <li class="menu-item {{ request()->routeIs('account.index') ? 'active' : '' }}">
            <a href="{{ route('account.index') }}" class="menu-link">
                <i class="menu-icon fa-solid fa-address-card fs-6"></i>
                <div class="text-truncate" data-i18n="Profile">Profile</div>
            </a>
        </li>
    </ul>
</aside>
