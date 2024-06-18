@extends('layouts.default_template')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users-cog"></i> Data User</h1>

        <a href="{{ url('User') }}" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i
                    class="fas fa-arrow-left"></i></span>
            <span class="text">Kembali</span>
        </a>
    </div>

    {!! session('message') !!}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-fw fa-plus"></i> Tambah Data User</h6>
        </div>

        <form action="{{ url('User/simpan') }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Nama Lengkap</label>
                        <input autocomplete="off" type="text" name="nama" required class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">E-Mail</label>
                        <input autocomplete="off" type="email" name="email" required class="form-control" />
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Username</label>
                        <input autocomplete="off" type="text" name="username" required class="form-control" />
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Password</label>
                        <input autocomplete="off" type="password" name="password" required class="form-control" />
                    </div>

                    <div class="form-group col-md-6" hidden>
                        <label class="font-weight-bold">Level</label>
                        <select class="form-control" name ="privilege" required>
                            @foreach ($user_level as $k)
                                @if ($k->id_user_level === 1)
                                    <option value="{{ $k->id_user_level }}">{{ $k->user_level }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1"><i class="bi bi-floppy-fill"></i> Simpan</button>
                <button type="reset" class="btn btn-danger"><i class="bi bi-arrow-repeat"></i> Reset</button>
            </div>
        </form>
    </div>
@endsection
