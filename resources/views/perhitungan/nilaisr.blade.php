@extends('layouts.default_template')

@section('css')
    {{-- <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"> --}}
    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
@endsection

@section('content')
    <?php
    \App\Models\PerhitunganModel::hapus_hasil();
    
    //Matrix Keputusan (X)
    $matriks_x = [];
    foreach ($alternatifs as $alternatif):
        foreach ($kriterias as $kriteria):
            $id_alternatif = $alternatif->id_alternatif;
            $id_kriteria = $kriteria->id_kriteria;
    
            $data_pencocokan = \App\Models\PerhitunganModel::data_nilai($id_alternatif, $id_kriteria);
            if (!empty($data_pencocokan['nilai'])) {
                $nilai = $data_pencocokan['nilai'];
            } else {
                $nilai = 0;
            }
    
            $matriks_x[$id_kriteria][$id_alternatif] = $nilai;
        endforeach;
    endforeach;
    
    //Matriks Ternormalisasi (R)
    $nilai_x = [];
    foreach ($alternatifs as $alternatif):
        foreach ($kriterias as $kriteria):
            $id_kriteria = $kriteria->id_kriteria;
            $id_alternatif = $alternatif->id_alternatif;
            $nilai = $matriks_x[$id_kriteria][$id_alternatif];
    
            $nilai_max = @max($matriks_x[$id_kriteria]);
            $nilai_min = @min($matriks_x[$id_kriteria]);
    
            // $x = ($nilai_max-$nilai)/($nilai_max-$nilai_min);
    
            // Periksa pembagian dengan nol sebelum melakukan pembagian
            if ($nilai_max - $nilai_min != 0) {
                $x = ($nilai_max - $nilai) / ($nilai_max - $nilai_min);
            } else {
                // Ubah alert menjadi SweetAlert2
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                                                                                                            Swal.fire({
                                                                                                            icon: "error",
                                                                                                            title: "Lengkapi Data Terlebih Dahulu",
                                                                                                            text: "Anda akan dialihkan ke halaman Penilaian",
                                                                                                            showCancelButton: false,
                                                                                                            confirmButtonColor: "#3085d6",
                                                                                                            confirmButtonText: "OK"
                                                                                                            }).then((result) => {
                                                                                                            if (result.isConfirmed) {
                                                                                                            window.location.href = "/Penilaian"; // Redirect to Penilaian page
                                                                                                            }
                                                                                                            });
                                                                                                           </script>';
            }
    
            $nilai_x[$id_alternatif][$id_kriteria] = $x;
        endforeach;
    endforeach;
    
    //Normalisasi Bobot (R)
    $nilai_r = [];
    $s = [];
    $n_s = [];
    foreach ($alternatifs as $alternatif):
        $total_r = 0;
        foreach ($kriterias as $kriteria):
            $id_kriteria = $kriteria->id_kriteria;
            $id_alternatif = $alternatif->id_alternatif;
            $bobot = $kriteria->bobot;
            $nilai = $nilai_x[$id_alternatif][$id_kriteria];
    
            $r = $nilai * $bobot;
    
            $nilai_r[$id_alternatif][$id_kriteria] = $r;
            $total_r += $r;
        endforeach;
        $s[$id_alternatif] = $total_r;
        $n_s[$id_alternatif]['nilai'] = $total_r;
    endforeach;
    
    // Nilai R
    $r = [];
    $n_r = [];
    foreach ($alternatifs as $alternatif):
        $id_alternatif = $alternatif->id_alternatif;
    
        $nilai_max = @max($nilai_r[$id_alternatif]);
    
        $r[$id_alternatif] = $nilai_max;
        $n_r[$id_alternatif]['nilai'] = $nilai_max;
    endforeach;
    
    // Max R
    $r_nilai = [];
    foreach ($n_r as $key => $row):
        $r_nilai[$key] = $row['nilai'];
    endforeach;
    
    // Max S
    $s_nilai = [];
    foreach ($n_s as $key => $row):
        $s_nilai[$key] = $row['nilai'];
    endforeach;
    
    //Nilai Qi
    $nilai_q = [];
    foreach ($alternatifs as $alternatif):
        $id_alternatif = $alternatif->id_alternatif;
    
        $nil_s = $s[$id_alternatif];
        $nil_r = $r[$id_alternatif];
        $max_s = max($s_nilai);
        $min_s = min($s_nilai);
        $max_r = max($r_nilai);
        $min_r = min($r_nilai);
    
        $v = 0.5;
        $n1 = $nil_s - $min_s;
        $n2 = $max_s - $min_s;
        $n3 = $nil_r - $min_r;
        $n4 = $max_r - $min_r;
    
        $bagi1 = $n1 / $n2;
        $bagi2 = $n3 / $n4;
    
        $hasil1 = $bagi1 * $v;
        $hasil2 = $bagi2 * (1 - $v);
        $q = $hasil1 + $hasil2;
        $nilai_q[$id_alternatif] = $q;
    endforeach;
    ?>


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan</h1>

    </div>

    <form action="{{ url('Perhitungan/nilaisr') }}" method="GET">
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
                <a href="{{ url('Perhitungan/matrixkeputusan') }}" class="btn btn-danger ml-2">Reset</a>
            </div>
        </div>
    </form>

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold "><i class="fa fa-table"></i> Nilai R</h6>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="">
                        <tr align="center">
                            <?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
                            <th>R<sub><?= $no ?></sub></th>
                            <?php
						$no++;
						endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <?php
						foreach ($alternatifs as $alternatif):
						$id_alternatif = $alternatif->id_alternatif;
						?>
                            <td>
                                <?php
                                echo $r[$id_alternatif];
                                ?>
                            </td>
                            <?php endforeach ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold "><i class="fa fa-table"></i> Nilai S</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="">
                        <tr align="center">
                            <?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
                            <th>S<sub><?= $no ?></sub></th>
                            <?php
						$no++;
						endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <?php
						foreach ($alternatifs as $alternatif):
						$id_alternatif = $alternatif->id_alternatif;
						?>
                            <td>
                                <?php
                                echo $s[$id_alternatif];
                                ?>
                            </td>
                            <?php endforeach ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold "><i class="fa fa-table"></i> Nilai S dan R</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="">
                        <tr align="center">
                            <th>S<sup>+</sup></th>
                            <th>S<sup>-</sup></th>
                            <th>R<sup>+</sup></th>
                            <th>R<sup>-</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td><?= max($s_nilai) ?></td>
                            <td><?= min($s_nilai) ?></td>
                            <td><?= max($r_nilai) ?></td>
                            <td><?= min($r_nilai) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
