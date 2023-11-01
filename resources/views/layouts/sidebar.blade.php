<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->active == 0)
            <li class="nav-item {{ $active === 'dashboard' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @elseif (Auth::user()->active == 1)
            @if (Auth::user()->role == 2)
                <li class="nav-item {{ $active === 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ $active === 'manage-owner' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/manage-owner">
                        <i class="bi bi-person-workspace"></i>
                        <span>Data Owner</span>
                    </a>
                </li>
                <li class="nav-item {{ $active === 'manage-member' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/data-member">
                        <i class="bi bi-person-fill-gear"></i>
                        <span>Data Member</span>
                    </a>
                </li>
                <li
                    class="nav-item dropdown {{ in_array($active, ['manage-arisan', 'manage-kategori']) ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#manageArisanMenu">
                        <i class="bi bi-back"></i>
                        <span>Arisan</span>
                        <span class="d-flex justify-content-between">
                            <i class="bi bi-chevron-down ml-auto"></i>
                        </span>
                    </a>
                    <div id="manageArisanMenu" class="collapse" style="margin-left: 20px;">
                        <!-- Sesuaikan nilai margin sesuai kebutuhan -->
                        <ul class="nav">
                            <li class="nav-item mt-1 w-100 {{ $active === 'manage-arisan' ? 'active' : '' }}">
                                <a class="nav-link" href="/data-arisan">
                                    <i class="bi bi-list-ul"></i>
                                    <span>Data Arisan</span>
                                </a>
                            </li>
                            <li class="nav-item w-100 {{ $active === 'data-categori' ? 'active' : '' }}">
                                <a class="nav-link" href="/data-category">
                                    <i class="bi bi-collection"></i>
                                    <span>Data Kategori</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @elseif (Auth::user()->role == 1)
                <li class="nav-item {{ $active === 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ $active === 'manage-arisan' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/manage-arisan">
                        <i class="bi bi-back"></i>
                        <span>Data Arisan</span>
                    </a>
                </li>
                <li class="nav-item {{ $active === 'manage-member' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/manage-member">
                        <i class="bi bi-person-fill-gear"></i>
                        <span>Data Member</span>
                    </a>
                </li>
            @elseif (Auth::user()->role == 0)
                <li class="nav-item {{ $active === 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ $active === 'list-arisan' ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="/list-arisan">
                        <i class="bi bi-view-list"></i>
                        <span>Daftar Arisan</span>
                    </a>
                </li>
            @endif
        @endif

    </ul>
</aside>
