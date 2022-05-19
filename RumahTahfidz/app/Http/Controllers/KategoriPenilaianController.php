<?php

namespace App\Http\Controllers;

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
}
