<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\AlternatifModel;
use App\Models\PerhitunganModel;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses_login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $passwordx = md5($password);

        $loginModel = new LoginModel();
        $set = $loginModel->login($username, $passwordx);

        if ($set) {
            $log = [
                'id_user' => $set->id_user,
                'username' => $set->username,
                'nama' => $set->nama,
                'id_user_level' => $set->id_user_level,
                'status' => 'Logged'
            ];

            session()->put('log', $log);

            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'loginError' => 'Username atau password salah'
            ]);
        }
    }



    public function Logout(Request $request) // Renamed the method to lowercase "logout"
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    public function Dashboard() // Renamed the method to lowercase "dashboard"
    {
        if (session('log.status') == 'Logged') {
            $data['page'] = "Dashboard";
            $countKriteria = KriteriaModel::count();
            $countAlternatif = AlternatifModel::count();
            $hasil = PerhitunganModel::get_hasil()->take(5);
            return view('dashboard', ['data' => $data, 'countKriteria' => $countKriteria, 'countAlternatif' => $countAlternatif, 'hasil' => $hasil]);
        } else {
            return redirect()->route('login');
        }
    }
}
