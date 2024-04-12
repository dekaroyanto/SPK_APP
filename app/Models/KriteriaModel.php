<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $fillable = ['keterangan', 'kode_kriteria', 'bobot', 'prioritas'];
    public $timestamps = false;
}
