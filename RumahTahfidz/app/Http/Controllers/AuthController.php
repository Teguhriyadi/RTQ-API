<?php

namespace App\Http\Controllers;

use App\Models\User;

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

        if (!$user) {
            return response()->json(['message' => 'Login failed!'], 401);
        }

        $cekPassword = Hash::check($password, $user->password);

        if (!$cekPassword) {
            return response()->json(['message' => 'Login failed!'], 401);
        }

        $token = bin2hex(random_bytes(40));

        $user->update([
            'token' => $token
        ]);

        return response()->json($user);
    }
}
