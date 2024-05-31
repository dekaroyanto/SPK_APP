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

    public function updateDiterima(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $divisi = $request->input('divisi');
        $periode = $request->input('periode');
        $diterima = $request->input('diterima');

        $alternatifs = AlternatifModel::where('divisi', $divisi)
            ->where('periode', $periode)
            ->get();

        // Cek apakah ada data yang memenuhi kriteria
        if ($alternatifs->isEmpty()) {
            return redirect()->route('Alternatif')->withErrors('Tidak ada data yang memenuhi kriteria untuk diperbarui.');
        }

        foreach ($alternatifs as $alternatif) {
            $alternatif->diterima = $diterima;
            $alternatif->save();
        }

        return redirect()->route('Alternatif')->with('success', 'Jumlah Diterima berhasil diupdate!');
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
            'nama' => 'required|unique:alternatif',
            'notelp' => 'required|unique:alternatif',
            'divisi' => 'required',
            'periode' => 'required',
        ], [
            'nama.unique' => 'Nama sudah terdaftar',
            'nama.required' => 'Nama harus terisi',
            'notelp.unique' => 'No telepon sudah terdaftar',
            'notelp.required' => 'No telepon harus terisi',
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
        }
        // else {
        //     return redirect('Alternatif/tambah')->with('error', 'Data gagal disimpan!');
        // }
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
            'nama' => 'required|unique:alternatif,nama,' . $id_alternatif . ',id_alternatif',
            'notelp' => 'required|unique:alternatif,notelp,' . $id_alternatif . ',id_alternatif',
            'divisi' => 'required',
            'periode' => 'required',
        ], [
            'nama.unique' => 'Nama sudah terdaftar',
            'nama.required' => 'Nama harus terisi',
            'notelp.unique' => 'No telepon sudah terdaftar',
            'notelp.required' => 'No telepon harus terisi',
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
