@extends('layouts.default_template')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Alternatif</h1>

    <a href="{{ url('Alternatif/tambah') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data </a>
</div>

@if (session('message'))
    {!! session('message') !!}
@endif

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Daftar Data Alternatif</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-sm" id="table1">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th class="text-center">Nama Alternatif</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($list as $data)
                        <tr align="center">
                            <td>{{ $no }}</td>
                            <td class="text-left">{{ $data->nama }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="{{ url('Alternatif/edit/'.$data->id_alternatif) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                                    {{-- <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('Alternatif/destroy/'.$data->id_alternatif) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a> --}}

                                    <button data-toggle="tooltip" data-placement="bottom" title="Hapus Data" onclick="confirmDelete('{{ url('Alternatif/destroy/'.$data->id_alternatif) }}')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
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
