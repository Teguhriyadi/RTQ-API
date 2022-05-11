<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Asatidz;
use App\Models\Contoh;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContohController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function coba()
    {
        $data['coba'] = Absensi::all();
        return view('coba', $data);
    }

    public function postCoba(Request $request)
    {
        // dd();
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $asatidz = 'hakim';

        if ($request->hasFile('image')) {
            $image = '';

            if ($request->file('image')->getClientOriginalExtension() == "png") {
                $image = imagecreatefrompng($_FILES['image']['tmp_name']);
            } elseif ($request->file('image')->getClientOriginalExtension() == "jpg") {
                $image = imagecreatefromjpeg($_FILES['image']['tmp_name']);
            }

            imagepng($image, 'assets/absensi/asatidz/' . date('Y_m_d') . '_' . time(), 1);
            // $request->file('image')->move('assets/absensi/asatidz_' . date('Y_m_d'), md5($asatidz));
            // Absensi::create([
            //     'gambar' => 'assets/absensi/asatidz_' . date('Y_m_d'). '/' . md5($asatidz),
            //     'alamat' => 'Losarang',
            //     'id_asatidz' => 1,
            // ]);
            return redirect('/coba');
        } else {
            return response()->json('Image is required!', 401);
        }
    }
}
