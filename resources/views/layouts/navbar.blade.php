<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-md"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="navbar-nav align-items-center">
            </div>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-">
                            @if (auth()->user()->foto_profil)
                                <span
                                    style="position: relative; display: inline-block; overflow: hidden; border-radius: 50%; width: 40px; height: 40px;">
                                    <img src="{{ Storage::url(auth()->user()->foto_profil) }}" alt="user image"
                                        class="d-block h-auto rounded user-profile-img"
                                        style="width: 100%; height: 100%; object-fit: cover;" onmouseover="zoomIn(this)"
                                        onmouseout="zoomOut(this)" />
                                </span>
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="default profile"
                                    class="h-auto rounded-circle" />
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <div class="dropdown-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-">
                                            @if (auth()->user()->foto_profil)
                                                <span
                                                    style="position: relative; display: inline-block; overflow: hidden; border-radius: 50%; width: 40px; height: 40px;">
                                                    <img src="{{ Storage::url(auth()->user()->foto_profil) }}"
                                                        alt="user image" class="d-block h-auto rounded user-profile-img"
                                                        style="width: 100%; height: 100%; object-fit: cover;"
                                                        onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" />
                                                </span>
                                            @else
                                                <img src="{{ asset('img/default.png') }}" alt="default profile"
                                                    class="h-auto rounded-circle" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-medium d-block">{{ auth()->user()->name }}</span>
                                        @if (Auth::user()->role == 2)
                                            <small class="text-muted">Admin</small>
                                        @elseif (Auth::user()->role == 1)
                                            <small class="text-muted">Owner</small>
                                        @elseif (Auth::user()->role == 0)
                                            <small class="text-muted">Pengguna</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/profile">
                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                <span class="align-middle">Profile Saya</span>
                            </a>
                        </li>
                        <a class="dropdown-item" href="/profile/ubah-profile">
                            <i class="ti ti-settings me-2 ti-sm"></i>
                            <span class="align-middle">Pengaturan Akun</span>
                        </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>
            </li>
            <!--/ User -->
            </ul>
        </div>
    </div>
</nav>
