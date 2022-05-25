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
                'id_asatidz' => $get_nilai->id_asatidz,
                'nilai' => $get_nilai->nilai
            ];
        } else {
            $data = "null";
        }

        return response()->json($data, 200);
    }
}
