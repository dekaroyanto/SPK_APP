<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\AlternatifModel;
use App\Models\PerhitunganModel;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        $id_user_level = session('log.id_user_level');
        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "Hasil";
        $data['hasil'] = PerhitunganModel::get_hasil();
        $data['divisions'] = AlternatifModel::distinct('divisi')->pluck('divisi'); // Fetch distinct division values

        // Apply filters if provided in the request
        if ($request->filled('divisi')) {
            $data['hasil'] = $data['hasil']->where('divisi', $request->divisi);
        }
        if ($request->filled('periode')) {
            $data['hasil'] = $data['hasil']->where('periode', $request->periode);
        }

        return view('hasil.index', $data);
    }

    public function Laporan()
    {
        $id_user_level = session('log.id_user_level');
        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }
        $data['hasil'] = PerhitunganModel::get_hasil();
        return view('hasil.laporan', $data);
    }

    public function cetakLaporan(Request $request)
    {
        $data['hasil'] = PerhitunganModel::get_hasil();

        // Apply filters if provided in the request
        if ($request->filled('divisi')) {
            $data['hasil'] = $data['hasil']->where('divisi', $request->divisi);
        }
        if ($request->filled('periode')) {
            $data['hasil'] = $data['hasil']->where('periode', $request->periode);
        }

        // Render the view as a PDF
        // $pdf = PDF::loadView('hasil.laporan', $data);
        // return $pdf->download('laporan.pdf');
        return view('hasil.laporan', $data);
    }
}
