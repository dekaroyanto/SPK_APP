<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Penilaian";
        $data['divisions'] = AlternatifModel::select('divisi')->distinct()->get();
        $query = AlternatifModel::query();
        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
        }
        $data['alternatif'] = $query->get();
        $data['kriteria'] = KriteriaModel::all();
        return view('penilaian.index', $data);
    }

    public function tambah(Request $request)
    {
        $id_alternatif = $request->input('id_alternatif');
        $id_kriteria = $request->input('id_kriteria');
        $nilai = $request->input('nilai');
        $i = 0;
        foreach ($nilai as $key) {
            PenilaianModel::tambah_penilaian($id_alternatif, $id_kriteria[$i], $key);
            $i++;
        }
        return redirect('Penilaian')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(Request $request)
    {
        $id_alternatif = $request->input('id_alternatif');
        $id_kriteria = $request->input('id_kriteria');
        $nilai = $request->input('nilai');
        $i = 0;

        foreach ($nilai as $key) {
            $cek = PenilaianModel::data_penilaian($id_alternatif, $id_kriteria[$i]);
            if (!$cek) {
                PenilaianModel::tambah_penilaian($id_alternatif, $id_kriteria[$i], $key);
            } else {
                PenilaianModel::edit_penilaian($id_alternatif, $id_kriteria[$i], $key);
            }
            $i++;
        }
        return redirect()->route('Penilaian')->with('success', 'Data berhasil diupdate!');
    }
}
