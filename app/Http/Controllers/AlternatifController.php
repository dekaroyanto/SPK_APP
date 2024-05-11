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

        $query = AlternatifModel::query();

        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
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
            'divisi' => 'required'
        ]);

        $data = [
            'nama' => $request->nama,
            'notelp' => $request->notelp,
            'divisi' => $request->divisi
        ];

        $result = AlternatifModel::create($data);

        if ($result) {
            return redirect('Alternatif')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect('Alternatif/tambah')->with('error', 'Data gagal disimpan!');
        }
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
        ]);

        $data = [
            'nama' => $request->nama,
            'notelp' => $request->notelp,
            'divisi' => $request->divisi
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
