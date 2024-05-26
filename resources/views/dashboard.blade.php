@extends('layouts.default_template')

@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldUser1"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold"> Calon Karyawan</h6>
                                    <h6 class="font-extrabold mb-0">{{ $countAlternatif }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldCategory"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Kriteria</h6>
                                    <h6 class="font-extrabold mb-0">{{ $countKriteria }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
    </div>

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>No Telp</th>
                            <th>Divisi</th>
                            <th>Periode</th>
                            <th width="15%">Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($hasil as $keys)
                            <tr>
                                <td>{{ $no }}</td>
                                <td class="text-left">{{ substr($keys->nama, 0, 2) }}****</td>
                                <td>
                                    0{{ substr($keys->notelp, 0, 1) }}******{{ substr($keys->notelp, -3) }}
                                </td>
                                <td>{{ $keys->divisi }}</td>
                                <td>{{ date('F Y', strtotime($keys->periode)) }}</td>
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
