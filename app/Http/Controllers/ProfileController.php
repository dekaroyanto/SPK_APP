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
            'password' => 'required',
        ]);

        $data = [
            'password' => md5($request->input('password'))
        ];

        $user = UserModel::findOrFail($id_user);
        $user->update($data);

        return redirect('Profile')->with('success', 'Data profile berhasil diupdate!');
    }
}
