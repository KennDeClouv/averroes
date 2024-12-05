<li class="menu-item {{ request()->routeIs('admin.student.*') ? 'open active' : '' }}">
    <a href="{{ route('admin.student.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-user fs-6"></i>
        <div class="text-truncate">
            Santri
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('admin.student.index', 'admin.student.show', 'admin.student.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.student.index') }}" class="menu-link">Daftar Santri</a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.student.create') ? 'active' : '' }}">
            <a href="{{ route('admin.student.create') }}" class="menu-link">Tambah Santri</a>
        </li>
    </ul>
</li>

<li class="menu-item {{ request()->routeIs('admin.teacher.*') ? 'open active' : '' }}">
    <a href="{{ route('admin.teacher.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-user fs-6"></i>
        <div class="text-truncate">
            Ustadz
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('admin.teacher.index', 'admin.teacher.show', 'admin.teacher.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.teacher.index') }}" class="menu-link">Daftar Ustadz</a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.teacher.create') ? 'active' : '' }}">
            <a href="{{ route('admin.teacher.create') }}" class="menu-link">Tambah Ustadz</a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('admin.room.*') ? 'open active' : '' }}">
    <a href="{{ route('admin.room.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-bed fs-6"></i>
        <div class="text-truncate">
            Kamar
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('admin.room.index', 'admin.room.show', 'admin.room.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.room.index') }}" class="menu-link">Daftar Kamar</a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.room.create') ? 'active' : '' }}">
            <a href="{{ route('admin.room.create') }}" class="menu-link">Tambah Kamar</a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('admin.class.*') ? 'open active' : '' }}">
    <a href="{{ route('admin.class.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-screen-users fs-6"></i>
        <div class="text-truncate">
            Kelas
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('admin.class.index', 'admin.class.show', 'admin.class.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.class.index') }}" class="menu-link">Daftar Kelas</a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.class.create') ? 'active' : '' }}">
            <a href="{{ route('admin.class.create') }}" class="menu-link">Tambah Kelas</a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('admin.student-permit.*') ? 'open active' : '' }}">
    <a href="{{ route('admin.student-permit.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-file-signature fs-6"></i>
        <div class="text-truncate">
            Izin Santri
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.student-permit.index', 'admin.student-permit.show', 'admin.student-permit.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.student-permit.index') }}" class="menu-link">Daftar Izin Santri</a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.student-permit.create') ? 'active' : '' }}">
            <a href="{{ route('admin.student-permit.create') }}" class="menu-link">Tambah Izin Santri</a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('admin.announcement.*') ? 'open active' : '' }}">
    <a href="{{ route('admin.announcement.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-bullhorn fs-6"></i>
        <div class="text-truncate">
            Pengumuman
        </div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('admin.announcement.index', 'admin.announcement.show', 'admin.announcement.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.announcement.index') }}" class="menu-link">Daftar Pengumuman</a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.announcement.create') ? 'active' : '' }}">
            <a href="{{ route('admin.announcement.create') }}" class="menu-link">Tambah Pengumuman</a>
        </li>
    </ul>
</li>
