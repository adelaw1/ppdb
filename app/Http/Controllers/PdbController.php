<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyLib\Form;
use App\Models\Pdb;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PdbController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Penerimaan Peserta Didik Baru (PPDB)',
            'form' => new Form,
            'alert' => session()->has('msg') ? Alert::html('<i>Formulir</i> <u>Pendaftaran</u>', " Pendaftaran Peserta Didik Baru <b>Berhasil</b> Dikirim, <a href='/ppdb/" . session('msg') . "' target='_blank'>Download Data</a> (Formulir Pendaftaran)", 'success') : ''
        ];

        return view('frontend.ppdb.main', $data);
    }

    public function save_formulir(Request $request)
    {
        $validasi = $request->validate(
            [
                'nisn' => 'required|numeric|unique:calon_pdb,nisn|min_digits:10|max_digits:10',
                'nik' => 'required|numeric|unique:calon_pdb,nik|min_digits:16|max_digits:16',
                'nama_lengkap' => "required|regex:/^[a-zA-Z\s'']+$/",
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'email' => ($request->email ? 'email:rfc,dns' : ''),
                'no_hp' => 'required|numeric',
                'alamat' => 'required',
                'nama_ayah' => "required|regex:/^[a-zA-Z\s'']+$/",
                'pekerjaan_ayah' => "required|regex:/^[a-zA-Z\s'']+$/",
                'nama_ibu' => "required|regex:/^[a-zA-Z\s'']+$/",
                'pekerjaan_ibu' => "required|regex:/^[a-zA-Z\s'']+$/",
                'asal_sekolah' => 'required',
                'alamat_asal_sekolah' => '',
                'foto' => 'required|mimes:jpg,jpeg,png|file|max:1024',
                'berkas_persyaratan' => ($request->file('berkas_persyaratan') ? 'extensions:zip,rar|file|max:2048' : ''),
            ],
            [
                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
                'foto.required' => 'Foto wajib diupload',
                'nisn.unique' => 'NISN ini sudah terdaftar',
                'nik.unique' => 'NIK ini sudah terdaftar',
            ],
        );

        if ($request->file('foto')) {
            $validasi['foto'] = $request->file('foto')->store('assets/archive/foto/');
        }
        if ($request->file('berkas_persyaratan')) {
            $validasi['berkas_persyaratan'] = $request->file('berkas_persyaratan')->store('assets/archive/berkas_persyaratan/');
        }

        $validasi['no_pendaftaran'] = date('Ymd') . '.PDBSMKAMS.' . (count(Pdb::all()) < 10 ? "000" . count(Pdb::all()) : (count(Pdb::all()) + 1 < 100 ? "00" . count(Pdb::all()) + 1 : (count(Pdb::all()) + 1 < 1000 ? "0" . count(Pdb::all()) + 1 : count(Pdb::all()) + 1)));

        Pdb::create($validasi);
        return redirect('/ppdb')->with('msg', $validasi['nisn']);
    }

    public function cetak_formulir($nisn)
    {
        $data = [
            'rows' => Pdb::where(['nisn' => $nisn])->get(),
            'tgl_id' => new Carbon(),
            'qrcode' => new QRCode(),
        ];
        $pdf = Pdf::loadView('frontend.ppdb.cetak_formulir', $data);
        $pdf->setPaper('A4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'Arial']);
        return $pdf->download('Formulir Pendaftaran.pdf');
    }

    public function cek_status($nisn)
    {
        $data = [
            'title' => 'Status Pendaftaran PPDB',
            'rows' => Pdb::where(['nisn' => $nisn])->first(),
            'tgl_id' => new Carbon(),
        ];

        return view('frontend.ppdb.status', $data);
    }
}
