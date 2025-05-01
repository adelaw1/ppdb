<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyLib\Form;
use App\Models\pdb;
use Illuminate\Http\Request;

class PdbController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Penerimaan Peserta Didik Baru (PPDB)',
            'form' => new Form
        ];

        return view('frontend/ppdb/main', $data);
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
                'no_hp' => 'required',
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
            ],
        );

        if ($request->file('foto')) {
            $validasi['foto'] = $request->file('foto')->store('assets/archive/foto/');
        }
        if ($request->file('berkas_persyaratan')) {
            $validasi['berkas_persyaratan'] = $request->file('berkas_persyaratan')->store('assets/archive/berkas_persyaratan/');
        }

        Pdb::create($validasi);
        return redirect('/ppdb')->with('msg', $validasi['nisn']);
    }
}
