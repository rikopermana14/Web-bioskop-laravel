<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS styling untuk tampilan PDF */
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
    <h1>Detail Pemesanan</h1>

    <table>
        <tr>
            <th>Nama Pemesan</th>
            <td>{{ $id_user }}</td>
        </tr>
        <tr>
            <th>Judul Film</th>
            <td>{{ $judul }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $tanggal }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>{{ $price }}</td>
        </tr>
        <tr>
            <th>Bioskop</th>
            <td>{{ $bioskop }}</td>
        </tr>
        <tr>
            <th>Kursi</th>
            <td>{{ $kursi }}</td>
        </tr>
        <tr>
            <th>Jam</th>
            <td>{{ $jam }}</td>
        </tr>
    </table>
</body>
</html>
