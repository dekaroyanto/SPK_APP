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
                        <label for="nama" class="form-label">Nama</label>
                        <input value="{{ old('nama') }}" autocomplete="off" type="text" name="nama" required
                            class="form-control round form-control @error('nama') is-invalid @enderror" />
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="nama" class="form-label">No Telepon</label>
                        <input value="{{ old('notelp') }}" autocomplete="off" type="number" name="notelp" required
                            class="form-control round form-control @error('notelp') is-invalid @enderror" />
                        @error('notelp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="nama" class="form-label">Periode</label>
                        <select name="id_periode" id="id_periode">
                            @foreach ($periodes as $periode)
                                <?php
                                
                                $bulan = date('F', strtotime($periode->tanggal)); // Ambil nama bulan
                                $tahun = date('Y', strtotime($periode->tanggal)); // Ambil tahun
                                ?>
                                <option value="{{ $periode->id }}">{{ $bulan }} {{ $tahun }} -
                                    {{ $periode->divisi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="divisi" class="form-label">Divisi</label>
                        <select class=" form-select form-control" name="divisi" id="divisi">
                            <option value="MARKETING">MARKETING</option>
                            <option value="COLLECTOR">COLLECTOR</option>
                            <option value="ACCOUNTING">ACCOUNTING</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="periode" class="form-label">Periode</label>
                        <input value="{{ old('periode') }}" autocomplete="off" type="month" name="periode" required
                            class="form-control round form-control" />
                    </div>
                </div>
            </div>
            <div class="card-footer col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1"><i class="bi bi-floppy-fill"></i> Simpan</button>
                <button type="reset" class="btn btn-danger"><i class="bi bi-arrow-repeat"></i> Urungkan</button>
            </div>
        </form>
    </div>
@endsection
