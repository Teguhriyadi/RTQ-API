<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

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

        $role = Role::find($user->id_role);

        $data = [
            'nama' => $user->nama,
            'email' => $user->email,
            'alamat' => $user->alamat,
            'gambar' => $user->gambar,
            'tempat_lahir' => $user->tempat_lahir,
            'tanggal_lahir' => $user->tanggal_lahir,
            'hak_akses' => $role->keterangan,
            'token' => $user->token,
        ];

        return response()->json($data, 200);
    }
}
