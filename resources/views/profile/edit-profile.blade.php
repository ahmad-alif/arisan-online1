@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ubah Kata Sandi')
@section('content')

<body>
<div class="layout-wrapper">
    <div class="layout-container">
        <div class="content-wrapper">
            <!-- Content -->
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <span class="alert-icon text-success me-2">
                        <i class="ti ti-check ti-xs"></i>
                    </span>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <span class="alert-icon text-danger me-2">
                        <i class="ti ti-ban ti-xs"></i>
                    </span>
                    {{ session('error') }}
                </div>
            @endif
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                  <!-- User Card -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            @if (auth()->user()->foto_profil)
                                        <img src="{{ Storage::url(auth()->user()->foto_profil) }}"
                                        class="img-fluid rounded mb-3 pt-1 mt-4"
                                        height="100"
                                        width="100"
                                        alt="User avatar" />
                                    @else
                                        <img src="{{ asset('img/default.png') }}"
                                        class="img-fluid rounded mb-3 pt-1 mt-4"
                                        height="100"
                                        width="100"
                                        alt="Default User avatar" />
                                    @endif
                          <div class="user-info text-center">
                            <h4 class="mb-2">{{ auth()->user()->name }}</h4>
                            <span class="badge bg-label-secondary mt-1">
                                @if (Auth::user()->role == 2)
                                Admin
                            @elseif (Auth::user()->role == 1)
                               Owner</small>
                            @elseif (Auth::user()->role == 0)
                                Pengguna
                            @endif
                            </span>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
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
                      </div> --}}
                      <p class="mt-4 small text-uppercase text-muted">Detail Akun</p>
                      <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="fw-medium me-1">Nama Lengkap</span>
                                <span>{{ auth()->user()->name }}</span>
                              </li>
                          <li class="mb-2  pt-1">
                            <span class="fw-medium me-1">Username:</span>
                            <span>{{ auth()->user()->username }}</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Email:</span>
                            <span>{{ auth()->user()->email }}</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">Status:</span>
                            <span class="badge bg-label-success">Active</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">No Hp:</span>
                            <span>{{ auth()->user()->nohp }}</span>
                          </li>
                        </ul>
                        <div class="d-flex justify-content-center">
                          <a
                            href="javascript:;"
                            class="btn btn-primary me-3"
                            data-bs-target="#editUser"
                            data-bs-toggle="modal"
                            >Ubah</a
                          >
                          <a href="javascript:;" class="btn btn-label-danger suspend-user">Hapus Akun</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /User Card -->
                  <!-- Plan Card -->
                  {{-- <div class="card mb-4">
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
                  </div> --}}
                  <!-- /Plan Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                  <!-- User Pills -->

                  <!--/ User Pills -->

                  <!-- Change Password -->
                  {{-- <div class="card mb-4">
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
                  </div> --}}
                  <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update-password') }}" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="old_password" class="form-label">Password Lama</label>
                                    <input class="form-control" type="password" id="old_password" name="old_password" autofocus />
                                    <div id="password-feedback"></div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="new_password" class="form-label">Password Baru</label>
                                    <input class="form-control" type="password" id="new_password" name="new_password" autofocus />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <input class="form-control" type="password" id="new_password_confirmation"
                                        name="new_password_confirmation" />
                                </div>

                                <div class="mb-3 col-md-12">
                                    <div id="password-error" class="text-danger"></div>
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <h5 class="alert-heading mb-2">Minimal 8 Karakter</h5>
                                    <span>disarankan menggunakan huruf besar, kecil & simbol</span>
                                  </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Change Password</button>
                                <button type="reset" class="btn btn-label-secondary waves-effect">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>

                  <!--/ Change Password -->

                  <!-- Two-steps verification -->
                  {{-- <div class="card mb-4">
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
                  </div> --}}
                  <div class="card mb-4">
                    <h5 class="card-header">Ubah Foto Profil</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @if (auth()->user()->foto_profil)
                                <span style="position: relative; display: inline-block; overflow: hidden; border-radius: 50%; width: 100px; height: 100px;">
                                    <img id="previewImage" src="{{ Storage::url(auth()->user()->foto_profil) }}" alt="user image"
                                        class="d-block h-auto rounded user-profile-img" style="width: 100%; height: 100%; object-fit: cover;"
                                        onmouseover="zoomIn(this)" onmouseout="zoomOut(this)" />
                                </span>
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="default user image"
                                    class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px" />
                            @endif

                            <div class="button-wrapper">
                                <form action="{{ route('update-foto') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="upload" class="btn btn-primary me-2 mb-3 w-60" tabindex="0">
                                        <span class="d-none d-sm-block">Unggah Foto Baru</span>
                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg"
                                            name="foto_profil" onchange="previewImage(this)">
                                    </label>
                                    {{-- <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button> --}}
                                    <div class="ml-1">
                                        <button type="submit" class="btn btn-label-success mb-3 w-60">Simpan Perubahan</button>
                                    </div>
                                </form>

                                <small class="text-muted">Hanya JPG, GIF, atau PNG yang bisa diunggah. Maksimal ukuran 2MB</small>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                </div>

                  <!--/ Two-steps verification -->

                  <!-- Recent Devices -->
                  {{-- <div class="card mb-4">
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
                  </div> --}}
                  <!--/ Recent Devices -->
                </div>
                <!--/ User Content -->
              </div>

              <!-- Modals -->
              <!-- Edit User Modal -->
              {{-- <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
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
              </div> --}}
              <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Ubah Informasi Akun</h3>
                                <p class="text-muted">ubah detail akun anda dengan teliti</p>
                            </div>

                            <!-- Form from formAccountSettings -->
                            <form id="formAccountSettings" enctype="multipart/form-data" method="POST" action="{{ route('update-profile') }}">
                                @csrf
                                <h4 class="card-text">Ubah Profil</h4>
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" id="name" name="name" autofocus value="{{ auth()->user()->name }}" />
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="username" class="form-label">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" autofocus value="{{ auth()->user()->username }}" disabled />
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="text" id="email" name="email" autofocus value="{{ auth()->user()->email }}" disabled />
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Simpan perubahan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                            <!-- End of Form -->
                        </div>
                    </div>
                </div>
            </div>

              <!--/ Edit User Modal -->

              <!-- Enable OTP Modal -->
              {{-- <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
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
              </div> --}}
              <!--/ Enable OTP Modal -->

              <!-- Add New Credit Card Modal -->
              {{-- <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
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
              </div> --}}
              <!--/ Add New Credit Card Modal -->

              <!-- /Modals -->
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#old_password').on('input', function() {
                var oldPassword = $(this).val();

                // Buat permintaan Ajax untuk memeriksa kata sandi lama
                $.ajax({
                    url: '{{ route('check-old-password') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'old_password': oldPassword
                    },
                    success: function(response) {
                        if (response.valid) {
                            $('#password-feedback').html('<p class="text-success">Password lama benar.</p>');
                        } else {
                            $('#password-feedback').html('<p class="text-danger">Password lama salah.</p>');
                        }
                    }
                });
            });
        });
      </script>


      <script>
        $(document).ready(function() {
            $('#new_password_confirmation').on('input', function() {
                var new_password = $('#new_password').val();
                var confirmPassword = $(this).val();
                var errorDiv = $('#password-error');

                if (new_password === confirmPassword) {
                    errorDiv.text('');
                } else {
                    errorDiv.text('Password Tidak Cocok');
                }
            });
        });
      </script>

<script>
    function previewImage(input) {
        var preview = document.querySelector('.user-profile-img');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('img/default.png') }}"; // Ganti dengan URL gambar default
        }
    }
</script>
</body>
@endsection
