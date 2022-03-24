<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AbsensiPengajarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $id_pengajar = $request->user()->id;

        

        return response()->json($id_pengajar, 200);
    }
}
