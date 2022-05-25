<?php

namespace App\Http\Controllers;

use App\Models\KategoriPelajaran;
use App\Models\KategoriPenilaian;
use App\Models\LokasiRt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KategoriPenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $cek = KategoriPenilaian::get();

        if ($cek->count() < 1) {
            $data = "Data tidak ada.";
        } else {
            $data = $cek;
        }

        return response()->json($data, 200);
    }

    public function viewByJenjangNPenilaian($id_jenjang, $id_katagori)
    {
        $data = KategoriPelajaran::where("id_jenjang", $id_jenjang)->where("id_kategori_penilaian", $id_katagori)->get();

        $d = [];

        if ($data) {
            foreach ($data as $c) {
                $d[] = [
                    "id" => $c->id,
                    "id_jenjang" => $c->id_jenjang,
                    "id_kategori" => $c->getKategoriPenilaian->id,
                    "nama_pelajaran" => $c->getPelajaran->nama_pelajaran
                ];
            }
        } else {
            $d = 'null';
        }

        return response()->json($d, 200);
    }
}
