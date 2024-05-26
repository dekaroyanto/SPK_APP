<!DOCTYPE html>
<html>

<head>
    <title>PT COLUMBUS</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    p {
        text-transform: uppercase;
    }
</style>

<body>
    <p>HASIL AKHIR SELEKSI KARYAWAN BARU <br>
        PT COLUMBUS KOTA CIREBON <br>
        PERIODE @if ($hasil->isNotEmpty())
            @foreach ($hasil as $keys)
                {{ date('F Y', strtotime($keys->periode)) }}
            @break
        @endforeach
    @endif
</p>

@if ($hasil->isNotEmpty())
    <table border="1" width="100%">
        <thead>
            <tr align="center">
                <th>Nama</th>
                <th>Notelp</th>
                <th>Divisi</th>
                <th>Periode</th>
                {{-- <th>Nilai Qi</th> --}}
                <th width="15%">Ranking</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($hasil as $keys)
                <tr align="center">
                    <td align="left">{{ substr($keys->nama, 0, 2) }}****</td>
                    <td align="left"> 0{{ substr($keys->notelp, 0, 1) }}******{{ substr($keys->notelp, -3) }}</td>
                    <td align="left">{{ $keys->divisi }}</td>
                    <td align="left">{{ date('F Y', strtotime($keys->periode)) }}</td>
                    {{-- <td>{{ $keys->nilai }}</td> --}}
                    <td>{{ $no }}</td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
        </tbody>
    </table>
@else
    <p>No data available for the selected filters.</p>
@endif
<script>
    window.print();
</script>
</body>

</html>
