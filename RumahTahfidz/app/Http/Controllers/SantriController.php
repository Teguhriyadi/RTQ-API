<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Siswa;

class SantriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $santri = Siswa::all();


        $data = [];

        foreach ($santri as $s) {
            $cabang = Cabang::where('id', $s->id_cabang)->first();

            $data[] = [
                'nama' => $s->nama,
                'jenis_kelamin' => $s->jenis_kelamin,
                'alamat' => $s->alamat,
                'gambar' => $s->gambar,
                'nama_ayah' => $s->nama_ayah,
                'nama_ibu' => $s->nama_ibu,
                'no_hp' => $s->no_hp,
                'cabang' => $cabang->nama_cabang,
            ];
        }

        return response()->json($data);
    }

    public function viewByCabang($id_cabang)
    {
        $santri = Siswa::where('id_cabang', $id_cabang)->get();


        $data = [];

        foreach ($santri as $s) {
            $cabang = Cabang::where('id', $s->id_cabang)->first();

            $data[] = [
                'nama' => $s->nama,
                'jenis_kelamin' => $s->jenis_kelamin,
                'alamat' => $s->alamat,
                'gambar' => $s->gambar,
                'nama_ayah' => $s->nama_ayah,
                'nama_ibu' => $s->nama_ibu,
                'no_hp' => $s->no_hp,
                'cabang' => $cabang->nama_cabang,
            ];
        }

        return response()->json($data);
    }

    public function viewByCabangNJenjang($id_cabang, $id_jenjang)
    {
        $santri = Siswa::where('id_cabang', $id_cabang)->get();


        $data = [];

        foreach ($santri as $s) {
            $cabang = Cabang::where('id', $s->id_cabang)->first();

            $data[] = [
                'nama' => $s->nama,
                'jenis_kelamin' => $s->jenis_kelamin,
                'alamat' => $s->alamat,
                'gambar' => $s->gambar,
                'nama_ayah' => $s->nama_ayah,
                'nama_ibu' => $s->nama_ibu,
                'no_hp' => $s->no_hp,
                'cabang' => $cabang->nama_cabang,
            ];
        }

        return response()->json($data);
    }
}
