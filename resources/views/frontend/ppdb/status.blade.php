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
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-2">
                                <span class="small text-muted mb-0">Terdaftar pada {{ $rows->created_at }}</span>
                            </div>
                            <div class="col mb-2">
                                <button type="button" class="btn btn-primary">Message</button>
                                <button type="button" class="btn btn-secondary">Profile</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- / .row- -->
            </div> <!-- / .card-body - -->
        </div> <!-- / .card- -->
    </div> <!-- / .col- -->
@endsection
