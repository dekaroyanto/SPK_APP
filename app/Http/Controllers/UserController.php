<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "User";
        $data['list'] = UserModel::get_user();
        return view('user.index', $data);
    }

    public function tambah()
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "User";
        $data['user_level'] = UserModel::get_user_level();
        return view('user.tambah', $data);
    }

    public function simpan(Request $request)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'privilege' => 'required',
            'username' => 'required|unique:user',
            'password' => 'required',
        ]);

        $data = [
            'id_user_level' => $request->input('privilege'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => md5($request->input('password'))
        ];

        $result = UserModel::create($data);

        if ($result) {
            return redirect('User')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect('User/tambah')->with('error', 'Data gagal disimpan!');
        }
    }

    public function edit($id_user)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "User";
        $data['user_level'] = UserModel::get_user_level();
        $data['user'] = UserModel::findOrFail($id_user);
        return view('user.edit', $data);
    }

    public function detail($id_user)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $data['page'] = "User";
        $data['user_level'] = UserModel::get_user_level();
        $data['user'] = UserModel::findOrFail($id_user);
        return view('user.detail', $data);
    }

    public function update(Request $request, $id_user)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',

        ]);

        $data = [

            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
        ];

        $user = UserModel::findOrFail($id_user);
        $user->update($data);

        return redirect('User')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Request $request, $id_user)
    {
        $id_user_level = session('log.id_user_level');

        if ($id_user_level != 1) {
            return redirect()->route('login')->withErrors(['error' => 'Anda tidak berhak mengakses halaman ini. Silahkan login.']);
        }

        UserModel::findOrFail($id_user)->delete();
        return redirect('User')->with('success', 'Data berhasil dihapus!');
    }
}
