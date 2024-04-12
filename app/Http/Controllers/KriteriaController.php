<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KriteriaModel;

class KriteriaController extends Controller
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
        
        $data['page'] = "Kriteria";
        $data['list'] = KriteriaModel::all();
        return view('kriteria.index', $data);
    }

    public function generate(Request $request)
    {
        $kriteria = KriteriaModel::all();
        foreach ($kriteria as $x){
            $total = count($kriteria);
            $b = 0;
            foreach ($kriteria as $y){
                if($y->prioritas >= $x->prioritas){
                    $b += 1/$y->prioritas;
                }
            }
            $id_kriteria = $x->id_kriteria;
            $bobot = $b/$total;

            $data = [
                'bobot' => $bobot,
            ];
    
            $krt = KriteriaModel::findOrFail($id_kriteria);
            $krt->update($data);
        }
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data nilai bobot berhasil digenerate!</div>');
        return redirect()->route('Kriteria');
    }

    public function tambah()
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

        $data['page'] = "Kriteria";
        return view('kriteria.tambah', $data);
    }

    public function simpan(Request $request)
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

        $this->validate($request, [
            'keterangan' => 'required',
            'kode_kriteria' => 'required',
            'prioritas' => 'required',
        ]);

        $data = [
            'keterangan' => $request->keterangan,
            'kode_kriteria' => $request->kode_kriteria,
            'prioritas' => $request->prioritas,
        ];

        $result = KriteriaModel::create($data);

        if ($result) {
            $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect()->route('Kriteria');
        } else {
            $request->session()->flash('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            return redirect()->route('Kriteria/tambah');
        }
    }

    public function edit($id_kriteria)
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

        $data['page'] = "Kriteria";
        $data['kriteria'] = KriteriaModel::findOrFail($id_kriteria);
        return view('kriteria.edit', $data);
    }

    public function update(Request $request, $id_kriteria)
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

        $this->validate($request, [
            'keterangan' => 'required',
            'kode_kriteria' => 'required',
            'prioritas' => 'required',
        ]);

        $data = [
            'keterangan' => $request->keterangan,
            'kode_kriteria' => $request->kode_kriteria,
            'prioritas' => $request->prioritas,
        ];

        $kriteria = KriteriaModel::findOrFail($id_kriteria);
        $kriteria->update($data);

        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->route('Kriteria');
    }

    public function destroy(Request $request, $id_kriteria)
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

        KriteriaModel::findOrFail($id_kriteria)->delete();        
        $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect()->route('Kriteria');
    }
}
