<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;

use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiAsatidzController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tanggal = date("Y-m-d");

        $cek = Absensi::where("id_asatidz", Auth::user()->id)->whereDate("created_at", $tanggal)->first();

        if ($cek) {
            return response()->json($cek);
        } else {
            return null;
        }
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
                'gambar' => url() . '/assets/absensi/asatidz/' . date('Y_m_d') . '/' . $asatidz,
                'alamat' => $request->alamat,
                'id_asatidz' => $request->id_asatidz,
            ]);
            return response()->json(['message' => 'Data success'], 201);
            // imagejpeg()
        } else {
            return response()->json('Image is required!', 401);
        }
    }

    public function rekap()
    {
        $cek = Absensi::get();

        if ($cek->count() < 1) {
            $data = "Data tidak ada.";
        } else {
            foreach ($cek as $d) {
                $data[] = [
                    "id" => $d->id,
                    "gambar" => $d->gambar,
                    "alamat" => $d->alamat,
                    "tanggal_absen" => $d->created_at,
                ];
            }
        }

        return response()->json($data, 200);
    }
}
