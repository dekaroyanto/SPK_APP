@extends('layouts.default_template')


@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Alternatif</h1>

    <a href="{{ url('Alternatif') }}" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-fw fa-edit"></i> Edit Data Alternatif</h6>
    </div>

    <form method="POST" action="{{ url('Alternatif/update/'.$alternatif->id_alternatif) }}">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="id_alternatif" value="{{ $alternatif->id_alternatif }}">
                <div class="form-group col-md-12">
                    <label class="font-weight-bold">Nama Alternatif</label>
                    <input autocomplete="off" type="text" name="nama" value="{{ $alternatif->nama }}" required class="form-control"/>
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
