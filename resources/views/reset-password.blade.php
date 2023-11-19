<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Lupa Password | Arisanku</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="../../assets/vendor/libs/bs-stepper/bs-stepper.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->

    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <!-- Left Text -->
        <div
          class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-5 auth-cover-bg-color position-relative auth-multisteps-bg-height">
          <img
            src="../../assets/img/illustrations/auth-register-multisteps-illustration.png"
            alt="auth-register-multisteps"
            class="img-fluid"
            width="280" />

          <img
            src="../../assets/img/illustrations/bg-shape-image-light.png"
            alt="auth-register-multisteps"
            class="platform-bg"
            data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
        <!-- /Left Text -->

        <!--  Multi Steps Registration -->
        <div class="d-flex col-lg-8 align-items-center justify-content-center p-sm-5 p-3">
          <div class="w-px-700">
            <div id="multiStepsValidation" class="bs-stepper shadow-none">
              <div class="bs-stepper-header border-bottom-0">
                <div class="step" data-target="#accountDetailsValidation">
                  <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-id ti-sm"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Validasi Akun</span>
                      <span class="bs-stepper-subtitle">Masukan Detail Akun</span>
                    </span>
                  </button>
                </div>
                <div class="line">
                  <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#personalInfoValidation">
                  <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-password ti-sm"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Konfirmasi OTP</span>
                      <span class="bs-stepper-subtitle">Masukkan Kode OTP</span>
                    </span>
                  </button>
                </div>
                <div class="line">
                  <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#billingLinksValidation">
                  <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-edit ti-sm"></i></span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">Ganti Password</span>
                      <span class="bs-stepper-subtitle">Masukkan Password Baru</span>
                    </span>
                  </button>
                </div>
              </div>
              <div class="bs-stepper-content">
                <form id="multiStepsForm" onSubmit="return false">
                  <!-- Account Details -->
                  <div id="accountDetailsValidation" class="content">
                    <div class="content-header mb-4">
                      <h3 class="mb-1">Konfirmasi Akun anda</h3>
                      <p>Masukkan Detail akunmu</p>
                    </div>
                    <div class="row g-3">
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsUsername">Username</label>
                        <input
                          type="text"
                          name="multiStepsUsername"
                          id="multiStepsUsername"
                          class="form-control"
                          placeholder="totok123" />
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="multiStepsEmail">Email</label>
                        <input
                          type="email"
                          name="multiStepsEmail"
                          id="multiStepsEmail"
                          class="form-control"
                          placeholder="totok.udb@email.com"
                          aria-label="john.doe" />
                      </div>
                      <div class="col-12 d-flex justify-content-between mt-4">
                        <a href="/login" class="btn btn-label-secondary btn-prev">
                            <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Batal</span>
                        </a>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                          <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Personal Info -->
                  <div id="personalInfoValidation" class="content">
                    <div class="content-header mb-4">
                      <h3 class="mb-1">Validasi Kode OTP</h3>
                      <p>Masukkan kode OTP yang telah kami kirim ke tot******mail.com </p>
                    </div>

                    <div class="row g-3">
                        <div
                        class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                        <input
                          type="tel"
                          class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                          maxlength="1"
                          autofocus />
                        <input
                          type="tel"
                          class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                          maxlength="1" />
                        <input
                          type="tel"
                          class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                          maxlength="1" />
                        <input
                          type="tel"
                          class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                          maxlength="1" />
                        <input
                          type="tel"
                          class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                          maxlength="1" />
                        <input
                          type="tel"
                          class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                          maxlength="1" />
                      </div>
                      <input type="hidden" name="otp" />
                      <div class="col-12 d-flex justify-content-left mt-2">
                      <button class="btn btn-primary mt-2 mb-2">Verifikasi akun saya</button>
                      <button class="btn btn-label-primary m-2">Kirim ulang</button>
                      </div>
                      <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev">
                          <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                        </button>
                        <button class="btn btn-primary btn-next">
                          <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Selanjutnya</span>
                          <i class="ti ti-arrow-right ti-xs"></i>
                        </button>
                      </div>

                    </div>

                  </div>
                  <!-- Billing Links -->
                  <div id="billingLinksValidation" class="content">
                    <div class="content-header">
                      <h3 class="mb-1">Perbarui Password anda</h3>
                      <p>Masukkan password anda dengan teliti</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                          <label class="form-label" for="passwordbaru">Password Baru</label>
                          <input
                            type="password"
                            name="passwordbaru"
                            id="passwordbaru"
                            class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="konfirmasipasswordbaru">Konfrimasi Password Baru</label>
                          <input
                            type="password"
                            name="konfirmasipasswordbaru"
                            id="konfirmasipasswordbaru"
                            class="form-control"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        </div>
                      </div>
                      <div class="col-12 mb-4 mt-4">
                        <h6>Syarat Password:</h6>
                        <ul class="ps-3 mb-0">
                          <li class="mb-1">Minimal 8 karatker</li>
                          <li class="mb-1">Harus menggunakan minimal satu huruf besar</li>
                          <li>Menggunakan simbol @,#,$</li>
                        </ul>
                      </div>
                    <!-- Credit Card Details -->
                    <div class="row g-3">
                      <div class="col-12 d-flex justify-content-between mt-4">
                        <button class="btn btn-label-secondary btn-prev">
                          <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                        </button>
                        <button type="submit" class="btn btn-success btn-next btn-submit">Ganti</button>
                      </div>
                    </div>
                    <!--/ Credit Card Details -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- / Multi Steps Registration -->
      </div>
    </div>

    <script>
      // Check selected custom option
      window.Helpers.initCustomOptionCheck();
    </script>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="../../assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="../../assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
    <script src="../../assets/vendor/libs/select2/select2.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-auth-multisteps.js"></script>
  </body>
</html>
