@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>

    <div>
        <a href="{{ url('Kriteria/tambah') }}" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
        <a href="{{ url('Kriteria/generate') }}" class="btn btn-primary"> <i class="fa fa-check"></i> Generate Bobot </a>
    </div>
</div>

@if (session('message'))
    {!! session('message') !!}
@endif

<div class="alert alert-info">
	Bila melakukan tambah, edit dan hapus data, maka silahkan melakukan <b>Generate Bobot</b> untuk mengupdate nilai bobot kriteria.
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Daftar Data Kriteria</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-warning text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Tingkat Prioritas</th>
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
                            <td>{{ $data->kode_kriteria }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>
                                @if($data->bobot == NULL)
                                    {{ "-" }}
                                @else
                                    {{ $data->bobot }}
                                @endif
                            </td>
                            <td>{{ $data->prioritas }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="{{ url('Kriteria/edit/'.$data->id_kriteria) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="{{ url('Kriteria/destroy/'.$data->id_kriteria) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

@include('layouts.footer_admin')
