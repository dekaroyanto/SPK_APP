<?php

namespace App\Models;

use App\Models\AlternatifModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeriodeModel extends Model
{

    use HasFactory;

    protected $table = 'periode';

    protected $fillable = [
        'tanggal',
        'divisi',
        'diterima'
    ];

    public function alternatif()
    {
        return $this->hasMany(AlternatifModel::class, 'id_periode', 'id');
    }
}
