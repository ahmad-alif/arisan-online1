@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Pengaturan Akun')
@section('content')
<div class="layout-page">
    <!-- Navbar -->

    <nav
      class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
      id="layout-navbar">
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="ti ti-menu-2 ti-sm"></i>
        </a>
      </div>

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item navbar-search-wrapper mb-0">
            <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
              <i class="ti ti-search ti-md me-2"></i>
              <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
            </a>
          </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Language -->
          <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <i class="ti ti-language rounded-circle ti-md"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-language="en">
                  <span class="align-middle">English</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
                  <span class="align-middle">French</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-language="de">
                  <span class="align-middle">German</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-language="pt">
                  <span class="align-middle">Portuguese</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ Language -->

          <!-- Quick links  -->
          <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
            <a
              class="nav-link dropdown-toggle hide-arrow"
              href="javascript:void(0);"
              data-bs-toggle="dropdown"
              data-bs-auto-close="outside"
              aria-expanded="false">
              <i class="ti ti-layout-grid-add ti-md"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end py-0">
              <div class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                  <a
                    href="javascript:void(0)"
                    class="dropdown-shortcuts-add text-body"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Add shortcuts"
                    ><i class="ti ti-sm ti-apps"></i
                  ></a>
                </div>
              </div>
              <div class="dropdown-shortcuts-list scrollable-container">
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-calendar fs-4"></i>
                    </span>
                    <a href="app-calendar.html" class="stretched-link">Calendar</a>
                    <small class="text-muted mb-0">Appointments</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-file-invoice fs-4"></i>
                    </span>
                    <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                    <small class="text-muted mb-0">Manage Accounts</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-users fs-4"></i>
                    </span>
                    <a href="app-user-list.html" class="stretched-link">User App</a>
                    <small class="text-muted mb-0">Manage Users</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-lock fs-4"></i>
                    </span>
                    <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                    <small class="text-muted mb-0">Permission</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-chart-bar fs-4"></i>
                    </span>
                    <a href="index.html" class="stretched-link">Dashboard</a>
                    <small class="text-muted mb-0">User Profile</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-settings fs-4"></i>
                    </span>
                    <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                    <small class="text-muted mb-0">Account Settings</small>
                  </div>
                </div>
                <div class="row row-bordered overflow-visible g-0">
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-help fs-4"></i>
                    </span>
                    <a href="pages-faq.html" class="stretched-link">FAQs</a>
                    <small class="text-muted mb-0">FAQs & Articles</small>
                  </div>
                  <div class="dropdown-shortcuts-item col">
                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                      <i class="ti ti-square fs-4"></i>
                    </span>
                    <a href="modal-examples.html" class="stretched-link">Modals</a>
                    <small class="text-muted mb-0">Useful Popups</small>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- Quick links -->

          <!-- Notification -->
          <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a
              class="nav-link dropdown-toggle hide-arrow"
              href="javascript:void(0);"
              data-bs-toggle="dropdown"
              data-bs-auto-close="outside"
              aria-expanded="false">
              <i class="ti ti-bell ti-md"></i>
              <span class="badge bg-danger rounded-pill badge-notifications">5</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
              <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Notification</h5>
                  <a
                    href="javascript:void(0)"
                    class="dropdown-notifications-all text-body"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Mark all as read"
                    ><i class="ti ti-mail-opened fs-4"></i
                  ></a>
                </div>
              </li>
              <li class="dropdown-notifications-list scrollable-container">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item list-group-item-action dropdown-notifications-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                        <p class="mb-0">Won the monthly best seller gold badge</p>
                        <small class="text-muted">1h ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item list-group-item-action dropdown-notifications-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">Charles Franklin</h6>
                        <p class="mb-0">Accepted your connection</p>
                        <small class="text-muted">12hr ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <img src="../../assets/img/avatars/2.png" alt class="h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">New Message ✉️</h6>
                        <p class="mb-0">You have new message from Natalie</p>
                        <small class="text-muted">1h ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item list-group-item-action dropdown-notifications-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <span class="avatar-initial rounded-circle bg-label-success"
                            ><i class="ti ti-shopping-cart"></i
                          ></span>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                        <p class="mb-0">ACME Inc. made new order $1,154</p>
                        <small class="text-muted">1 day ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <img src="../../assets/img/avatars/9.png" alt class="h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">Application has been approved 🚀</h6>
                        <p class="mb-0">Your ABC project application has been approved.</p>
                        <small class="text-muted">2 days ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <span class="avatar-initial rounded-circle bg-label-success"
                            ><i class="ti ti-chart-pie"></i
                          ></span>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">Monthly report is generated</h6>
                        <p class="mb-0">July monthly financial report is generated</p>
                        <small class="text-muted">3 days ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <img src="../../assets/img/avatars/5.png" alt class="h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">Send connection request</h6>
                        <p class="mb-0">Peter sent you connection request</p>
                        <small class="text-muted">4 days ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item list-group-item-action dropdown-notifications-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <img src="../../assets/img/avatars/6.png" alt class="h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">New message from Jane</h6>
                        <p class="mb-0">Your have new message from Jane</p>
                        <small class="text-muted">5 days ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <span class="avatar-initial rounded-circle bg-label-warning"
                            ><i class="ti ti-alert-triangle"></i
                          ></span>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-1">CPU is running high</h6>
                        <p class="mb-0">CPU Utilization Percent is currently at 88.63%,</p>
                        <small class="text-muted">5 days ago</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a href="javascript:void(0)" class="dropdown-notifications-read"
                          ><span class="badge badge-dot"></span
                        ></a>
                        <a href="javascript:void(0)" class="dropdown-notifications-archive"
                          ><span class="ti ti-x"></span
                        ></a>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="dropdown-menu-footer border-top">
                <a
                  href="javascript:void(0);"
                  class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                  View all notifications
                </a>
              </li>
            </ul>
          </li>
          <!--/ Notification -->

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="pages-account-settings-account.html">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-medium d-block">John Doe</span>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-profile-user.html">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-account.html">
                  <i class="ti ti-settings me-2 ti-sm"></i>
                  <span class="align-middle">Settings</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-billing.html">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                    <span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20"
                      >2</span
                    >
                  </span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-faq.html">
                  <i class="ti ti-help me-2 ti-sm"></i>
                  <span class="align-middle">FAQ</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-pricing.html">
                  <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                  <span class="align-middle">Pricing</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="auth-login-cover.html" target="_blank">
                  <i class="ti ti-logout me-2 ti-sm"></i>
                  <span class="align-middle">Log Out</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input
          type="text"
          class="form-control search-input container-xxl border-0"
          placeholder="Search..."
          aria-label="Search..." />
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
      </div>
    </nav>

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">User / View /</span> Security</h4>
        <div class="row">
          <!-- User Sidebar -->
          <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
              <div class="card-body">
                <div class="user-avatar-section">
                  <div class="d-flex align-items-center flex-column">
                    <img
                      class="img-fluid rounded mb-3 pt-1 mt-4"
                      src="../../assets/img/avatars/15.png"
                      height="100"
                      width="100"
                      alt="User avatar" />
                    <div class="user-info text-center">
                      <h4 class="mb-2">Violet Mendoza</h4>
                      <span class="badge bg-label-secondary mt-1">Author</span>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                  <div class="d-flex align-items-start me-4 mt-3 gap-2">
                    <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-checkbox ti-sm"></i></span>
                    <div>
                      <p class="mb-0 fw-medium">1.23k</p>
                      <small>Tasks Done</small>
                    </div>
                  </div>
                  <div class="d-flex align-items-start mt-3 gap-2">
                    <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-briefcase ti-sm"></i></span>
                    <div>
                      <p class="mb-0 fw-medium">568</p>
                      <small>Projects Done</small>
                    </div>
                  </div>
                </div>
                <p class="mt-4 small text-uppercase text-muted">Details</p>
                <div class="info-container">
                  <ul class="list-unstyled">
                    <li class="mb-2">
                      <span class="fw-medium me-1">Username:</span>
                      <span>violet.dev</span>
                    </li>
                    <li class="mb-2 pt-1">
                      <span class="fw-medium me-1">Email:</span>
                      <span>vafgot@vultukir.org</span>
                    </li>
                    <li class="mb-2 pt-1">
                      <span class="fw-medium me-1">Status:</span>
                      <span class="badge bg-label-success">Active</span>
                    </li>
                    <li class="mb-2 pt-1">
                      <span class="fw-medium me-1">Role:</span>
                      <span>Author</span>
                    </li>
                    <li class="mb-2 pt-1">
                      <span class="fw-medium me-1">Tax id:</span>
                      <span>Tax-8965</span>
                    </li>
                    <li class="mb-2 pt-1">
                      <span class="fw-medium me-1">Contact:</span>
                      <span>(123) 456-7890</span>
                    </li>
                    <li class="mb-2 pt-1">
                      <span class="fw-medium me-1">Languages:</span>
                      <span>French</span>
                    </li>
                    <li class="pt-1">
                      <span class="fw-medium me-1">Country:</span>
                      <span>England</span>
                    </li>
                  </ul>
                  <div class="d-flex justify-content-center">
                    <a
                      href="javascript:;"
                      class="btn btn-primary me-3"
                      data-bs-target="#editUser"
                      data-bs-toggle="modal"
                      >Edit</a
                    >
                    <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /User Card -->
            <!-- Plan Card -->
            <div class="card mb-4">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                  <span class="badge bg-label-primary">Standard</span>
                  <div class="d-flex justify-content-center">
                    <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">$</sup>
                    <h1 class="fw-medium mb-0 text-primary">99</h1>
                    <sub class="h6 pricing-duration mt-auto mb-2 fw-normal text-muted">/month</sub>
                  </div>
                </div>
                <ul class="ps-3 g-2 my-3">
                  <li class="mb-2">10 Users</li>
                  <li class="mb-2">Up to 10 GB storage</li>
                  <li>Basic Support</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mb-1 fw-medium text-heading">
                  <span>Days</span>
                  <span>65% Completed</span>
                </div>
                <div class="progress mb-1" style="height: 8px">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: 65%"
                    aria-valuenow="65"
                    aria-valuemin="0"
                    aria-valuemax="100"></div>
                </div>
                <span>4 days remaining</span>
                <div class="d-grid w-100 mt-4">
                  <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                    Upgrade Plan
                  </button>
                </div>
              </div>
            </div>
            <!-- /Plan Card -->
          </div>
          <!--/ User Sidebar -->

          <!-- User Content -->
          <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
            <!-- User Pills -->
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
              <li class="nav-item">
                <a class="nav-link" href="app-user-view-account.html"
                  ><i class="ti ti-user-check me-1 ti-xs"></i>Account</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"
                  ><i class="ti ti-lock me-1 ti-xs"></i>Security</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="app-user-view-billing.html"
                  ><i class="ti ti-currency-dollar me-1 ti-xs"></i>Billing & Plans</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="app-user-view-notifications.html"
                  ><i class="ti ti-bell me-1 ti-xs"></i>Notifications</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="app-user-view-connections.html"
                  ><i class="ti ti-link me-1 ti-xs"></i>Connections</a
                >
              </li>
            </ul>
            <!--/ User Pills -->

            <!-- Change Password -->
            <div class="card mb-4">
              <h5 class="card-header">Change Password</h5>
              <div class="card-body">
                <form id="formChangePassword" method="POST" onsubmit="return false">
                  <div class="alert alert-warning" role="alert">
                    <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                    <span>Minimum 8 characters long, uppercase & symbol</span>
                  </div>
                  <div class="row">
                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                      <label class="form-label" for="newPassword">New Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          class="form-control"
                          type="password"
                          id="newPassword"
                          name="newPassword"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>

                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                      <label class="form-label" for="confirmPassword">Confirm New Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          class="form-control"
                          type="password"
                          name="confirmPassword"
                          id="confirmPassword"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary me-2">Change Password</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!--/ Change Password -->

            <!-- Two-steps verification -->
            <div class="card mb-4">
              <h5 class="card-header pb-2">Two-steps verification</h5>
              <div class="card-body">
                <span>Keep your account secure with authentication step.</span>
                <h6 class="mt-3 mb-2">SMS</h6>
                <div class="d-flex justify-content-between border-bottom mb-3 pb-2">
                  <span>+1(968) 945-8832</span>
                  <div class="action-icons">
                    <a
                      href="javascript:;"
                      class="text-body me-1"
                      data-bs-target="#enableOTP"
                      data-bs-toggle="modal"
                      ><i class="ti ti-edit ti-sm"></i
                    ></a>
                    <a href="javascript:;" class="text-body"><i class="ti ti-trash ti-sm"></i></a>
                  </div>
                </div>
                <p class="mb-0">
                  Two-factor authentication adds an additional layer of security to your account by requiring more
                  than just a password to log in.
                  <a href="javascript:void(0);" class="text-body">Learn more.</a>
                </p>
              </div>
            </div>
            <!--/ Two-steps verification -->

            <!-- Recent Devices -->
            <div class="card mb-4">
              <h5 class="card-header">Recent Devices</h5>
              <div class="table-responsive">
                <table class="table border-top">
                  <thead>
                    <tr>
                      <th class="text-truncate">Browser</th>
                      <th class="text-truncate">Device</th>
                      <th class="text-truncate">Location</th>
                      <th class="text-truncate">Recent Activities</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-truncate">
                        <i class="ti ti-brand-windows text-info ti-xs me-2"></i>
                        <span class="fw-medium">Chrome on Windows</span>
                      </td>
                      <td class="text-truncate">HP Spectre 360</td>
                      <td class="text-truncate">Switzerland</td>
                      <td class="text-truncate">10, July 2021 20:07</td>
                    </tr>
                    <tr>
                      <td class="text-truncate">
                        <i class="ti ti-device-mobile text-danger ti-xs me-2"></i>
                        <span class="fw-medium">Chrome on iPhone</span>
                      </td>
                      <td class="text-truncate">iPhone 12x</td>
                      <td class="text-truncate">Australia</td>
                      <td class="text-truncate">13, July 2021 10:10</td>
                    </tr>
                    <tr>
                      <td class="text-truncate">
                        <i class="ti ti-brand-android text-success ti-xs me-2"></i>
                        <span class="fw-medium">Chrome on Android</span>
                      </td>
                      <td class="text-truncate">Oneplus 9 Pro</td>
                      <td class="text-truncate">Dubai</td>
                      <td class="text-truncate">14, July 2021 15:15</td>
                    </tr>
                    <tr>
                      <td class="text-truncate">
                        <i class="ti ti-brand-apple ti-xs me-2"></i>
                        <span class="fw-medium">Chrome on MacOS</span>
                      </td>
                      <td class="text-truncate">Apple iMac</td>
                      <td class="text-truncate">India</td>
                      <td class="text-truncate">16, July 2021 16:17</td>
                    </tr>
                    <tr>
                      <td class="text-truncate">
                        <i class="ti ti-brand-windows text-info ti-xs me-2"></i>
                        <span class="fw-medium">Chrome on Windows</span>
                      </td>
                      <td class="text-truncate">HP Spectre 360</td>
                      <td class="text-truncate">Switzerland</td>
                      <td class="text-truncate">20, July 2021 21:01</td>
                    </tr>
                    <tr>
                      <td class="text-truncate border-bottom-0">
                        <i class="ti ti-brand-android text-success ti-xs me-2"></i>
                        <span class="fw-medium">Chrome on Android</span>
                      </td>
                      <td class="text-truncate border-bottom-0">Oneplus 9 Pro</td>
                      <td class="text-truncate border-bottom-0">Dubai</td>
                      <td class="text-truncate border-bottom-0">21, July 2021 12:22</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Recent Devices -->
          </div>
          <!--/ User Content -->
        </div>

        <!-- Modals -->
        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                  <h3 class="mb-2">Edit User Information</h3>
                  <p class="text-muted">Updating user details will receive a privacy audit.</p>
                </div>
                <form id="editUserForm" class="row g-3" onsubmit="return false">
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">First Name</label>
                    <input
                      type="text"
                      id="modalEditUserFirstName"
                      name="modalEditUserFirstName"
                      class="form-control"
                      placeholder="John" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserLastName">Last Name</label>
                    <input
                      type="text"
                      id="modalEditUserLastName"
                      name="modalEditUserLastName"
                      class="form-control"
                      placeholder="Doe" />
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="modalEditUserName">Username</label>
                    <input
                      type="text"
                      id="modalEditUserName"
                      name="modalEditUserName"
                      class="form-control"
                      placeholder="john.doe.007" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserEmail">Email</label>
                    <input
                      type="text"
                      id="modalEditUserEmail"
                      name="modalEditUserEmail"
                      class="form-control"
                      placeholder="example@domain.com" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserStatus">Status</label>
                    <select
                      id="modalEditUserStatus"
                      name="modalEditUserStatus"
                      class="select2 form-select"
                      aria-label="Default select example">
                      <option selected>Status</option>
                      <option value="1">Active</option>
                      <option value="2">Inactive</option>
                      <option value="3">Suspended</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditTaxID">Tax ID</label>
                    <input
                      type="text"
                      id="modalEditTaxID"
                      name="modalEditTaxID"
                      class="form-control modal-edit-tax-id"
                      placeholder="123 456 7890" />
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                    <div class="input-group">
                      <span class="input-group-text">US (+1)</span>
                      <input
                        type="text"
                        id="modalEditUserPhone"
                        name="modalEditUserPhone"
                        class="form-control phone-number-mask"
                        placeholder="202 555 0111" />
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserLanguage">Language</label>
                    <select
                      id="modalEditUserLanguage"
                      name="modalEditUserLanguage"
                      class="select2 form-select"
                      multiple>
                      <option value="">Select</option>
                      <option value="english" selected>English</option>
                      <option value="spanish">Spanish</option>
                      <option value="french">French</option>
                      <option value="german">German</option>
                      <option value="dutch">Dutch</option>
                      <option value="hebrew">Hebrew</option>
                      <option value="sanskrit">Sanskrit</option>
                      <option value="hindi">Hindi</option>
                    </select>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserCountry">Country</label>
                    <select
                      id="modalEditUserCountry"
                      name="modalEditUserCountry"
                      class="select2 form-select"
                      data-allow-clear="true">
                      <option value="">Select</option>
                      <option value="Australia">Australia</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Brazil">Brazil</option>
                      <option value="Canada">Canada</option>
                      <option value="China">China</option>
                      <option value="France">France</option>
                      <option value="Germany">Germany</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Japan">Japan</option>
                      <option value="Korea">Korea, Republic of</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Philippines">Philippines</option>
                      <option value="Russia">Russian Federation</option>
                      <option value="South Africa">South Africa</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Emirates">United Arab Emirates</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="United States">United States</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="switch">
                      <input type="checkbox" class="switch-input" />
                      <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                      </span>
                      <span class="switch-label">Use as a billing address?</span>
                    </label>
                  </div>
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <button
                      type="reset"
                      class="btn btn-label-secondary"
                      data-bs-dismiss="modal"
                      aria-label="Close">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--/ Edit User Modal -->

        <!-- Enable OTP Modal -->
        <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                  <h3 class="mb-2">Enable One Time Password</h3>
                  <p>Verify Your Mobile Number for SMS</p>
                </div>
                <p>Enter your mobile phone number with country code and we will send you a verification code.</p>
                <form id="enableOTPForm" class="row g-3" onsubmit="return false">
                  <div class="col-12">
                    <label class="form-label" for="modalEnableOTPPhone">Phone Number</label>
                    <div class="input-group">
                      <span class="input-group-text">US (+1)</span>
                      <input
                        type="text"
                        id="modalEnableOTPPhone"
                        name="modalEnableOTPPhone"
                        class="form-control phone-number-otp-mask"
                        placeholder="202 555 0111" />
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <button
                      type="reset"
                      class="btn btn-label-secondary"
                      data-bs-dismiss="modal"
                      aria-label="Close">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--/ Enable OTP Modal -->

        <!-- Add New Credit Card Modal -->
        <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
            <div class="modal-content p-3 p-md-5">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                  <h3 class="mb-2">Upgrade Plan</h3>
                  <p>Choose the best plan for user.</p>
                </div>
                <form id="upgradePlanForm" class="row g-3" onsubmit="return false">
                  <div class="col-sm-8">
                    <label class="form-label" for="choosePlan">Choose Plan</label>
                    <select id="choosePlan" name="choosePlan" class="form-select" aria-label="Choose Plan">
                      <option selected>Choose Plan</option>
                      <option value="standard">Standard - $99/month</option>
                      <option value="exclusive">Exclusive - $249/month</option>
                      <option value="Enterprise">Enterprise - $499/month</option>
                    </select>
                  </div>
                  <div class="col-sm-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Upgrade</button>
                  </div>
                </form>
              </div>
              <hr class="mx-md-n5 mx-n3" />
              <div class="modal-body">
                <p class="mb-0">User current plan is standard plan</p>
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                  <div class="d-flex justify-content-center me-2">
                    <sup class="h6 pricing-currency pt-1 mt-3 mb-0 me-1 text-primary">$</sup>
                    <h1 class="display-5 mb-0 text-primary">99</h1>
                    <sub class="h5 pricing-duration mt-auto mb-2 text-muted">/month</sub>
                  </div>
                  <button class="btn btn-label-danger cancel-subscription mt-3">Cancel Subscription</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Add New Credit Card Modal -->

        <!-- /Modals -->
      </div>
      <!-- / Content -->

      <!-- Footer -->
      <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl">
          <div
            class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
            <div>
              ©
              <script>
                document.write(new Date().getFullYear());
              </script>
              , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="fw-medium">Pixinvent</a>
            </div>
            <div class="d-none d-lg-inline-block">
              <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank"
                >License</a
              >
              <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4"
                >More Themes</a
              >

              <a
                href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                target="_blank"
                class="footer-link me-4"
                >Documentation</a
              >

              <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block"
                >Support</a
              >
            </div>
          </div>
        </div>
      </footer>
      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>
@endsection
