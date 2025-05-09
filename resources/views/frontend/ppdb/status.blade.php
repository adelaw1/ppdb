@extends('frontend.templates.layout')

@section('content')
    @push('style')
        <style>
            table#data-siswa tr td {
                padding: 3px;
                vertical-align: top;
                text-align: left;
            }

            table#data-siswa tr td:first-child {
                width: 150px;
            }
        </style>
    @endpush

    <div class="col-md-12 mb-4">
        <div class="card profile shadow">
            <div class="card-body my-4">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="/storage/{{ $rows->foto }}" alt="Foto" class="avatar-img">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h4 class="mb-1">{{ $rows->nama_lengkap }}</h4>
                                <p class="small mb-3"><span class="badge badge-dark">{{ $rows->no_pendaftaran }}</span></p>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-7">
                                <table id="data-siswa">
                                    <tr>
                                        <td>NISN</td>
                                        <td>:</td>
                                        <td>{{ $rows->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <td>{{ $rows->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat, Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>{{ $rows->tempat_lahir }},
                                            {{ $tgl_id->parse($rows->tanggal_lahir)->isoFormat('D MMMM Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>{{ $rows->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $rows->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. HP</td>
                                        <td>:</td>
                                        <td>{{ $rows->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $rows->alamat }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-5">
                                <p>Status Pendaftaran :</p>
                                @if ($rows->status == 'pendaftaran')
                                    <h4 class="text-warning">Pengajuan</h4>
                                    <span class="text-info">menunggu konfirmasi admin</span>

                                    <br><br>
                                    <small class="text-muted">
                                        Jika status masih pengajuan, silahkan kirim pesan ke admin dengan klik tombol dib
                                        awah
                                        ini :
                                    </small><br>
                                    @php
                                        $message =
                                            "*_Assalamu'alaikum Wr. Wb._*%0A%0ASaya sudah mengirimkan data pendaftaran Peserta Didik Baru dengan data sebagai berikut :%0A";
                                        $message .=
                                            'NISN%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3A *' .
                                            $rows->nisn .
                                            '*%0A';
                                        $message .=
                                            'NIK%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3A *' .
                                            $rows->nik .
                                            '*%0A';
                                        $message .= 'Nama Lengkap%20%20%3A *' . $rows->nama_lengkap . '*%0A';
                                        $message .=
                                            'TTL%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3A *' .
                                            $rows->tempat_lahir .
                                            ', ';
                                        $message .=
                                            $tgl_id->parse($rows->tanggal_lahir)->isoFormat('D MMMM Y') . '*%0A';
                                        $message .=
                                            'Jenis Kelamin%20%20%20%20%3A *' .
                                            ($rows->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan') .
                                            '*%0A';
                                        $message .=
                                            'No. HP%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3A * ' .
                                            $rows->no_hp .
                                            '*%0A';
                                        $message .=
                                            'Email%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3A *' .
                                            $rows->email .
                                            '*%0A';
                                        $message .=
                                            'Alamat%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3A *' .
                                            $rows->alamat .
                                            '*%0A%0A';
                                        $message .=
                                            'Mohon untuk segera dikonfirmasi%0AAtas perhatiannya saya ucapkan _Terima Kasih_';
                                    @endphp
                                    <a href="https://api.whatsapp.com/send?phone=6281292619106&text={{ $message }}"
                                        class="btn btn-sm btn-success" target="_blank">
                                        <span class="fe fe-send"></span> Kirim Pesan
                                    </a>
                                @elseif($rows->status == 'verifikasi')
                                    <h4 class="text-primary">Pendaftarn Telah di Verifikasi</h4>
                                    <span class="text-info">pengajuan diterima, data masih diproses</span>
                                @else
                                    <h4 class="text-success">Diterima</h4>
                                @endif
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-2">
                                <span class="small text-muted mb-0">Terdaftar pada {{ $rows->created_at }}</span>
                            </div>
                            <div class="col mb-2">
                            </div>
                        </div>
                    </div>
                </div> <!-- / .row- -->
            </div> <!-- / .card-body - -->
        </div> <!-- / .card- -->
    </div> <!-- / .col- -->
@endsection
