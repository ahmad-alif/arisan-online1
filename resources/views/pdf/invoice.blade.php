<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="/assets/vendor/js/helpers.js"></script>
    <script src="/assets/vendor/js/template-customizer.js"></script>
    <script src="/assets/js/config.js"></script>
</head>

<body>
    <div class="container mt-5">

        <div class="row mb-2">
            <div class="col-4"><strong>Nomor Invoice</strong></div>
            <div class="col-8">{{ $invoice->invoice_number }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-4"><strong>Nama Bank</strong></div>
            <div class="col-8">{{ $invoice->nama_bank }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-4"><strong>No Rekening Tujuan</strong></div>
            <div class="col-8">
                <span id="noRekening">{{ $invoice->no_rekening }}</span>
                <button class="btn btn-sm btn-primary float-end" style="padding: 0.2rem 0.4rem;"
                    onclick="copyNoRekening()"><i class="ti ti-copy"></i></button>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-4"><strong>Nama Pemilik</strong></div>
            <div class="col-8">{{ strtoupper($invoice->nama_pemilik_rekening) }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-4"><strong>Total:</strong></div>
            <div class="col-8"><strong>Rp.
                    {{ number_format($invoice->total, 0, ',', '.') }}</strong></div>
        </div>

    </div>


</body>

</html>
