@extends('layout.layout')
@section('content')

<!-- Tampilkan pesan error jika ada -->
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
  </ul>
</div><br />
@endif

<div class="container">
    <h2 class="text-center">Pencetakan Ticket</h2>
    <div class="card mt-3">
        <div class="card-header bg-success text-white">Pemesanan</div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-3">
                    Nama Pemesan
                </div>
                <div>
                    {{ $id_user }}
                </div>
            </div>
            <p>
                <div class="form-group row">
                    <div class="col-3">
                        Judul
                    </div>
                    <div>
                        {{ $judul }}
                    </div>
                </div>
            </p>
            <p>
                <div class="form-group row">
                    <div class="col-3">
                        Tanggal
                    </div>
                    <div>
                        {{ $tanggal }}
                    </div>
                </div>
            </p>
            <p>
                <div class="form-group row">
                    <div class="col-3">
                        Bioskop
                    </div>
                    <div>
                        {{ $bioskop }}|{{ $lokasi }}
                    </div>
                </div>
            </p>
            <p>
                <div class="form-group row">
                    <div class="col-3">
                        Jam
                    </div>
                    <div>
                        {{ $jam }}
                    </div>
                </div>
            </p>
            <p>
                <div class="form-group row">
                    <div class="col-3">
                        Kursi
                    </div>
                    <div>
                        {{-- @foreach($kursi as $seat) --}}
                        {{ $kursi }},
                    {{-- @endforeach --}}
                    </div>
                </div>
            </p>
            <p>
                <div class="form-group row">
                    <div class="col-3">
                        Harga
                    </div>
                    <div>
                        {{$totalHarga}}
                    </div>
                </div>
            </p>
            <a class="btn btn-dark btn-lg tombol" href="{{ route('cetakpdf') }}">Cetak PDF</a>
        </div>
        
    </div>
</div>
@endsection
