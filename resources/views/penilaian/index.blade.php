@extends('layouts.default_template')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian</h1>
</div>

{!! session('message') !!}

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Daftar Data Penilaian</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-sm" id="table1">
                <thead class="text-center">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Alternatif</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($alternatif as $keys)
                    <tr align="center">
                        <td>{{ $no }}</td>
                        <td align="left">{{ $keys->nama }}</td>
                        <?php $cek_tombol = \App\Models\PenilaianModel::untuk_tombol($keys->id_alternatif); ?>

                        <td>
                            @if ($cek_tombol == 0)
                            <a data-bs-toggle="modal" href="#set{{ $keys->id_alternatif }}" class="btn btn-success btn-sm"><i class="bi bi-plus-lg"></i> Input</a>
                            @else
                            <a data-bs-toggle="modal" href="#edit{{ $keys->id_alternatif }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="set{{ $keys->id_alternatif }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Penilaian</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('Penilaian/tambah') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        @foreach ($kriteria as $key)
                                            @php
                                            $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria($key->id_kriteria);
                                            @endphp
                                            @if ($sub_kriteria != NULL)
                                                <input type="hidden" name="id_alternatif" value="{{ $keys->id_alternatif }}">
                                                <input type="hidden" name="id_kriteria[]" value="{{ $key->id_kriteria }}">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="{{ $key->id_kriteria }}">{{ $key->keterangan }}</label>
                                                    <select name="nilai[]" class="form-control" id="{{ $key->id_kriteria }}" required>
                                                        <option value="">--Pilih--</option>
                                                        @foreach ($sub_kriteria as $subs_kriteria)
                                                            <option value="{{ $subs_kriteria['id_sub_kriteria'] }}">{{ $subs_kriteria['deskripsi'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="edit{{ $keys->id_alternatif }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Penilaian</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('Penilaian/edit') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        @foreach ($kriteria as $key)
                                            @php
                                            $sub_kriteria = \App\Models\SubKriteriaModel::data_sub_kriteria($key->id_kriteria);
                                            @endphp
                                            @if ($sub_kriteria != NULL)
                                                <input type="hidden" name="id_alternatif" value="{{ $keys->id_alternatif }}">
                                                <input type="hidden" name="id_kriteria[]" value="{{ $key->id_kriteria }}">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="{{ $key->id_kriteria }}">{{ $key->keterangan }}</label>
                                                    <select name="nilai[]" class="form-control" id="{{ $key->id_kriteria }}" required>
                                                        <option value="">--Pilih--</option>
                                                        @foreach ($sub_kriteria as $subs_kriteria)
                                                            @php
                                                            $nilai = \App\Models\PenilaianModel::data_penilaian($keys->id_alternatif, $subs_kriteria['id_kriteria']);
                                                            @endphp
                                                            <option value="{{ $subs_kriteria['id_sub_kriteria'] }}" {{ isset($subs_kriteria['id_sub_kriteria']) && $nilai && $subs_kriteria['id_sub_kriteria'] == $nilai->nilai ? 'selected' : '' }}>{{ $subs_kriteria['deskripsi'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
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

@endsection


