<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\AlternatifModel;
use App\Models\PerhitunganModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PerhitunganController extends Controller
{
    public function index(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Perhitungan";

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

        $data['alternatifs'] = $query->get();
        $data['kriterias'] = KriteriaModel::all();

        return view('perhitungan.index', $data);
    }

    public function matrixkeputusan(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Perhitungan";

        $data['divisions'] = AlternatifModel::select('divisi')->distinct()->get();

        $query = AlternatifModel::query()->orderBy('id_alternatif', 'desc');

        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
        }

        if ($request->has('periode') && $request->periode != "") {
            $periode = $request->periode;
            $query->where('periode', $periode);
            // Check if any data matches the criteria
            $count = $query->count();
            if ($count == 0) {
                // No data found for the given criteria, flash an error message
                Session::flash('error', 'Tidak ada data yang sesuai dengan periode yang dipilih.');
                // Redirect back to the same page
                return redirect()->back();
            }
        }

        $data['alternatifs'] = $query->get();
        $data['kriterias'] = KriteriaModel::all();
        return view('perhitungan.matrixkeputusan', $data);
    }

    public function normalisasi(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Perhitungan";

        $data['divisions'] = AlternatifModel::select('divisi')->distinct()->get();

        $query = AlternatifModel::query()->orderBy('id_alternatif', 'desc');

        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
        }

        // if ($request->has('periode') && $request->periode != "") {
        //     $periode = $request->periode;
        //     $query->where('periode', $periode);
        // }

        if ($request->has('periode') && $request->periode != "") {
            $periode = $request->periode;
            $query->where('periode', $periode);
            // Check if any data matches the criteria
            $count = $query->count();
            if ($count == 0) {
                // No data found for the given criteria, flash an error message
                Session::flash('error', 'Tidak ada data yang sesuai dengan periode yang dipilih.');
                // Redirect back to the same page
                return redirect()->back();
            }
        }

        $data['alternatifs'] = $query->get();
        $data['kriterias'] = KriteriaModel::all();
        return view('perhitungan.normalisasi', $data);
    }

    public function normalisasibobot(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Perhitungan";

        $data['divisions'] = AlternatifModel::select('divisi')->distinct()->get();

        $query = AlternatifModel::query()->orderBy('id_alternatif', 'desc');

        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
        }

        // if ($request->has('periode') && $request->periode != "") {
        //     $periode = $request->periode;
        //     $query->where('periode', $periode);
        // }

        if ($request->has('periode') && $request->periode != "") {
            $periode = $request->periode;
            $query->where('periode', $periode);
            // Check if any data matches the criteria
            $count = $query->count();
            if ($count == 0) {
                // No data found for the given criteria, flash an error message
                Session::flash('error', 'Tidak ada data yang sesuai dengan periode yang dipilih.');
                // Redirect back to the same page
                return redirect()->back();
            }
        }

        $data['alternatifs'] = $query->get();
        $data['kriterias'] = KriteriaModel::all();
        return view('perhitungan.normalisasibobot', $data);
    }

    public function nilaisr(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Perhitungan";

        $data['divisions'] = AlternatifModel::select('divisi')->distinct()->get();

        $query = AlternatifModel::query()->orderBy('id_alternatif', 'desc');

        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
        }

        // if ($request->has('periode') && $request->periode != "") {
        //     $periode = $request->periode;
        //     $query->where('periode', $periode);
        // }

        if ($request->has('periode') && $request->periode != "") {
            $periode = $request->periode;
            $query->where('periode', $periode);
            // Check if any data matches the criteria
            $count = $query->count();
            if ($count == 0) {
                // No data found for the given criteria, flash an error message
                Session::flash('error', 'Tidak ada data yang sesuai dengan periode yang dipilih.');
                // Redirect back to the same page
                return redirect()->back();
            }
        }

        $data['alternatifs'] = $query->get();
        $data['kriterias'] = KriteriaModel::all();
        return view('perhitungan.nilaisr', $data);
    }

    public function nilaiq(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Perhitungan";

        $data['divisions'] = AlternatifModel::select('divisi')->distinct()->get();

        $query = AlternatifModel::query()->orderBy('id_alternatif', 'desc');

        if ($request->has('divisi') && $request->divisi != "") {
            $divisi = $request->divisi;
            $query->where('divisi', $divisi);
        }

        // if ($request->has('periode') && $request->periode != "") {
        //     $periode = $request->periode;
        //     $query->where('periode', $periode);
        // }

        if ($request->has('periode') && $request->periode != "") {
            $periode = $request->periode;
            $query->where('periode', $periode);
            // Check if any data matches the criteria
            $count = $query->count();
            if ($count == 0) {
                // No data found for the given criteria, flash an error message
                Session::flash('error', 'Tidak ada data yang sesuai dengan periode yang dipilih.');
                // Redirect back to the same page
                return redirect()->back();
            }
        }

        $data['alternatifs'] = $query->get();
        $data['kriterias'] = KriteriaModel::all();
        return view('perhitungan.nilaiq', $data);
    }
}
