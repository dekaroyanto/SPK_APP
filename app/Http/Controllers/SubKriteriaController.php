<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteriaModel;
use App\Models\KriteriaModel;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Sub Kriteria";
        $data['kriteria'] = KriteriaModel::all();
        return view('sub_kriteria.index', $data);
    }

    public function simpan(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $this->validate($request, [
            'id_kriteria' => 'required',
            'deskripsi' => 'required',
            'nilai' => 'required'
        ]);

        $data = [
            'id_kriteria' => $request->id_kriteria,
            'deskripsi' => $request->deskripsi,
            'nilai' => $request->nilai
        ];

        $result = SubKriteriaModel::create($data);

        if ($result) {
            return redirect()->route('SubKriteria')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('SubKriteria')->with('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
        }
    }

    public function edit(Request $request, $id_sub_kriteria)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $this->validate($request, [
            'id_kriteria' => 'required',
            'deskripsi' => 'required',
            'nilai' => 'required'
        ]);

        $data = [
            'id_kriteria' => $request->id_kriteria,
            'deskripsi' => $request->deskripsi,
            'nilai' => $request->nilai
        ];

        $subkriteria = SubKriteriaModel::findOrFail($id_sub_kriteria);
        $subkriteria->update($data);

        // $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        // return redirect('SubKriteria');

        return redirect()->route('SubKriteria')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Request $request, $id_sub_kriteria)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        SubKriteriaModel::findOrFail($id_sub_kriteria)->delete();
        // $request->session()->flash('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        // return redirect('SubKriteria');

        return redirect()->route('SubKriteria')->with('success', 'Data berhasil dihapus!');

    }
}
