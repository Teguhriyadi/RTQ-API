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
}
