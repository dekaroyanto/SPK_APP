@extends('layouts.default_template')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Calon Karyawan</h1>


    </div>

    <div class="mb-2 d-flex flex-column flex-sm-row">
        <a href="{{ url('Alternatif/tambah') }}" class="btn btn-primary mb-2 mb-sm-0"> <i class="fa fa-plus"></i> Tambah Data
        </a>
        <button class="btn btn-danger ml-sm-2" onclick="confirmDeleteAll()"> <i class="fa fa-trash"></i> Hapus Semua Data
        </button>
    </div>


    @if (session('message'))
        {!! session('message') !!}
    @endif

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Daftar Calon Karyawan</h6>

            <form action="{{ route('Alternatif') }}" method="GET">
                <div class="form-group col-md-4">
                    <div style="display: flex; align-items: center;">
                        <select class="form-control" id="divisiFilter" name="divisi">
                            <option value="">Semua Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->divisi }}">{{ $division->divisi }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
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
                            <th>Nama</th>
                            <th class="text-center">No Telepon</th>
                            <th class="text-center">Divisi</th>
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
                                <td class="text-left">{{ substr($data->nama, 0, 2) }}**</td>
                                <td class="text-center">0{{ substr($data->notelp, 0, 4) }}**</td>
                                <td class="text-center">{{ $data->divisi }}</td>
                                {{-- <td class="text-center">0{{ $data->notelp }}</td> --}}
                                <td class="text-center">
                                    <div class="btn-group" role="group">
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
