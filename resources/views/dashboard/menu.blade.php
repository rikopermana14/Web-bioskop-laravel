@extends('layout.layout')
@section('content')


<!-- Awal Now Playing -->
<div class="container-lg mt-5" id="nowplaying">
    <div class="row">
      <div class="col-4 pt-1 pb-1 bg-success text-white text-center" style="font-weight: 500; font-size: 1.2rem;">
        Menu
      </div>
    </div>
  </div>
  <br><br>
  <!-- akhir Now Playing -->
<div class="container">
<div class="container overflow-hidden text-center">
    <div class="row gy-3">
      <div class="col-6">
        <a class='btn btn-primary btn-lg text-center' href="{{ route('inputfilm') }}">Input Film</a>
      </div>
      <div class="col-6">
        <a class='btn bg-success p-2 text-dark bg-opacity-50 btn-primary btn-lg text-center' href="{{ route('bioskop') }}">Input Lokasi Bioskop</a>
      </div>
      <div class="col-6">
        <a class='btn bg-danger p-2 text-dark bg-opacity-75 btn-primary btn-lg text-center' href="{{ route('price') }}">Input Harga</a>
      </div>
    </div>
  </div>
  </div>

  @endsection