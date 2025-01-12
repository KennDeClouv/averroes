@php
    $rolePrefix = 'student';
@endphp
<li class="menu-item {{ request()->routeIs($rolePrefix . '.permit.*') ? 'open active' : '' }}">
    <a href="{{ route($rolePrefix . '.permit.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-file-signature fs-6"></i>
        <div class="text-truncate">
            Izin Kamu
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs($rolePrefix . '.permit.index', $rolePrefix . '.permit.show', $rolePrefix . '.permit.edit') ? 'active' : '' }}">
            <a href="{{ route($rolePrefix . '.permit.index') }}" class="menu-link">Daftar Izin Kamu</a>
        </li>
        <li class="menu-item {{ request()->routeIs($rolePrefix . '.permit.create') ? 'active' : '' }}">
            <a href="{{ route($rolePrefix . '.permit.create') }}" class="menu-link">Tambah Izin Kamu</a>
        </li>
    </ul>
</li>
