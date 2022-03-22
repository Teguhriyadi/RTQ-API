<?php

namespace App\Http\Controllers;

use App\Models\Contoh;

class ContohController extends Controller
{
    public function __construct()
    {
        //
    }

    public function coba()
    {
        $data = [
            'nama' => 'hakim asrori',
            'telp' => '01920981208',
        ];

        return response()->json($data);
    }
}
