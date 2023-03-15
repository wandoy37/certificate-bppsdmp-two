<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sertifikat | @yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('atlantis/img/icon.ico') }}" type="image/x-icon" />

    {{-- Popins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Fonts and icons -->
    <script src="{{ asset('atlantis/js/plugin/webfont/webfont.min.js') }}"></script>
    {{-- <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('atlantis/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script> --}}

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('atlantis/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('atlantis/css/atlantis.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('atlantis/css/demo.css') }}">
</head>

<style>
    @media print {

        html,
        body {
            display: block;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        @page {
            size: 21cm 29.7cm;
        }

        @media print {
            @page {
                size: landscape
            }
        }

    }
</style>

<body>
    {{-- Section content --}}
    <div class="container pt-4">
        <section id="cetakResi">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-invoice">
                        <div class="card-body">
                            <div class="row" style="margin-top: 220px;">
                                <div class="col-lg-12 info-invoice">
                                    <h5 class="text-center">Nomor : 000.9.4 / 0001 / BPPSDMP /
                                        {{ date('Y') }}</h5>
                                    <p>Pemerintah Provinsi Kalimantan Timur, menyatakan bahwa :</p>
                                    <div class="row no-gutters">
                                        {{-- <div class="col-md-2 float-right">
                                            <img src="{{ asset('atlantis/img/profile2.jpg') }}" class="img-fluid"
                                                alt="...">
                                        </div> --}}
                                        <div class="col-md-10" style="margin-left: 125px">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-5">Nama</div>
                                                    <div class="col-sm-7">: Muhammad Riswandi</div>
                                                    <div class="col-sm-5">NIP</div>
                                                    <div class="col-sm-7">: 6472050307010001</div>
                                                    <div class="col-sm-5">Tempat, Tanggal Lahir</div>
                                                    <div class="col-sm-7">: Samarinda, 03 Juli 2001</div>
                                                    <div class="col-sm-5">Pangkat/Golongan</div>
                                                    <div class="col-sm-7">: Non-Aparatur</div>
                                                    <div class="col-sm-5">Jabatan</div>
                                                    <div class="col-sm-7">: Staff IT</div>
                                                    <div class="col-sm-5">Asal Instansi</div>
                                                    <div class="col-sm-7">: UPTD BPPSDMP SEMPAJA</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h3 class="text-center" style="color: #093c82;"><b>TELAH MENGIKUTI</b></h3>
                                    <p class="text-center">
                                        Telah mengikuti pelatihan NAMA PELATIHAN
                                        Angkatan Ke yang diselenggarakan di <b>UPTD BPPSDMP Provinsi
                                            Kalimantan Timur</b> <br> dari tanggal
                                        24 Feb
                                        s.d
                                        25 Feb 2023
                                        dengan jumlah 80
                                        jam berlatih
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <div class="my-2">
                                        <div class="row">
                                            <div class="col-sm-4" style="margin-left: 20px;">
                                                {!! QrCode::size(70)->generate('www.wansite.my.id') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- /Section content --}}


    <!--   Core JS Files   -->
    <script src="{{ asset('atlantis/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('atlantis/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('atlantis') }}/js/core/bootstrap.min.js"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('atlantis/js/atlantis.min.js') }}"></script>

    <script>
        window.print();
    </script>
</body>

</html>
