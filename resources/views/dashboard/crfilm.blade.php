@extends('layout.layout')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
  </ul>
</div><br />
    @endif

    <!-- awal input -->
    <div class="container ">
        <h2 class="text-center">Input Film</h2>
        <form method="post" enctype="multipart/form-data" action="{{ isset($film) ? route('film.tambah.update', $film->id): route('dashboard.storefilm') }}">
                @csrf
            <div class="mb-3">
              Judul
              <input type="text" class="form-control" name="judul" aria-describedby="judul" value="{{ isset($film) ? $film->judul : '' }}">
            </div>
            <div class="mb-3">
              Producer
              <input type="text" class="form-control" name="producer" value="{{ isset($film) ? $film->producer : '' }}">
            </div>
            <div class="mb-3">
              Director
              <input type="text" class="form-control" name="director" value="{{ isset($film) ? $film->director : '' }}">
            </div>
            <div class="mb-3">
              Writer
              <input type="text" class="form-control" name="writer" value="{{ isset($film) ? $film->writer : '' }}">
            </div>
            <div class="mb-3">
              Cast
              <input type="text" class="form-control" name="cast" value="{{ isset($film) ? $film->cast : '' }}">
            </div>
            <div class="mb-3">
              Distributor
              <input type="text" class="form-control" name="distributor" value="{{ isset($film) ? $film->distributor : '' }}">
            </div>
            <div class="mb-3">
              Poster
              <input type="file" class="form-control" name="image" data-max-file-size="1M">
            </div>
            <input class="btn btn-primary"type="submit" name="submit">
          </form>
              
      </div>
      <!-- akhir Pembelian -->

   @endsection