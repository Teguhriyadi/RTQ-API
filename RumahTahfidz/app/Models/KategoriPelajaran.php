<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPelajaran extends Model
{
    use HasFactory;

    protected $table = "tb_kategori_pelajaran";

    protected $guarded = [''];

    public function getPelajaran()
    {
        return $this->belongsTo("App\Models\Pelajaran", "id_pelajaran", "id");
    }
}