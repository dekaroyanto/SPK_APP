@extends('layouts.default_template')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fa-solid fa-key"></i> Ganti Password</h1>
    </div>

    @if (session('message'))
        {!! session('message') !!}
    @endif

    <div class="card shadow mb-4">


        <form method="POST" action="{{ url('Profile/ChangePassword/' . $profile->id_user) }}">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="id_user" value="{{ $profile->id_user }}">

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">Old Password</label>
                        <input autocomplete="off" type="password" name="old_password" required class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="font-weight-bold">New Password</label>
                        <input autocomplete="off" type="password" name="password" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1"><i class="bi bi-floppy-fill"></i> Update</button>
                <button type="reset" class="btn btn-danger"><i class="bi bi-arrow-repeat"></i> Reset</button>
            </div>
        </form>
    </div>
@endsection
