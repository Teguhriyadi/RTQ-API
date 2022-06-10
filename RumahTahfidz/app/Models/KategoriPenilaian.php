<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPenilaian extends Model
{
    use HasFactory;

    protected $table = "tb_kategori_penilaian";

    protected $guarded = [''];

    public $timestamps = false;

    public function getPelajaran()
    {
        return $this->belongsTo("App\Models\Pelajaran", "id_pelajaran", "id");
    }
}
