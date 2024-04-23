@extends('layouts.default_template')

@section('content')
    <section class="section">
        <div>
            <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
            <div class="alert alert-primary">
                Bila melakukan tambah, edit, dan hapus data silahkan melakukan <b>Generate Bobot</b> untuk memperbarui nilai bobot kriteria.
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ url('Kriteria/tambah') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
                <a href="{{ url('Kriteria/generate') }}" class="btn btn-primary"> <i class="fa fa-check"></i> Generate Bobot </a>
            </div>
            <div class="card-body">
                <table class="table table-striped text-sm" id="table1">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode Kriteria</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                            <th>Tingkat Prioritas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($list as $data)
                            <tr >
                                <td>{{ $no }}</td>
                                <td>{{ $data->kode_kriteria }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    @if($data->bobot == NULL)
                                        {{ "-" }}
                                    @else
                                        {{ $data->bobot }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $data->prioritas }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="{{ url('Kriteria/edit/'.$data->id_kriteria) }}" class="btn btn-warning btn-sm"><i
                                            class="bi bi-pencil-square"></i></a>
                                        <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('Kriteria/destroy/'.$data->id_kriteria) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash-fill"></i></a>
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

    </section>


@endsection
