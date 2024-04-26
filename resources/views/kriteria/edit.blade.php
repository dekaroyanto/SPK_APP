@extends('layouts.default_template')


@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>

    <a href="{{ url('Kriteria') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">

    <form method="POST" action="{{ url('Kriteria/update/'.$kriteria->id_kriteria) }}">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="id_kriteria" value="{{ $kriteria->id_kriteria }}">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Kode Kriteria</label>
                    <input autocomplete="off" type="text" name="kode_kriteria" value="{{ $kriteria->kode_kriteria }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Nama Kriteria</label>
                    <input autocomplete="off" type="text" name="keterangan" value="{{ $kriteria->keterangan }}" required class="form-control"/>
                </div>

                <div class="form-group col-md-4">
					<label class="font-weight-bold">Tingkat Prioritas</label>
					<input autocomplete="off" type="number" name="prioritas" value="{{ $kriteria->prioritas }}" required class="form-control"/>
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
