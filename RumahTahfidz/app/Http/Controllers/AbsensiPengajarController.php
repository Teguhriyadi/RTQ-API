<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Absensi;

class AbsensiPengajarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $id_pengajar = $request->user()->id;

        $this->validate($request, [
            'gambar' => 'required',
            'alamat' => 'required',
        ]);

        $gambar = $request->post('gambar');
        $alamat = $request->post('alamat');

        Absensi::create([
            'id_pengajar' => $id_pengajar,
            'alamat' => $alamat,
            'gambar' => $gambar,
        ]);

        return response()->json(['message' => 'Data success'], 201);
    }
}
