<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        .header {
            background: rgb(0, 175, 0);
            position: fixed;
            left: -71px;
            top: -71px;
            right: -70px;
            height: 260px;
        }

        .header .atas {
            position: relative;
            padding: 40px 15px 0 15px;
        }

        .header .atas::after {
            content: '';
            clear: both;
            display: block;
        }

        .header .logo {
            float: left;
            width: 11%;
            text-align: right;
        }

        .header .logo img {
            width: 110px;
            box-shadow: 0 0 5px 5px #fff;
        }

        .header .text {
            float: right;
            width: 89%;
            color: #fff;
            text-align: center;
        }

        .header .text h6 {
            font-size: 1.1rem;
            line-height: 1;
            margin: 0;
        }

        .header .text h5 {
            font-size: 1.2rem;
            line-height: 1;
            margin: 0;
        }

        .header .text h4 {
            font-size: 1.3rem;
            line-height: 1;
            margin: 0;
        }

        .header .text h3 {
            font-size: 1.6rem;
            line-height: 1;
            margin: 0;
        }

        .header .bawah {
            text-align: center;
            background: rgb(231, 231, 0);
            font-size: .9rem;
            color: rgb(0, 175, 0);
        }

        .header .bawah p {
            padding: 5px;
        }

        .page-break {
            page-break-after: always;
        }

        .content {
            margin-top: 200px;
        }

        .content .title p {
            text-align: center;
        }

        .content .body .tdata {
            width: 100%;
        }

        .content .body .tdata tr td {
            padding: 7px;
        }

        .content .body .tdata tr td:first-child {
            width: 29%;
        }

        .content .body .tdata tr td:last-child {
            width: 70%;
            border-bottom: 1px dotted grey;
        }
    </style>
</head>

<body>

    @php $cek = 1; @endphp
    @foreach ($rows as $row)
        @if ($cek > 1)
            <div class="page-break"></div>
        @endif
        <div class="wrapper">

            @include('frontend.ppdb.header')

            <div class="content">

                <div class="title">
                    <p>
                        <strong>
                            FORMULIR PENDAFTARAN PESERTA DIDIK BARU<br />
                            SMK ASHHABUL MAIMANAH SIDAYU<br />
                            TAHUN PELAJARAN {{ date('Y') }}/{{ date('Y') + 1 }}
                        </strong>
                    </p>
                </div>

                <div class="body">
                    <ol style="list-style: upper-alpha">
                        <li>
                            <strong>Biodata Peserta Didik</strong><br /><br />
                            <table class="tdata">
                                <tr>
                                    <td>NISN</td>
                                    <td>:</td>
                                    <td>{{ $row->nisn }}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td>{{ $row->nik }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Peserta Didik</td>
                                    <td>:</td>
                                    <td>{{ $row->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat, Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>
                                        {{ $row->tempat_lahir }},
                                        {{ $tgl_id->parse($row->tanggal_lahir)->isoFormat('D MMMM Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{ $row->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $row->email ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>:</td>
                                    <td>{{ $row->no_hp ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Siswa</td>
                                    <td>:</td>
                                    <td>{{ $row->alamat ?: '-' }}</td>
                                </tr>
                            </table>
                            <br /><br />
                        </li>

                        <li>
                            <strong>Data Orang Tua</strong><br /><br />
                            <table class="tdata">
                                <tr>
                                    <td>Nama Ayah</td>
                                    <td>:</td>
                                    <td>{{ $row->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan Ayah</td>
                                    <td>:</td>
                                    <td>{{ $row->pekerjaan_ayah }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Ibu</td>
                                    <td>:</td>
                                    <td>{{ $row->nama_ibu }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan Ibu</td>
                                    <td>:</td>
                                    <td>{{ $row->pekerjaan_ibu }}</td>
                                </tr>
                            </table>
                            <br /><br />
                        </li>

                        <li>
                            <strong>Data Asal Sekolah</strong><br /><br />
                            <table class="tdata">
                                <tr>
                                    <td>Asal Sekolah</td>
                                    <td>:</td>
                                    <td>{{ $row->asal_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Asal Sekolah</td>
                                    <td>:</td>
                                    <td>{{ $row->alamat_asal_sekolah }}</td>
                                </tr>
                            </table>
                        </li>
                    </ol>
                </div>

            </div>

        </div>
        @php $cek++; @endphp
    @endforeach

</body>

</html>
