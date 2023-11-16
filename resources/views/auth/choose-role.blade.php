<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-wide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets/"
  data-template="front-pages">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Pilih Role anda | Arisanku</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />
    <link rel="stylesheet" href="/assets/vendor/css/pages/front-page.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="/assets/vendor/libs/nouislider/nouislider.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/swiper/swiper.css" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="/assets/vendor/css/pages/front-page-landing.css" />

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <!-- <script src="/assets/vendor/js/template-customizer.js"></script> -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/front-config.js"></script>
  </head>

  <body>
    <script src="/assets/vendor/js/dropdown-hover.js"></script>
    <script src="/assets/vendor/js/mega-dropdown.js"></script>

    <!-- Navbar: Start -->

    <!-- Navbar: End -->

    <!-- Sections:Start -->

    <div data-bs-spy="scroll" class="scrollspy-example">
      <!-- Hero: Start -->

      <!-- Hero: End -->

      <!-- Useful features: Start -->

      <!-- Useful features: End -->

      <!-- Real customers reviews: Start -->

      <!-- Real customers reviews: End -->

      <!-- Our great team: Start -->
      <!-- Our great team: End -->

      <!-- Pricing plans: Start -->

        <div class="container">
          <div class="text-center mb-3 pb-1 ">
            <span class="badge bg-label-primary">Pilih Peran</span>
          </div>
          <h3 class="text-center mb-1"><span class="section-title">Pilih peran anda</span> dalam arisan</h3>
          <p class="text-center mb-4 pb-3">
            Sebelum mendaftar tentukan dahulu apakah anda mau menjadi pemilik arisan atau pengguna arisan.
          </p>
          <div class="row gy-4 pt-lg-0">
          <form class="needs-validation d-flex justify-content-center" method="POST"
            action="{{ route('register.selectRole') }}">
            @csrf
            <!-- Basic Plan: Start -->
            <div class="col-3">
              <div class="card m-1 h-100 bg-label-primary">
                <div class="card-header p-3">
                  <div class="text-center">

                        <img
                          class="img-fluid mt-2"
                          src="../../assets/img/illustrations/boy-app-academy.png"
                          alt="Card girl image"
                          width="290"
                           />

                  </div>
                </div>
                <div class="card-body">
                  <div class="d-grid">
                    <button type="submit" name="role" value="user" class="btn btn-primary">Pengguna Arisan</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Basic Plan: End -->

            <!-- Favourite Plan: Start -->
            <div class="col-3">
              <div class="card m-1 h-100 bg-label-danger">
                <div class="card-header p-3">
                  <div class="text-center">

                        <img
                          class="img-fluid mt-2"
                          src="../../assets/img/illustrations/girl-app-academy.png"
                          alt="Card girl image"
                          width="290"
                           />

                  </div>
                </div>
                <div class="card-body">
                  <div class="d-grid">
                  <button type="submit" name="role" value="owner" class="btn btn-danger">Pemilik Arisan</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Favourite Plan: End -->

            <!-- Standard Plan: Start -->
            <!-- Standard Plan: End -->
            </form>
            <h4 class="text-center mb-0">Sudah punya akun?</h4>
            <div class="d-flex justify-content-center"> <a href="{{ route('login') }}" class="btn btn-primary mb-5">Masuk di sini!</a></div>
          </div>
        </div>

      <!-- Pricing plans: End -->

      <!-- Fun facts: Start -->

      <!-- Fun facts: End -->

      <!-- FAQ: Start -->

      <!-- FAQ: End -->

      <!-- CTA: Start -->

      <!-- CTA: End -->

      <!-- Contact Us: Start -->

      <!-- Contact Us: End -->
    </div>

    <!-- / Sections:End -->

    <!-- Footer: Start -->

    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/node-waves/node-waves.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/nouislider/nouislider.js"></script>
    <script src="/assets/vendor/libs/swiper/swiper.js"></script>

    <!-- Main JS -->
    <script src="/assets/js/front-main.js"></script>

    <!-- Page JS -->
    <script src="/assets/js/front-page-landing.js"></script>
  </body>
</html>
