<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternatifModel extends Model
{
    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = ['nama'];
    public $timestamps = false;
}
