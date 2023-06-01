@extends('layout.layout')
@section('content')
    
<!-- Awal Now Playing -->
<div class="container-lg mt-5" id="nowplaying">
    <div class="row">
      <div class="col-4 pt-1 pb-1 bg-ijo text-light text-center" style="font-weight: 500; font-size: 1.2rem;">
        Now Playing
      </div>
    </div>
    
  </div>
  <br><br>
  <!-- akhir Now Playing -->
  
  <!-- Awal Film -->
  
  <div class="container">
    <table class="table table-sm jalign-middle">
      <tbody>
    @foreach ($data as $item)
    <tr class="align-left"><td><IMG SRC="{{asset('image').'/'. $item->image}}" height="200px" width="170px"><h1><br>judul : {{ $item->judul}}</h1></td>
    <td>
    director : <p> {{ $item->director}}</p>
    writer : <p>{{ $item->writer}}</p>
    cast : <p>{{ $item->cast}}</p>
    proucer : <p>{{ $item->producer}}</p>
    distributor: <p>{{ $item->distributor}}</p>
    <a class='btn btn-primary btn-sm text-center' href="{{ route('booking',Crypt::encrypt($item->id)) }}">Buy Ticket</a>
    @if (auth()->user()->role == 'Admin')
    <a class='btn btn-warning btn-sm text-center ml-1 text-light' href='{{ route('film.edit', $item->id) }}'>Edit</a>
    <a class="btn btn-danger btn-sm text-center" href="{{ route('film.hapus',$item->id) }}"
      onClick="return confirm('Are you sure to delete this data?')">Delete</a>
      @endif
  </td>
      
        
    @endforeach
  </div>
</tbody>
</table>
  
  <!-- Akhir Film -->
  @endsection