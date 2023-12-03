<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('img/logo.svg') }}" alt="{{ config('app.name') }}" class="brand-image img-circle elevation-3" width="32" height="26" viewBox="0 0 32 26">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ">Arisanku</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        @if (Auth::user()->active == 0)
            <li class="menu-item {{ $active === 'dashboard' ? 'active' : '' }}">
                <a class="menu-link" href="/dashboard">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Page 1">Dashboard</div>
                </a>
            </li>
        @elseif (Auth::user()->active == 1)
            @if (Auth::user()->role == 2)
                <li class="menu-item {{ $active === 'dashboard' ? 'active' : '' }}">
                    <a class="menu-link" href="/dashboard">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Page 1">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'manage-owner' ? 'active' : '' }}">
                    <a class="menu-link" href="/manage-owner">
                        <i class="menu-icon tf-icons ti ti-user-star"></i>
                        <div data-i18n="Page 2">Data Owner</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'manage-member' ? 'active' : '' }}">
                    <a class="menu-link" href="/data-member">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="Page 3">Data Member</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'manage-arisan' ? 'active' : '' }}">
                    <a class="menu-link" href="/data-arisan">
                        <i class="menu-icon tf-icons ti ti-table"></i>
                        <div data-i18n="Page 4">Data Arisan</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'notifikasi' ? 'active' : '' }}">
                    <a class="menu-link" href="/notifikasi">
                        <i class="menu-icon tf-icons ti ti-message"></i>
                        <div data-i18n="Page 4">Notifikasi</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'data-category' ? 'active' : '' }}">
                    <a class="menu-link" href="/data-category">
                        <i class="menu-icon tf-icons ti ti-layout-grid"></i>
                        <div data-i18n="Page 5">Data Kategori</div>
                    </a>
                </li>
            @elseif (Auth::user()->role == 1)
                <li class="menu-item {{ $active === 'dashboard' ? 'active' : '' }}">
                    <a class="menu-link" href="/dashboard">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Page 1">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'manage-arisan' ? 'active' : '' }}">
                    <a class="menu-link" href="/manage-arisan">
                        <i class="menu-icon tf-icons ti ti-table"></i>
                        <div data-i18n="Page 2">Kelola Arisan</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'manage-member' ? 'active' : '' }}">
                    <a class="menu-link" href="/manage-member">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="Page 3">Kelola Anggota</div>
                    </a>
                </li>
            @elseif (Auth::user()->role == 0)
                <li class="menu-item {{ $active === 'dashboard' ? 'active' : '' }}">
                    <a class="menu-link" href="/dashboard">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Page 1">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'list-arisan' ? 'active' : '' }}">
                    <a class="menu-link" href="/list-arisan">
                        <i class="menu-icon tf-icons ti ti-clipboard-plus"></i>
                        <div data-i18n="Page 2">Daftar Arisan</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'arisanku' ? 'active' : '' }}">
                    <a class="menu-link" href="/arisanku">
                        <i class="menu-icon tf-icons ti ti-mood-dollar"></i>
                        <div data-i18n="Page 2">Arisanku</div>
                    </a>
                </li>
                <li class="menu-item {{ $active === 'setoran' ? 'active' : '' }}">
                    <a class="menu-link" href="/setoran">
                        <i class="menu-icon tf-icons ti ti-calendar-dollar"></i>
                        <div data-i18n="Page 2">Setoran</div>
                    </a>
                </li>

    </ul>
    @endif
    @endif
    </ul>
</aside>
