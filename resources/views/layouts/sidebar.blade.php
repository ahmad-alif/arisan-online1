<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="30" height="20" viewBox="0 0 30 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
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

    </ul>
    @endif
    @endif
    </ul>
</aside>
