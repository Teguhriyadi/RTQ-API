<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CabangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $cek = Cabang::get();

        if ($cek->count() < 1) {
            $data = "Data tidak ada.";
        } else {
            $data = $cek;
        }

        return response()->json($data, 200);
    }
}
