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


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold"><i class="fa fa-table"></i> Bobot Kriteria (W)</h6>
    </div>

    <div class="card-body">
		<div class="alert alert-info">
			Nilai bobot kriteria didapatkan dengan menggunakan metode ROC.
		</div>
		<div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-warning text-white">
					<tr>
						<th>Kode Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Bobot</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($kriterias as $kriteria): ?>
					<tr>
						<td><?php echo $kriteria->kode_kriteria ?></td>
						<td><?php echo $kriteria->keterangan ?></td>
						<td>
							<?php
								if($kriteria->bobot == NULL){
									echo "-";
								}else{
									echo $kriteria->bobot;
								}
							?>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Matriks Keputusan (X)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-warning text-white">
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
					<tr align="center">
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
					<tr align="center" class="bg-light">
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
					<tr align="center" class="bg-light">
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


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Normalisasi Matrix (X)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-warning text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif->nama ?></td>
						<?php
						foreach($kriterias as $kriteria):
							$id_alternatif = $alternatif->id_alternatif;
							$id_kriteria = $kriteria->id_kriteria;
							echo '<td>';
							echo $nilai_x[$id_alternatif][$id_kriteria];
							echo '</td>';
						endforeach;
						?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Normalisasi Bobot (R)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-warning text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif->nama ?></td>
						<?php
						foreach($kriterias as $kriteria):
							$id_alternatif = $alternatif->id_alternatif;
							$id_kriteria = $kriteria->id_kriteria;
							echo '<td>';
							echo $nilai_r[$id_alternatif][$id_kriteria];
							echo '</td>';
						endforeach;
						?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Nilai R</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-warning text-white">
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
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Nilai S</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-warning text-white">
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
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Nilai S dan R</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-warning text-white">
					<tr align="center">
						<th>S<sup>+</sup></th>
						<th>S<sup>-</sup></th>
						<th>R<sup>+</sup></th>
						<th>R<sup>-</sup></th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<td><?= max($s_nilai); ?></td>
						<td><?= min($s_nilai); ?></td>
						<td><?= max($r_nilai); ?></td>
						<td><?= min($r_nilai); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning"><i class="fa fa-table"></i> Nilai Qi</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-warning text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Alternatif</th>
						<th>Nilai Qi</th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php
						$no=1;
						foreach ($alternatifs as $alternatif):
						$id_alternatif = $alternatif->id_alternatif;
						?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif->nama ?></td>
						<td>
						<?php
						echo $hasil = $nilai_q[$id_alternatif];
						?>
						</td>
					</tr>
					<?php
						$no++;
						$hasil_akhir = [
							'id_alternatif' => $alternatif->id_alternatif,
							'nilai' => $hasil
						];
						DB::table('hasil')->insert($hasil_akhir);
						endforeach;
					?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
