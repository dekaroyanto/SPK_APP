@extends('layouts.default_template')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>

        <a href="{{ url('Laporan') }}" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
    </div>

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-sm" id="table1">
                    <thead class="text-center">
                        <tr>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Divisi</th>
                            <th width="15%">Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($hasil as $keys)
                            <tr>
                                {{-- <td>{{ $keys->nama }}</td> --}}
                                <td class="text-left">{{ substr($keys->nama, 0, 2) }}****</td>
                                <td class="text-center">
                                    0{{ substr($keys->notelp, 0, 1) }}******{{ substr($keys->notelp, -3) }}
                                </td>
                                <td>{{ $keys->divisi }}</td>
                                <td>{{ $no }}</td>
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
