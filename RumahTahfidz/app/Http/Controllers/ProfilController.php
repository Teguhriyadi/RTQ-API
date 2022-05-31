<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use App\Models\User;
use App\Models\Role;
use App\Models\Santri;
use App\Models\WaliSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function __construct()
    {
    }

    public function detail(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (!$user) {
            return response()->json(['message' => 'Get data failed!'], 401);
        }

        $hak_akses = HakAkses::where('id', $user->id_hak_akses)->first();
        $role = Role::where('id', $hak_akses->id_role)->first();

        if ($hak_akses->id_role == 3) {
            $data = [
                'nama' => $user->nama,
                'email' => $user->email,
                'alamat' => $user->alamat,
                'gambar' => $user->gambar,
                'tempat_lahir' => $user->tempat_lahir,
                'tanggal_lahir' => $user->tanggal_lahir,
                'hak_akses' => $role->keterangan,
                'token' => $user->token,
                'jenis_kelamin' => $user->jenis_kelamin,
            ];
        } else {
            $wali_santri = WaliSantri::where('id', $user->id)->first();
            $santri = Santri::where('id_wali', $wali_santri->id)->first();
            $data = [
                'nama_lengkap' => $santri->nama_lengkap,
                'nama_panggilan' => $santri->nama_panggilan,
                'alamat' => $user->alamat,
                'gambar' => $user->gambar,
                'tempat_lahir' => $user->tempat_lahir,
                'tanggal_lahir' => $user->tanggal_lahir,
                'hak_akses' => $role->keterangan,
                'token' => $user->token,
                'jenis_kelamin' => $user->jenis_kelamin,
                'nik' => $wali_santri->nik,
                'no_kk' => $wali_santri->no_kk,
            ];
        }


        return response()->json($data, 200);
    }
}
