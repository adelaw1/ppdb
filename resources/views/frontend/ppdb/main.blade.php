@extends('frontend.templates.layout')

@section('content')
    <div class="card shadow">
        <div class="card-body p-5">

            {!! $form->frm_open('/ppdb', true) !!}
            @csrf
            {{ $form->set_size(12, 12) }}
            {{ $form->push_error($errors) }}

            <div class="row">
                <div class="col-12 text-center mb-2">
                    <img src="/assets/images/Logo.png" class="mx-auto mb-2" alt="..." width="70px">
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
                    {{-- {!! $form->frm_file('berkas_persyaratan', 'package', old('berkas_persyaratan')) !!} --}}

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
@endsection
