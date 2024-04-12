<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $fillable = ['id_alternatif', 'id_kriteria', 'nilai'];
    public $timestamps = false;

    public static function untuk_tombol($id_alternatif)
    {
        return self::where('id_alternatif', $id_alternatif)->count();
    }

    public static function data_penilaian($id_alternatif, $id_kriteria)
    {
        return self::where('id_alternatif', $id_alternatif)->where('id_kriteria', $id_kriteria)->first();
    }

    public static function tambah_penilaian($id_alternatif, $id_kriteria, $nilai)
    {
        return self::insert([
            'id_alternatif' => $id_alternatif,
            'id_kriteria' => $id_kriteria,
            'nilai' => $nilai
        ]);
    }

    public static function edit_penilaian($id_alternatif, $id_kriteria, $nilai)
    {
        return self::where('id_alternatif', $id_alternatif)
            ->where('id_kriteria', $id_kriteria)
            ->update(['nilai' => $nilai]);
    }
}
