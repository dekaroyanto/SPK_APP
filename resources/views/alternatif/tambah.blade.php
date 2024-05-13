@extends('layouts.default_template')


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Calon Karyawan</h1>

        <a href="{{ url('Alternatif') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i></span>
            <span class="text">Kembali</span>
        </a>
    </div>

    @if (session('message'))
        {!! session('message') !!}
    @endif

    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fas fa-fw fa-plus"></i> Tambah Data Calon Karyawan</h6>
        </div>

        <form action="{{ url('Alternatif/simpan') }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="jabatan" class="form-label">Nama</label>
                        <input autocomplete="off" type="text" name="nama" required
                            class="form-control round form-control-lg" />
                        {{-- <input class="form-control form-control-lg" type="text" placeholder="Large Input"> --}}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="jabatan" class="form-label">No Telepon</label>
                        <input autocomplete="off" type="number" name="notelp" required
                            class="form-control round form-control-lg" />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="jabatan" class="form-label">Divisi</label>
                        <select class="choices form-select" name="divisi" id="divisi">
                            <option value="MARKETING">MARKETING</option>
                            <option value="COLLECTOR">COLLECTOR</option>
                            <option value="ACCOUNTING">ACCOUNTING</option>
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
