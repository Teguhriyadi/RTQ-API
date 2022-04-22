<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Absensi;

class AbsensiAsatidzController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'alamat' => 'required'
        ]);

        $asatidz = Str::random(32);

        if ($request->hasFile('image')) {
            $request->file('image')->move('assets/absensi/asatidz/' . date('Y_m_d'), $asatidz);
            Absensi::create([
                'gambar' => url() . '/assets/absensi/asatidz/' . date('Y_m_d'). '/' . $asatidz,
                'alamat' => $request->alamat,
                'id_asatidz' => $request->id_asatidz,
            ]);
            return response()->json(['message' => 'Data success'], 201);
        } else {
            return response()->json('Image is required!', 401);
        }

    }
}
