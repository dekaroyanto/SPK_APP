<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pendukung Keputusan Metode ROC VIKOR</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
</style>
<body>
<h4>Hasil Akhir Perankingan</h4>
<table border="1" width="100%">
	<thead>
		<tr align="center">
			<th>Alternatif</th>
			<th>Nilai Qi</th>
			<th width="15%">Ranking</th>
		</tr>
	</thead>
	<tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($hasil as $keys)
        <tr align="center">
            <td align="left">{{ $keys->nama }}</td>
            <td>{{ $keys->nilai }}</td>
            <td>{{ $no }}</td>
        </tr>
        @php
            $no++;
        @endphp
        @endforeach
    </tbody>
</table>
<script>
	window.print();
</script>
</body>
</html>