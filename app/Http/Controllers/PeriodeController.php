<?php

namespace App\Http\Controllers;

use App\Models\PeriodeModel;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    // public function index()
    // {
    //     $id_user_level = session('log.id_user_level');

    //     if ($id_user_level != 1) {
    //         return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
    //     }

    //     $data['page'] = "Periode";
    //     $data['list'] = PeriodeModel::all();
    //     return view('periode.index', $data);
    // }

    public function index(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Periode";

        $data['divisions'] = PeriodeModel::select('divisi')->distinct()->get();

        $query = PeriodeModel::query()->orderBy('id_periode', 'desc');

        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
        }

        if ($request->has('tanggal') && $request->tanggal != "") {
            $tanggal = $request->tanggal;
            $query->where('tanggal', $tanggal);
        }

        $data['list'] = $query->get();

        return view('periode.index', $data);
    }
}
