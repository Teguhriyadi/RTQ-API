<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Santri;

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
}
