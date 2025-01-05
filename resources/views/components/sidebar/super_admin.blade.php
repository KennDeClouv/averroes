<li class="menu-item {{ request()->routeIs('superadmin.admin.*') ? 'open active' : '' }}">
    <a href="{{ route('superadmin.admin.index') }}" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-user fs-6"></i>
        <div class="text-truncate">
            Admin
        </div>
    </a>
    <ul class="menu-sub">
        <li
            class="menu-item {{ request()->routeIs('superadmin.admin.index', 'superadmin.admin.show', 'superadmin.admin.edit') ? 'active' : '' }}">
            <a href="{{ route('superadmin.admin.index') }}" class="menu-link">Data Admin</a>
        </li>
        <li
            class="menu-item {{ request()->routeIs('superadmin.admin.create') ? 'active' : '' }}">
            <a href="{{ route('superadmin.admin.create') }}" class="menu-link">Tambah Admin</a>
        </li>
    </ul>
</li>
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">Tools</span>
</li>
<li class="menu-item {{ request()->routeIs('superadmin.logs.*') ? 'open active' : '' }}">
    <a href="{{ route('superadmin.logs.index') }}" class="menu-link ">
        <i class="menu-icon fa-solid fa-sheet-plastic fs-6"></i>
        <div class="text-truncate">
            Logs
        </div>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('superadmin.foldertree.*') ? 'open active' : '' }}">
    <a href="{{ route('superadmin.foldertree.index') }}" class="menu-link ">
        <i class="menu-icon fa-solid fa-folder-tree fs-6"></i>
        <div class="text-truncate">
            Folder Tree
        </div>
    </a>
</li>
