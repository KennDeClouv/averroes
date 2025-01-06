<li class="menu-item {{ request()->routeIs('administrationadmin.student.*') ? 'open active' : '' }}">
    <a href="{{ route('administrationadmin.student.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-user fs-6"></i>
        <div class="text-truncate">
            Kesantrian
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('administrationadmin.student.index', 'administrationadmin.student.show', 'administrationadmin.student.edit') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.student.index') }}" class="menu-link">Data Santri</a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('administrationadmin.teacher.*') ? 'open active' : '' }}">
    <a href="{{ route('administrationadmin.teacher.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-user-vneck fs-6"></i>
        <div class="text-truncate">
            Kepegawaian
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('administrationadmin.teacher.index', 'administrationadmin.teacher.show', 'administrationadmin.teacher.edit') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.teacher.index') }}" class="menu-link">Data Pegawai</a>
        </li>
    </ul>
</li>
<li
    class="menu-item {{ request()->routeIs('administrationadmin.studentpermit.index') ? 'open active' : '' }}">
    <a href="{{ route('administrationadmin.room.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-school fs-6"></i>
        <div class="text-truncate">
            Kepesantrenan
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('administrationadmin.studentpermit.index', 'administrationadmin.studentpermit.show', 'administrationadmin.studentpermit.edit') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.studentpermit.index') }}" class="menu-link">Data Izin Santri</a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('administrationadmin.studentregistrant.*') ? 'open active' : '' }}">
    <a href="{{ route('administrationadmin.room.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-screen-users fs-6"></i>
        <div class="text-truncate">
            PPDB
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('administrationadmin.studentregistrant.index-user','administrationadmin.studentregistrant.create-user','administrationadmin.studentregistrant.edit-user') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.studentregistrant.index-user') }}" class="menu-link">Akun Calon Santri</a>
        </li>
        <li
            class="menu-item {{ request()->routeIs('administrationadmin.studentregistrant.index') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.studentregistrant.index') }}" class="menu-link">List Pendaftar</a>
        </li>
    </ul>
</li>
<li class="menu-item {{ request()->routeIs('administrationadmin.class.*','administrationadmin.room.*') ? 'open active' : '' }}">
    <a href="{{ route('administrationadmin.class.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-folders fs-6"></i>
        <div class="text-truncate">
            Master Data
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('administrationadmin.class.index', 'administrationadmin.class.show', 'administrationadmin.class.edit') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.class.index') }}" class="menu-link">Master Kelas</a>
        </li>
        <li
            class="menu-item {{ request()->routeIs('administrationadmin.room.index', 'administrationadmin.room.show', 'administrationadmin.room.edit') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.room.index') }}" class="menu-link">Master Kamar</a>
        </li>
    </ul>
</li>
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Tools</span>
</li>
<li class="menu-item {{ request()->routeIs('administrationadmin.announcement.*') ? 'open active' : '' }}">
    <a href="{{ route('administrationadmin.announcement.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-bullhorn fs-6"></i>
        <div class="text-truncate">
            Pengumuman
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('administrationadmin.announcement.index', 'administrationadmin.announcement.show', 'administrationadmin.announcement.edit') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.announcement.index') }}" class="menu-link">Daftar Pengumuman</a>
        </li>
        <li class="menu-item {{ request()->routeIs('administrationadmin.announcement.create') ? 'active' : '' }}">
            <a href="{{ route('administrationadmin.announcement.create') }}" class="menu-link">Tambah Pengumuman</a>
        </li>
    </ul>
</li>
