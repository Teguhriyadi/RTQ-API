<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'no_hp' => 'required',
            'password' => 'required',
        ]);

        $no_hp = $request->post('no_hp');
        $password = $request->post('password');

        $user = User::where('no_hp', $no_hp)->first();

        if ($user) {
            if ($user->status == 1) {
                $hak_akses = HakAkses::where('id_role', $request->id_role)->where('id_user', $user->id)->first();
                if ($hak_akses) {
                    $cekPassword = Hash::check($password, $user->password);

                    if (!$cekPassword) {
                        return response()->json(['message' => 'Your password wrong!'], 404);
                    }

                    $token = bin2hex(random_bytes(40));

                    $user->update([
                        'token' => $token,
                        'id_hak_akses' => $hak_akses->id
                    ]);

                    $role = Role::where('id', $hak_akses->id_role)->first();

                    $user['keterangan'] = $role->keterangan;
                    $user['id_role'] = $role->id;

                    return response()->json($user);
                } else {
                    return response()->json(['message' => 'Your account not have access!'], 404);
                }
            } else {
                return response()->json(['message' => 'Your account not active!'], 404);
            }
        } else {
            return response()->json(['message' => 'Your account not found!'], 404);
        }
    }

    public function logout($no_hp)
    {
        $user = User::where('no_hp', $no_hp)->first();

        if ($user) {
            $user->update([
                'token' => NULL
            ]);

            return response()->json(['message' => 'Logout successfully!'], 200);
        } else {
            return response()->json(['message' => 'Your account not found!'], 404);
        }
    }
}
