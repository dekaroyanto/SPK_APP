@extends('layouts.default_template')

@section('content')
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Input Data',
                text: 'Lakukan filter terlebih dahulu!'
            });
        </script>
    @endif
    <div class="row">
        <div class="col-sm-10 mb-2">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Calon Karyawan</h1>


            {{-- <form action="{{ route('Alternatif') }}" method="GET">
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

                        <input type="month" class="form-control ml-2" id="tanggalFilter" name="periode"
                            value="{{ request('periode') }}">
                        <button type="submit" class="btn btn-primary ml-2">Filter</button>
                        <a href="{{ url('Alternatif') }}" class="btn btn-danger ml-2">Reset</a>
                    </div>
                </div>
            </form> --}}
        </div>
        <div class="col-sm-2 d-flex flex-column gap-1">
            <a href="{{ url('Alternatif/tambah') }}" class="btn btn-primary mb-2">
                <i class="fa fa-plus"></i>
                Tambah Data
            </a>
        </div>

        <form class="mt-2" action="{{ route('Alternatif') }}" method="GET">
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <select class="form-control" id="divisiFilter" name="divisi">
                            <option value="">Semua Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->divisi }}" @if (request('divisi') == $division->divisi) selected @endif>
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
                        <a href="{{ url('Alternatif') }}" class="btn btn-danger ml-4">Reset</a>
                    </div>
                </div>

                {{-- <div class="col-12">
                    <button type="submit" class="btn btn-primary ml-2">Filter</button>
                    <a href="{{ url('Alternatif') }}" class="btn btn-danger ml-4">Reset</a>
                </div> --}}
            </div>
        </form>
    </div>

    @if (session('message'))
        {!! session('message') !!}
    @endif

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Daftar Calon Karyawan</h6>
            <form action="{{ url('Alternatif/update-diterima') }}" method="POST" class="mt-3">
                @csrf

                <div class="col-md-3 mb-1">
                    <div class="input-group mb-3">
                        <input type="hidden" name="divisi" value="{{ request('divisi') }}">
                        <input type="hidden" name="periode" value="{{ request('periode') }}">
                        <input type="number" name="diterima" id="diterima" class="form-control"
                            placeholder="Jumlah Diterima" aria-label="Example text with button addon"
                            aria-describedby="button-addon1">
                        <button class="btn btn-primary" type="submit" id="button-addon1">Input</button>

                    </div>
                </div>
            </form>
            <label for="">Jumlah diterima: {{ $jumlahDiterima }}</label>
            {{-- <form action="{{ url('Alternatif/update-diterima') }}" method="POST" class="mt-3">
                @csrf

                <div class="col-md-4 mb-1">
                    <div class="input-group mb-3">
                        <input type="hidden" name="divisi" value="{{ request('divisi') }}">
                        <input type="hidden" name="periode" value="{{ request('periode') }}">
                        <input type="number" name="diterima" id="diterima" class="form-control" placeholder=""
                            aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <button class="btn btn-primary" type="submit" id="button-addon1">Update</button>

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
                            <th>Nama</th>
                            <th class="text-center">No Telepon</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Jumlah Diterima</th>
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
                                <td class="text-left">{{ substr($data->nama, 0, 2) }}****</td>
                                <td class="text-center">
                                    0{{ substr($data->notelp, 0, 1) }}******{{ substr($data->notelp, -3) }}
                                </td>
                                <td class="text-center">{{ $data->divisi }}</td>
                                <td class="text-center">{{ date('F Y', strtotime($data->periode)) }}</td>
                                <td class="text-center">{{ $data->diterima ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a data-toggle="tooltip" data-placement="bottom" title="Detail Data"
                                            href="{{ url('Alternatif/detail', $data->id_alternatif) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                        <a data-toggle="tooltip" data-placement="bottom" title="Edit Data"
                                            href="{{ url('Alternatif/edit/' . $data->id_alternatif) }}"
                                            class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
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
