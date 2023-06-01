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
        <form method="post" enctype="multipart/form-data" action="{{ route('dashboard.storeprice') }}">
                @csrf
            <div class="mb-3">
              Tipe
              <input type="text" class="form-control" name="tipe" aria-describedby="tipe">
            </div>
            <div class="mb-3">
              Harga
              <input type="text" class="form-control" name="harga">
            </div>
            <input class="btn btn-primary"type="submit" name="submit">
          </form>
              
      </div>
      <!-- akhir Pembelian -->

   @endsection