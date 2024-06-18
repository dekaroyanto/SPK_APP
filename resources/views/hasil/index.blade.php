@extends('layouts.default_template')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>
        <a href="{{ route('cetakLaporan', ['divisi' => request('divisi'), 'periode' => request('periode')]) }}"
            class="btn btn-success"><i class="fa fa-print"></i> Cetak Laporan</a>
    </div>


    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>

            <form action="{{ route('Hasil') }}" method="GET">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <select class="form-control" id="divisiFilter" name="divisi">
                                {{-- <option value="">Semua Divisi</option> --}}
                                @foreach ($divisions as $division)
                                    <option value="{{ $division }}" @if (request('divisi') == $division) selected @endif>
                                        {{ $division }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <input type="month" class="form-control ml-2" id="tanggalFilter" name="periode"
                                value="{{ \Carbon\Carbon::now()->format('Y-m') }}" placeholder="Periode">
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary ml-2">Filter</button>
                            <a href="{{ route('Hasil') }}" class="btn btn-danger ml-2">Reset</a>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                        <a href="{{ url('Alternatif') }}" class="btn btn-danger ml-4">Reset</a>
                    </div> --}}
                </div>
            </form>

            <label for="">Jumlah diterima: {{ $jumlahDiterima }}</label>

            {{-- <form action="{{ route('Hasil') }}" method="GET">
                <div class="form-group col-md-4 mt-3">
                    <div style="display: flex; align-items: center;">
                        <select class="form-control" id="divisiFilter" name="divisi">
                            <option value="">Semua Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division }}" @if (request('divisi') == $division) selected @endif>
                                    {{ $division }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>Periode</div>
                <div class="form-group col-md-4">
                    <div style="display: flex; align-items: center;" class="gap-1">
                        <input type="month" class="form-control ml-2" id="tanggalFilter" name="periode"
                            value="{{ request('periode') }}">
                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                        <a href="{{ route('Hasil') }}" class="btn btn-danger ml-2">Reset</a>
                    </div>
                </div>
            </form> --}}
        </div>
        @if (request('divisi') || request('periode'))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-sm" id="table1">
                        <thead class="text-center">
                            <tr>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>Divisi</th>
                                <th>Periode</th>
                                <th width="15%">Ranking</th>
                                {{-- <th>Jumlah Diterima</th> --}}
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($hasil as $keys)
                                <tr>
                                    {{-- <td>{{ $keys->nama }}</td> --}}
                                    <td class="text-center">{{ substr($keys->nama, 0, 2) }}****</td>
                                    <td class="text-center">
                                        0{{ substr($keys->notelp, 0, 1) }}******{{ substr($keys->notelp, -3) }}
                                    </td>
                                    <td>{{ $keys->divisi }}</td>
                                    <td>{{ date('F Y', strtotime($keys->periode)) }}</td>
                                    <td>{{ $no }}</td>
                                    {{-- <td>{{ $keys->diterima !== null ? $keys->diterima : '-' }}</td> --}}
                                    <td>
                                        @if ($keys->diterima !== null)
                                            {{ $no <= $keys->diterima ? 'DITERIMA' : 'DITOLAK' }}
                                        @else
                                            -
                                        @endif
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
    @endif
@endsection
