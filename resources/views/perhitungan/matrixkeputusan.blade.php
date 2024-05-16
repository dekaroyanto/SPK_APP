@extends('layouts.default_template')

@section('css')
    {{-- <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"> --}}
    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
@endsection

@section('jsbro')
    <script>
        function myFunction() {
            var x = document.getElementById("demo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
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
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // Tambahkan baris ini
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

    {{-- <div class="card shadow mb-4">
        <div class="w3-bar">
            <a class="w3-bar-item disabled">Menu</a>
            <a href="{{ url('Perhitungan') }}" class="w3-bar-item w3-button w3-hide-small">Bobot Kriteria</a>
            <a href="{{ url('Perhitungan/matrixkeputusan') }}" class="w3-bar-item w3-button w3-hide-small">Matriks Keputusan
                (X)</a>
            <a href="{{ url('Perhitungan/normalisasi') }}" class="w3-bar-item w3-button w3-hide-small">Normalisasi Matrix
                (X)</a>
            <a href="{{ url('Perhitungan/normalisasibobot') }}" class="w3-bar-item w3-button w3-hide-small">Normalisasi
                Bobot (R)</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small">Nilai R</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small">Nilai s</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small">Nilai S dan R</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small">Nilai Qi</a>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
                onclick="myFunction()">&#9776;</a>
        </div>

        <div id="demo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium">
            <a href="{{ url('Perhitungan') }}" class="w3-bar-item w3-button">Bobot Kriteria</a>
            <a href="{{ url('Perhitungan/matrixkeputusan') }}" class="w3-bar-item w3-button">Matriks Keputusan (X)</a>
            <a href="#" class="w3-bar-item w3-button">Link 3</a>
        </div>
    </div> --}}

    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Matriks Keputusan (X)</h6>

            <form action="{{ url('Perhitungan/matrixkeputusan') }}" method="GET">
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
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-sm" id="table1">
                    <thead class="text-center">
                        <tr align="center">
                            <th width="5%" rowspan="2">No</th>
                            <th width="10%">Nama</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Periode</th>
                            <?php foreach ($kriterias as $kriteria): ?>
                            <th class="text-center" width="10%"><?= $kriteria->kode_kriteria ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td class="text-left">{{ substr($alternatif->nama, 0, 2) }}****</td>
                            <td class="text-center"><?= $alternatif->divisi ?></td>
                            <td class="text-center">{{ date('F Y', strtotime($alternatif->periode)) }}</td>
                            <?php
                            foreach ($kriterias as $kriteria):
                                $id_alternatif = $alternatif->id_alternatif;
                                $id_kriteria = $kriteria->id_kriteria;
                                echo '<td class="text-center">';
                                echo $matriks_x[$id_kriteria][$id_alternatif];
                                echo '</td>';
                            endforeach;
                            ?>
                        </tr>
                        <?php
						$no++;
						endforeach;
					?>
                        {{-- <tr>
                            <th colspan="4">MAX</th>
                            <?php foreach ($kriterias as $kriteria): ?>
                            <th class="text-center">
                                <?php
                                $id_kriteria = $kriteria->id_kriteria;
                                echo max($matriks_x[$id_kriteria]);
                                ?>
                            </th>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th colspan="4">MIN</th>
                            <?php foreach ($kriterias as $kriteria): ?>
                            <th class="text-center">
                                <?php
                                $id_kriteria = $kriteria->id_kriteria;
                                echo min($matriks_x[$id_kriteria]);
                                ?>
                            </th>
                            <?php endforeach; ?>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabel MAX dan MIN -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-sm" id="table1">
                    <thead class="text-center">
                        <tr>
                            <th width='50%%'></th>
                            <?php foreach ($kriterias as $kriteria): ?>
                            <th><?= $kriteria->kode_kriteria ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>MAX</th>
                            <?php foreach ($kriterias as $kriteria): ?>
                            <td align="center"><?php echo max($matriks_x[$kriteria->id_kriteria]); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>MIN</th>
                            <?php foreach ($kriterias as $kriteria): ?>
                            <td align="center"><?php echo min($matriks_x[$kriteria->id_kriteria]); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
