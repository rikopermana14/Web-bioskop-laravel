@extends('layout.layout')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
<br>
@endif

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

<div class="container">
    <h1>Laporan Pemesanan</h1>
    <form action="/laporan" method="GET">
        <div class="form-group">
            <label for="tanggal">Pilih Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Cek Laporan</button>
        @if(isset($pemesanan) && !$pemesanan->isEmpty())
        <a href="/cetak-pdf?tanggal={{ $pemesanan[0]->tanggal }}" class="btn btn-secondary">Cetak PDF</a>
    @endif
    </form>

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
            @php($no = 1)
            @foreach($pemesanan as $index )
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
</div>

@endsection