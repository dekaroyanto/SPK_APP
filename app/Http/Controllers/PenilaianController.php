<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;

class PenilaianController extends Controller
{
    public function index()
    {
        $id_user_level = session('log.id_user_level');
        
        if ($id_user_level != 1) {
            ?>
            <script>
                window.location='<?php echo url("Dashboard"); ?>'
                alert('Anda tidak berhak mengakses halaman ini!');
            </script>
            <?php
        }

        $data['page'] = "Penilaian";
        $data['alternatif'] = AlternatifModel::all();
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
        session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        return redirect('Penilaian');
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
        session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect('Penilaian');
    }
}
