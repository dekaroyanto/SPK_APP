@extends('layouts.default_template')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian</h1>
    </div>

    {!! session('message') !!}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Daftar Data Penilaian</h6>

            <form action="{{ route('Penilaian') }}" method="GET">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <select class="form-control" id="divisiFilter" name="divisi">
                                <option value="">Semua Divisi</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->divisi }}"
                                        @if (request('divisi') == $division->divisi) selected @endif>
                                        {{ $division->divisi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <input type="month" class="form-control ml-2" id="tanggalFilter" name="periode"
                                value="{{ request('periode') }}" placeholder="Periode">
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary ml-2">Filter</button>
                            <a href="{{ url('Penilaian') }}" class="btn btn-danger ml-4">Reset</a>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                        <a href="{{ url('Alternatif') }}" class="btn btn-danger ml-4">Reset</a>
                    </div> --}}
                </div>
            </form>

            {{-- <form action="{{ route('Penilaian') }}" method="GET">
                <div class="form-group col-md-4">
                    <div style="display: flex; align-items: center;">
                        <select class="form-control" id="divisiFilter" name="divisi">
                            <option value="">Semua Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->divisi }}" @if (request('divisi') == $division->divisi) selected @endif>
                                    {{ $division->divisi }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div style="display: flex; align-items: center;">
                        <input type="month" class="form-control ml-2" id="tanggalFilter" name="periode"
                            value="{{ request('periode') }}">
                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                    </div>
                </div>
            </form> --}}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-sm" id="table1">
                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">No Telepon</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Tanggal</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($alternatif as $keys)
                            <tr>
                                <td>{{ $no }}</td>
                                <td class="text-left">{{ substr($keys->nama, 0, 2) }}****</td>
                                <td class="text-center">
                                    0{{ substr($keys->notelp, 0, 1) }}******{{ substr($keys->notelp, -3) }}
                                </td>
                                <td class="text-center">{{ $keys->divisi }}</td>
                                <td class="text-center">{{ date('F Y', strtotime($keys->periode)) }}</td>
                                <?php $cek_tombol = \App\Models\PenilaianModel::untuk_tombol($keys->id_alternatif); ?>

                                <td class="text-center">
                                    @if ($cek_tombol == 0)
                                        <a data-bs-toggle="modal" href="#set{{ $keys->id_alternatif }}"
                                            class="btn btn-success btn-sm"><i class="bi bi-plus-lg"></i> Input</a>
                                    @else
                                        <a data-bs-toggle="modal" href="#edit{{ $keys->id_alternatif }}"
                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="set{{ $keys->id_alternatif }}" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Penilaian</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('Penilaian/tambah') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                @foreach ($kriteria as $key)
                                                    @php
                                                        $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria(
                                                            $key->id_kriteria,
                                                        );
                                                    @endphp
                                                    @if ($sub_kriteria != null)
                                                        <input type="hidden" name="id_alternatif"
                                                            value="{{ $keys->id_alternatif }}">
                                                        <input type="hidden" name="id_kriteria[]"
                                                            value="{{ $key->id_kriteria }}">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold"
                                                                for="{{ $key->id_kriteria }}">{{ $key->keterangan }}</label>
                                                            <select name="nilai[]" class="form-control"
                                                                id="{{ $key->id_kriteria }}" required>
                                                                <option value="">--Pilih--</option>
                                                                @foreach ($sub_kriteria as $subs_kriteria)
                                                                    <option
                                                                        value="{{ $subs_kriteria['id_sub_kriteria'] }}">
                                                                        {{ $subs_kriteria['deskripsi'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                                    Simpan</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="edit{{ $keys->id_alternatif }}" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Penilaian</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('Penilaian/edit') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                @foreach ($kriteria as $key)
                                                    @php
                                                        $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria(
                                                            $key->id_kriteria,
                                                        );
                                                    @endphp
                                                    @if ($sub_kriteria != null)
                                                        <input type="hidden" name="id_alternatif"
                                                            value="{{ $keys->id_alternatif }}">
                                                        <input type="hidden" name="id_kriteria[]"
                                                            value="{{ $key->id_kriteria }}">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold"
                                                                for="{{ $key->id_kriteria }}">{{ $key->keterangan }}</label>
                                                            <select name="nilai[]" class="form-control"
                                                                id="{{ $key->id_kriteria }}" required>
                                                                <option value="">--Pilih--</option>
                                                                @foreach ($sub_kriteria as $subs_kriteria)
                                                                    @php
                                                                        $nilai = \App\Models\PenilaianModel::data_penilaian(
                                                                            $keys->id_alternatif,
                                                                            $subs_kriteria['id_kriteria'],
                                                                        );
                                                                    @endphp
                                                                    <option
                                                                        value="{{ $subs_kriteria['id_sub_kriteria'] }}"
                                                                        {{ isset($subs_kriteria['id_sub_kriteria']) && $nilai && $subs_kriteria['id_sub_kriteria'] == $nilai->nilai ? 'selected' : '' }}>
                                                                        {{ $subs_kriteria['deskripsi'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                                    Simpan</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $no++;
                            ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
