<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlternatifModel;

class AlternatifController extends Controller
{
    public function index(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Alternatif";

        $data['divisions'] = AlternatifModel::select('divisi')->distinct()->get();

        $query = AlternatifModel::query()->orderBy('id_alternatif', 'desc');

        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
        }

        if ($request->has('periode') && $request->periode != "") {
            $periode = $request->periode;
            $query->where('periode', $periode);
        }

        $data['list'] = $query->get();

        return view('alternatif.index', $data);
    }

    public function tambah()
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Alternatif";
        return view('alternatif.tambah', $data);
    }

    public function simpan(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $this->validate($request, [
            'nama' => 'required',
            'notelp' => 'required',
            'divisi' => 'required',
            'periode' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'notelp' => $request->notelp,
            'divisi' => $request->divisi,
            'periode' => $request->periode,
        ];

        $result = AlternatifModel::create($data);

        if ($result) {
            return redirect('Alternatif')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect('Alternatif/tambah')->with('error', 'Data gagal disimpan!');
        }
    }

    public function detail($id_alternatif)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Alternatif";
        $data['alternatif'] = AlternatifModel::findOrFail($id_alternatif);
        return view('alternatif.detail', $data);
    }

    public function edit($id_alternatif)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            if ($id_user_level != 1) {
                return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
            }
        }

        $data['page'] = "Alternatif";
        $data['alternatif'] = AlternatifModel::findOrFail($id_alternatif);
        return view('alternatif.edit', $data);
    }

    public function update(Request $request, $id_alternatif)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $this->validate($request, [
            'nama' => 'required',
            'notelp' => 'required',
            'divisi' => 'required',
            'periode' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'notelp' => $request->notelp,
            'divisi' => $request->divisi,
            'periode' => $request->periode,
        ];

        $alternatif = AlternatifModel::findOrFail($id_alternatif);
        $alternatif->update($data);

        return redirect()->route('Alternatif')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Request $request, $id_alternatif)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        AlternatifModel::findOrFail($id_alternatif)->delete();

        return redirect()->route('Alternatif')->with('success', 'Data berhasil dihapus!');
    }

    public function destroyAll()
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        AlternatifModel::query()->delete();

        return redirect()->route('Alternatif')->with('success', 'Semua data berhasil dihapus!');
    }
}
