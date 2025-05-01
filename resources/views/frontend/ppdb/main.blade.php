<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/Logo.ico">
    <title>Penerimaan Peserta Didik Baru (PPDB) SMK Ashhabul Maimanah Sidayu</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <style>
        body {
            background: rgb(230, 230, 230);
            background-image: linear-gradient(rgb(233, 233, 233), rgb(209, 209, 209));
        }

        .card {
            overflow: hidden;
        }
    </style>
</head>

<body class="vertical light">
    {{-- <main role="main" class="main-content"> --}}
    <div class="container-fluid">
        <div class="row justify-content-center mt-4 mb-4">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card shadow">
                    {{-- <img src="assets/images/kop.jpg" alt="KOP" class="mb-0" width="100%"> --}}
                    <div class="card-body p-5">

                        {{-- <form action="/ppdb" method="POST" autocomplete="off"> --}}
                        {!! $form->frm_open('/ppdb', true) !!}
                        @csrf
                        {{ $form->set_size(12, 12) }}
                        {{ $form->push_error($errors) }}

                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <img src="./assets/images/Logo.png" class="mx-auto mb-2" alt="..." width="70px">
                                <h5 class="mb-0 text-uppercase">SEKOLAH MENENGAH KEJURUAN (SMK)</h5>
                                <h4 class="mb-0 text-uppercase">ASHHABUL MAIMANAH SIDAYU</h4>
                                <p class="text-muted"> Jln. Pontang - Tirtayasa KM 2 Sidayu Sabrang Ds. Kemanisan
                                    Kec.
                                    Tirtayasa Kab. Serang - Banten 42193 </p>
                            </div>

                            <div class="col-12 text-center mb-4">
                                <h5 class="mb-0">Penerimaan Peserta Didik Baru (PPDB)</h5>
                                <h6>Tahun Pelajaran {{ date('Y') }}/{{ date('Y') + 1 }}</h6>
                            </div>

                            <div class="col-md-6">
                                <p class="small text-muted text-uppercase mb-2">A. Biodata Diri</p>


                                {!! $form->frm_text('nisn', 'star', old('nisn')) !!}
                                {!! $form->frm_text('nik', 'credit-card', old('nik')) !!}
                                {!! $form->frm_text('nama_lengkap', 'user', old('nama_lengkap')) !!}
                                {!! $form->frm_text('tempat_lahir', 'calendar', old('tempat_lahir')) !!}
                                {!! $form->frm_tanggal('tanggal_lahir', 'calendar', old('tanggal_lahir'), ['readonly' => 'readonly']) !!}
                                {!! $form->frm_radio('jenis_kelamin', ['L' => 'Laki-Laki', 'P' => 'Perempuan'], old('jenis_kelamin')) !!}
                                {!! $form->frm_text('email', 'mail', old('email')) !!}
                                {!! $form->frm_text('no_hp', 'phone', old('no_hp')) !!}
                                {!! $form->frm_textarea('alamat', 'home', old('alamat')) !!}

                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted text-uppercase mb-2">B. Data Orang Tua/ Wali</p>

                                {!! $form->frm_text('nama_ayah', 'user', old('nama_ayah')) !!}
                                {!! $form->frm_text('pekerjaan_ayah', 'tool', old('pekerjaan_ayah')) !!}
                                {!! $form->frm_text('nama_ibu', 'user', old('nama_ibu')) !!}
                                {!! $form->frm_text('pekerjaan_ibu', 'tool', old('pekerjaan_ibu')) !!}

                                <br><br>
                                <p class="small text-muted text-uppercase mb-2">C. Data Asal Sekolah</p>

                                {!! $form->frm_text('asal_sekolah', 'tag', old('asal_sekolah')) !!}
                                {!! $form->frm_textarea('alamat_asal_sekolah', 'home', old('alamat_asal_sekolah')) !!}
                                {!! $form->frm_file('foto', 'image', old('foto')) !!}
                                {!! $form->frm_file('berkas_persyaratan', 'package', old('berkas_persyaratan')) !!}

                            </div>

                            <div class="col-12 text-right mt-3">
                                <div class="form-group">
                                    <button type="submit" class="btn mb-2 btn-primary btn-block">
                                        <span class="fe fe-send fe-16 mr-2"></span>
                                        Kirim
                                    </button>
                                </div>
                            </div>
                        </div> <!-- /.row -->

                        {!! $form->frm_close() !!}

                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    {{-- </main> <!-- main --> --}}

    @include('sweetalert::alert')

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <script src='js/jquery.validate.min.js'></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');

        $('.drgpicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        $('.date').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    </script>
</body>

</html>
