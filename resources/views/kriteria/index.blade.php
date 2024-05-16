@extends('layouts.default_template')

@section('content')
    <section class="section">
        <div>
            <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>
            <div class="alert alert-primary">
                Bila melakukan tambah, edit, dan hapus data silahkan melakukan <b>Generate Bobot</b> untuk memperbarui nilai
                bobot kriteria.
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ url('Kriteria/tambah') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
                <a href="{{ url('Kriteria/generate') }}" class="btn btn-primary"> <i class="fa fa-check"></i> Generate Bobot
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%" class="text-center">Kode Kriteria</th>
                            <th class="text-center">Nama Kriteria</th>
                            <th class="text-center">Bobot</th>
                            <th class="text-center">Tingkat Prioritas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($list as $data)
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center">{{ $data->kode_kriteria }}</td>
                                <td class="text-center">{{ $data->keterangan }}</td>
                                <td class="text-center">
                                    @if ($data->bobot == null)
                                        {{ '-' }}
                                    @else
                                        {{ $data->bobot }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $data->prioritas }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a data-toggle="tooltip" data-placement="bottom" title="Edit Data"
                                            href="{{ url('Kriteria/edit/' . $data->id_kriteria) }}"
                                            class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                        <button data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
                                            onclick="confirmDelete('{{ url('Kriteria/destroy/' . $data->id_kriteria) }}')"
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

    </section>
@endsection
