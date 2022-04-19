<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Absensi;

class AbsensiAsatidzController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $id_pengajar = $request->user()->id;

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alamat' => 'required'
        ]);

        $asatidz = $request->user()->nama;

        if ($request->hasFile('image')) {
            $request->file('image')->move('assets/absensi/asatidz_' . date('Y_m_d'), md5($asatidz));
            Absensi::create([
                'gambar' => 'assets/absensi/asatidz_' . date('Y_m_d'). '/' . md5($asatidz),
                'alamat' => $request->alamat,
                'id_asatidz' => $id_pengajar,
            ]);
            return response()->json(['message' => 'Data success'], 201);
        } else {
            return response()->json('Image is required!', 401);
        }

    }
}
