<?php

namespace App\Http\Controllers;

use App\Models\KategoriPelajaran;
use App\Models\Pelajaran;
use Illuminate\Http\Request;

class KategoriPelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $cek = KategoriPelajaran::get();

        if ($cek->count() < 1) {
            $data = "Data tidak ada.";
        } else {
            $data = [];
            foreach ($cek as $c) {
                $data[] = [
                    "id" => $c->id,
                    "id_jenjang" => $c->id_jenjang,
                    "nama_pelajaran" => $c->getPelajaran->nama_pelajaran
                ];
            }
        }

        return response()->json($data, 200);
    }

    public function viewByKategoriNJenjang($id_jenjang, $id_kategori_penilaian)
    {
        $santri = KategoriPelajaran::where("id_kategori_penilaian", $id_kategori_penilaian)->where('id_jenjang', $id_jenjang)->get();

        if ($santri->count() < 1) {
            return null;
        } else {
            if ($santri) {
                foreach ($santri as $s) {
                    $data[] = [
                        'id' => $s->id,
                        'id_jenjang' => $s->id_jenjang,
                        'id_kategori' => $s->getKategoriPenilaian->id,
                        'nama_pelajaran' => $s->getPelajaran->nama_pelajaran
                    ];
                }
            } else {
                return null;
            }
        }

        return response()->json($data);
    }
}
