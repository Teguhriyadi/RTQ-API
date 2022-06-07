<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Santri;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detail($id)
    {
        $iuran = Iuran::where('id_santri', $id)->get();
        $santri = Santri::where('id', $id)->first();

        $data = [];

        foreach ($iuran as $i) {
            $data[] = [
                'nama_lengkap' => $santri->nama_lengkap,
                'tanggal_pembayaran' => $i->tanggal,
                'bukti_pembayaran' => $i->bukti,
                'status_pembayaran' => $i->status_validasi,
            ];
        }

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        // nominal
        // id_santri
        // id_asatidz
        // bukti = ''
        // id_status_validasi
        // tanggal
        $cek = Iuran::create([
            'nominal' => $request->nominal,
            'id_santri' => $request->id_santri,
            'id_users' => $request->id_asatidz,
            'bukti' => 'http://rtq-freelance.my.id/gambar/gambar_user.png',
            'id_status_validasi' => 2,
            'tanggal' => date('Y-m-d'),
        ]);

        if ($cek) {
            return response()->json('Data berhasil disimpan', 200);
        } else {
            return response()->json('Data gagal disimpan', 404);
        }
    }
}
