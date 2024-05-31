@extends('layouts.default_template')

@section('content')
    <div class="row">
        <div class="col-sm-10 mb-2">
            <h1 class="h3 mb-0 text-gray-800"><i class="fa-regular fa-calendar-days"></i> Data Periode</h1>
        </div>
        <div class="col-sm-2 d-flex flex-column gap-1">
            <a href="{{ url('Alternatif/tambah') }}" class="btn btn-primary mb-2">
                <i class="fa fa-plus"></i>
                Tambah Data
            </a>

        </div>
    </div>



    @if (session('message'))
        {!! session('message') !!}
    @endif

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Daftar Periode</h6>

            <form action="{{ route('Periode') }}" method="GET">
                <div class="form-group col-md-4 mt-3">
                    <div style="display: flex; align-items: center;">
                        <select class="form-control" id="divisiFilter" name="divisi">
                            <option value="">Semua Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->divisi }}" @if (request('divisi') == $division->divisi) selected @endif>
                                    {{ $division->divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>Periode</div>
                <div class="form-group col-md-4">
                    <div style="display: flex; align-items: center;" class="gap-1">

                        <input type="month" class="form-control ml-2" id="tanggalFilter" name="tanggal"
                            value="{{ request('tanggal') }}">
                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                        <a href="{{ url('Periode') }}" class="btn btn-danger ml-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-sm" id="table1">
                    <thead class="text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Diterima</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($list as $data)
                            <tr>
                                <td>{{ $no }}</td>
                                <td class="text-center">{{ date('F Y', strtotime($data->tanggal)) }}</td>
                                <td class="text-center">{{ $data->divisi }}</td>
                                <td class="text-center">{{ $data->diterima }}</td>
                                {{-- <td class="text-center">0{{ $data->notelp }}</td> --}}
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        {{-- <a data-toggle="tooltip" data-placement="bottom" title="Detail Data"
                                            href="{{ url('Alternatif/detail', $data->id_alternatif) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a> --}}
                                        <a data-toggle="tooltip" data-placement="bottom" title="Edit Data"
                                            href="{{ url('Alternatif/edit/' . $data->id_alternatif) }}"
                                            class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                        {{-- <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('Alternatif/destroy/'.$data->id_alternatif) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a> --}}

                                        <button data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
                                            onclick="confirmDelete('{{ url('Alternatif/destroy/' . $data->id_alternatif) }}')"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
