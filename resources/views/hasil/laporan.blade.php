<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT Columbus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    {{-- <p>HASIL AKHIR SELEKSI KARYAWAN BARU <br>
        PT COLUMBUS KOTA CIREBON <br>
        PERIODE @if ($hasil->isNotEmpty())
            @foreach ($hasil as $keys)
                {{ date('F Y', strtotime($keys->periode)) }}
            @break
        @endforeach
    @endif
    </p> --}}

    <div class="row mb-2">
        <div class="col-8">
            <p class="ms-5">HASIL AKHIR SELEKSI KARYAWAN BARU <br>
                PT COLUMBUS KOTA CIREBON <br>
                {{-- PERIODE @if ($hasil->isNotEmpty())
                    @foreach ($hasil as $keys)
                        {{ date('F Y', strtotime($keys->periode)) }}
                    @break
                @endforeach
            @endif --}}
            </p>
        </div>
        <div class="col-4"><img class="img-thumbnail" src="{{ asset('loginform/img/bwlogo.jpg') }}" alt="easyclass" />
        </div>
    </div>


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
                    <th width="15%">Keterangan</th>
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
                        <td>
                            @if ($keys->diterima !== null)
                                {{ $no <= $keys->diterima ? 'LULUS' : 'GAGAL' }}
                            @else
                                -
                            @endif
                        </td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
