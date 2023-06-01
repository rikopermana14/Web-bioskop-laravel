<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemesanan</title>
    <style>
        /* CSS styling untuk tampilan PDF laporan pemesanan */
        /* Contoh: */
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Pemesanan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Film</th>
                <th>Bioskop</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Harga</th>
                <th>Kursi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach($pemesanan as $index)
            <tr>
                <th>{{ $no++ }}</th>
                <td>{{ $index->judul_film }}</td>
                <td>{{ $index->nama_bioskop }}</td>
                <td>{{ $index->tanggal }}</td>
                <td>{{ $index->jam }}</td>
                <td>{{ $index->id_price }}</td>
                <td>{{ $index->kursi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
