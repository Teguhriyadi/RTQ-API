<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jenjang;
use App\Models\KategoriPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewById($id_jenjang, $id_kategori_penilaian)
    {
        $data = KategoriPelajaran::where("id_jenjang", $id_jenjang)->where("id_kategori_penilaian", $id_kategori_penilaian)->get();

        $d = [];
        foreach ($data as $c) {
            $d[] = [
                "id" => $c->id,
                "id_jenjang" => $c->id_jenjang,
                "id_kategori" => $c->getKategoriPenilaian->id,
                "nama_pelajaran" => $c->getPelajaran->nama_pelajaran
            ];
        }

        return response()->json($d, 200);
    }
}
