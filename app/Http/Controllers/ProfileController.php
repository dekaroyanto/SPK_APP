<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class ProfileController extends Controller
{
    public function index()
    {
        $id_user = session('log.id_user');
        $data['page'] = "Profile";
        $data['profile'] = UserModel::findOrFail($id_user);
        return view('profile.index', $data);
    }

    public function update(Request $request, $id_user)
    {
        $this->validate($request, [
            'email' => 'required',
            'nama' => 'required',
            'username' => 'required',

        ]);

        $data = [
            'email' => $request->input('email'),
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),

        ];

        $user = UserModel::findOrFail($id_user);
        $user->update($data);

        session(['log.nama' => $data['nama']]);

        return redirect('Profile')->with('success', 'Data profile berhasil diupdate!');
    }

    public function ChangePasswordForm()
    {
        $id_user = session('log.id_user');
        $data['page'] = "Profile";
        $data['profile'] = UserModel::findOrFail($id_user);
        return view('profile.changePasswordForm', $data);
    }

    public function ChangePassword(Request $request, $id_user)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
        ]);

        $user = UserModel::findOrFail($id_user);

        // Periksa apakah password lama cocok
        if (md5($request->input('old_password')) !== $user->password) {
            return redirect()->back()->with('error', 'Password lama tidak cocok.');
        }

        $data = [
            'password' => md5($request->input('password'))
        ];

        $user->update($data);

        return redirect('Profile/ChangePassword')->with('success', 'Password berhasil diubah!');
    }
}
