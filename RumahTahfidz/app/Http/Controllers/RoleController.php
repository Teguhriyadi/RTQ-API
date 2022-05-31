<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view()
    {
        $role = Role::all();

        if ($role->count() > 0) {
            $d = [];
            foreach ($role as $c) {
                $d[] = [
                    "id" => $c->id,
                    "keterangan" => $c->keterangan
                ];
            }
            return response()->json($d, 200);
        } else {
            $d2 = 'null';
            return response()->json($d2, 200);
        }
    }
}
