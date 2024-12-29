<li class="menu-item {{ request()->routeIs('teacher.studentpermit.*') ? 'open active' : '' }}">
    <a href="{{ route('teacher.studentpermit.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-file-signature fs-6"></i>
        <div class="text-truncate">
            Izin Santri
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('teacher.studentpermit.index', 'teacher.studentpermit.show', 'teacher.studentpermit.edit') ? 'active' : '' }}">
            <a href="{{ route('teacher.studentpermit.index') }}" class="menu-link">Daftar Izin Santri</a>
        </li>
        <li class="menu-item {{ request()->routeIs('teacher.studentpermit.create') ? 'active' : '' }}">
            <a href="{{ route('teacher.studentpermit.create') }}" class="menu-link">Tambah Izin Santri</a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('teacher.announcement.*') ? 'open active' : '' }}">
    <a href="{{ route('teacher.announcement.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-bullhorn fs-6"></i>
        <div class="text-truncate">
            Pengumuman
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('teacher.announcement.index', 'teacher.announcement.show', 'teacher.announcement.edit') ? 'active' : '' }}">
            <a href="{{ route('teacher.announcement.index') }}" class="menu-link">Daftar Pengumuman</a>
        </li>
        <li class="menu-item {{ request()->routeIs('teacher.announcement.create') ? 'active' : '' }}">
            <a href="{{ route('teacher.announcement.create') }}" class="menu-link">Tambah Pengumuman</a>
        </li>
    </ul>
</li>
