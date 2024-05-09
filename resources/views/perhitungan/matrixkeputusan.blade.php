@extends('layouts.default_template')

@section('content')
<?php
\App\Models\PerhitunganModel::hapus_hasil();

//Matrix Keputusan (X)
$matriks_x = array();
foreach($alternatifs as $alternatif):
    foreach($kriterias as $kriteria):

        $id_alternatif = $alternatif->id_alternatif;
        $id_kriteria = $kriteria->id_kriteria;

        $data_pencocokan = \App\Models\PerhitunganModel::data_nilai($id_alternatif, $id_kriteria);
        if(!empty($data_pencocokan['nilai'])){$nilai = $data_pencocokan['nilai'];}else{$nilai = 0;}

        $matriks_x[$id_kriteria][$id_alternatif] = $nilai;
    endforeach;
endforeach;


//Matriks Ternormalisasi (R)
$nilai_x = array();
foreach($alternatifs as $alternatif):
	foreach($kriterias as $kriteria):
		$id_kriteria = $kriteria->id_kriteria;
		$id_alternatif = $alternatif->id_alternatif;
		$nilai = $matriks_x[$id_kriteria][$id_alternatif];

		$nilai_max = @(max($matriks_x[$id_kriteria]));
		$nilai_min = @(min($matriks_x[$id_kriteria]));

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
$nilai_r = array();
$s = array();
$n_s = array();
foreach($alternatifs as $alternatif):
	$total_r = 0;
	foreach($kriterias as $kriteria):
		$id_kriteria = $kriteria->id_kriteria;
		$id_alternatif = $alternatif->id_alternatif;
		$bobot = $kriteria->bobot;
		$nilai = $nilai_x[$id_alternatif][$id_kriteria];

		$r = $nilai*$bobot;

		$nilai_r[$id_alternatif][$id_kriteria] = $r;
		$total_r += $r;
	endforeach;
	$s[$id_alternatif] = $total_r;
	$n_s[$id_alternatif]['nilai'] = $total_r;
endforeach;

// Nilai R
$r = array();
$n_r = array();
foreach($alternatifs as $alternatif):
	$id_alternatif = $alternatif->id_alternatif;

	$nilai_max = @(max($nilai_r[$id_alternatif]));

	$r[$id_alternatif] = $nilai_max;
	$n_r[$id_alternatif]['nilai'] = $nilai_max;
endforeach;

// Max R
$r_nilai = array();
foreach($n_r as $key =>$row):
	$r_nilai[$key] = $row['nilai'];
endforeach;

// Max S
$s_nilai = array();
foreach($n_s as $key =>$row):
	$s_nilai[$key] = $row['nilai'];
endforeach;

//Nilai Qi
$nilai_q = array();
foreach($alternatifs as $alternatif):
	$id_alternatif = $alternatif->id_alternatif;

	$nil_s = $s[$id_alternatif];
	$nil_r = $r[$id_alternatif];
	$max_s = max($s_nilai);
	$min_s = min($s_nilai);
	$max_r = max($r_nilai);
	$min_r = min($r_nilai);

	$v = 0.5;
	$n1 = $nil_s-$min_s;
	$n2 = $max_s-$min_s;
	$n3 = $nil_r-$min_r;
	$n4 = $max_r-$min_r;

	$bagi1=$n1/$n2;
	$bagi2=$n3/$n4;

	$hasil1= $bagi1*$v;
	$hasil2= $bagi2*(1-$v);
	$q = $hasil1+$hasil2;
	$nilai_q[$id_alternatif] = $q;
endforeach;
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan</h1>
</div>

<ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link " id="bobot-tab" data-toggle="tab" href="{{ url('Perhitungan') }}" role="tab" aria-controls="bobot" aria-selected="true">Bobot Kriteria</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="matriks-x-tab" data-toggle="tab" href="{{ url('Perhitungan/matrixkeputusan') }}" role="tab" aria-controls="matriks-x" aria-selected="false">Matriks Keputusan (X)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="normalisasi-x-tab" data-toggle="tab" href="#normalisasi-x" role="tab" aria-controls="normalisasi-x" aria-selected="false">Normalisasi Matrix (X)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="normalisasi-r-tab" data-toggle="tab" href="#normalisasi-r" role="tab" aria-controls="normalisasi-r" aria-selected="false">Normalisasi Bobot (R)</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="nilai-r-tab" data-toggle="tab" href="#nilai-r" role="tab" aria-controls="nilai-r" aria-selected="false">Nilai R</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="nilai-s-tab" data-toggle="tab" href="#nilai-s" role="tab" aria-controls="nilai-s" aria-selected="false">Nilai S</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="s-r-tab" data-toggle="tab" href="#s-r" role="tab" aria-controls="s-r" aria-selected="false">Nilai S dan R</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="nilai-qi-tab" data-toggle="tab" href="#nilai-qi" role="tab" aria-controls="nilai-qi" aria-selected="false">Nilai Qi</a>
    </li>
</ul>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Matriks Keputusan (X)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped text-sm" id="table1">
                <thead class="text-center">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria->kode_kriteria ?></th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr>
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif->nama ?></td>
						<?php
						foreach ($kriterias as $kriteria):
							$id_alternatif = $alternatif->id_alternatif;
							$id_kriteria = $kriteria->id_kriteria;
							echo '<td>';
							echo $matriks_x[$id_kriteria][$id_alternatif];
							echo '</td>';
						endforeach;
						?>
					</tr>
					<?php
						$no++;
						endforeach;
					?>
					<tr>
						<th colspan="2">MAX</th>
						<?php foreach ($kriterias as $kriteria): ?>
						<th>
						<?php
							$id_kriteria = $kriteria->id_kriteria;
							echo max($matriks_x[$id_kriteria]);
						?>
						</th>
						<?php endforeach; ?>
					</tr>
					<tr>
						<th colspan="2">MIN</th>
						<?php foreach ($kriterias as $kriteria): ?>
						<th>
						<?php
							$id_kriteria = $kriteria->id_kriteria;
							echo min($matriks_x[$id_kriteria]);
						?>
						</th>
						<?php endforeach; ?>
					</tr>
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
                    <th width='34%'></th>
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

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-sm" id="table2">
                <thead class="text-center">
                    <tr>
                        <th>Kriteria</th>
                        <th>MAX</th>
                        <th>MIN</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($kriterias as $kriteria): ?>
                        <tr>
                            <td><?= $kriteria->kode_kriteria ?></td>
                            <td><?php echo max($matriks_x[$kriteria->id_kriteria]); ?></td>
                            <td><?php echo min($matriks_x[$kriteria->id_kriteria]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
