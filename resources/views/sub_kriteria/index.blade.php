@extends('layouts.default_template')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes"></i> Data Subkriteria</h1>
    </div>

    {!! session('message') !!}

    @if (count($kriteria) == 0)
        <div class="card shadow mb-4">
            <!-- /.card-header -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Daftar Data Subkriteria</h6>
            </div>

            <div class="card-body">
                <div class="alert alert-info">
                    Data masih kosong.
                </div>
            </div>
        </div>
    @endif

    @foreach ($kriteria as $key)
        <div class="card shadow mb-4">
            <!-- /.card-header -->
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> {{ $key->keterangan }}
                        ({{ $key->kode_kriteria }})
                    </h6>

                    <a href="#tambah{{ $key->id_kriteria }}" data-bs-toggle="modal" class="btn btn-sm btn-primary"> <i
                            class="fa fa-plus"></i> Tambah Data </a>
                </div>
            </div>

            <div class="modal fade" id="tambah{{ $key->id_kriteria }}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah {{ $key->keterangan }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('SubKriteria/simpan') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <input type="hidden" name="id_kriteria" value="{{ $key->id_kriteria }}">
                                <div class="form-group">
                                    <label for="deskripsi" class="font-weight-bold">Nama Subkriteria</label>
                                    <input autocomplete="off" type="text" id="deskripsi" class="form-control"
                                        name="deskripsi" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai" class="font-weight-bold">Nilai</label>
                                    <input autocomplete="off" type="text" id="nilai" name="nilai"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                {{-- <th >No</th> --}}
                                <th>Nama Subkriteria</th>
                                <th>Nilai</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sub_kriteria1 = \App\Models\SubKriteriaModel::data_sub_kriteria($key->id_kriteria);
                            $no = 1;
                            ?>

                            @foreach ($sub_kriteria1 as $key)
                                <tr>
                                    {{-- <td>{{ $no }}</td> --}}
                                    <td align="left">{{ $key->deskripsi }}</td>
                                    <td>{{ $key->nilai }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="#editsk{{ $key->id_sub_kriteria }}" data-bs-toggle="modal"
                                                title="Edit Data" class="btn btn-warning btn-sm"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            {{-- <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('SubKriteria/destroy/'.$key->id_sub_kriteria) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a> --}}
                                            <button data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
                                                onclick="confirmDelete('{{ url('SubKriteria/destroy/' . $key->id_sub_kriteria) }}')"
                                                class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="editsk{{ $key->id_sub_kriteria }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit
                                                    {{ $key->deskripsi }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ url('SubKriteria/edit/' . $key->id_sub_kriteria) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_kriteria"
                                                        value="{{ $key->id_kriteria }}">
                                                    <div class="form-group">
                                                        <label for="deskripsi" class="font-weight-bold">Nama Sub
                                                            Kriteria</label>
                                                        <input type="text" id="deskripsi" autocomplete="off"
                                                            class="form-control" value="{{ $key->deskripsi }}"
                                                            name="deskripsi" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nilai" class="font-weight-bold">Nilai</label>
                                                        <input type="text" autocomplete="off" id="nilai"
                                                            name="nilai" class="form-control"
                                                            value="{{ $key->nilai }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i> Update</button>
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
        </div>
    @endforeach
@endsection
