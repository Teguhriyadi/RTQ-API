<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jenjang;
use App\Models\KategoriPelajaran;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_nilai($id_pelajaran, $id_santri)
    {
        $get_nilai = Nilai::where('id_kategori_pelajaran', $id_pelajaran)->where('id_santri', $id_santri)->first();

        if ($get_nilai) {
            $data = [
                'id' => $get_nilai->id,
                'id_kategori_pelajaran' => $get_nilai->id_kategori_pelajaran,
                'id_santri' => $get_nilai->id_santri,
                'id_asatidz' => $get_nilai->id_asatidz,
                'nilai' => $get_nilai->nilai,
            ];
        } else {
            $data = "null";
        }

        return response()->json($data, 200);
    }

    public function store_nilai($id_pelajaran, $id_santri, $id_asatidz, Request $request)
    {
        $store = Nilai::create([
            'id_asatidz' => $id_asatidz,
            'id_santri' => $id_santri,
            'id_kategori_pelajaran' => $id_pelajaran,
            'nilai' => $request->nilai,
        ]);

        if ($store) {
            return response()->json('Data berhasil disimpan', 200);
        } else {
            return response()->json('Data gagal disimpan', 404);
        }
    }

    public function update_nilai($id, $id_asatidz, Request $request)
    {
        $update = Nilai::where('id', $id)->update([
            'id' => $id,
            'id_asatidz' => $id_asatidz,
            'nilai' => $request->nilai,
        ]);

        if ($update) {
            return response()->json('Data berhasil disimpan', 200);
        } else {
            return response()->json('Data gagal disimpan', 404);
        }
    }
}
