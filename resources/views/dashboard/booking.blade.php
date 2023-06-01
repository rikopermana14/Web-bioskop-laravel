@extends('layout.layout')
@section('content')


@if ($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
  </ul>
</div><br />
@endif


<!-- awal Pembelian -->
<div class="container-lg" style="width: 700px;">
    <h2 class="text-center">Pembelian Ticket</h2>
    <div class="card mt-3">
      <div class="card-header bg-success text-white">Pemesanan</div>
      <div class="card-body">
        <form method="post" action="/storebooking">
          @csrf
          @method('POST')
          <div class="form-group row">
            <div class="col-3">
              <label id="label" for="disabledSelect" class="form-label">Judul</label>
            </div>
            <div class="">
                @foreach ($data1 as $item)
                <input type="text" value="{{ $item->id }}" name="judul" hidden>
                <label for="">{{ $item->judul}}</label>
                @endforeach
              </select>
            </div>
          </div>
          <!-- Tanggal -->
          <div class="form-group row">
            <div class="col-3">
              <label id="label">Tanggal : </label>
  
            </div>
            <div class="">
              <input type="date" name="tanggal" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-3">
              <label id="label" for="disabledSelect" class="form-label">Jam : </label>
            </div>
            <div class="">
              <select id="disabledSelect" class="form-select" name="jam">
                <option value="13:00:00">13.00</option>
                <option value="15:00:00">15.00</option>
                <option value="18:00:00">18.00</option>
                <option value="21:00:00">21.00</option>
              </select>
            </div>
          </div>
  
          <div class="form-group row">
            <div class="col-3">
              <label id="label" for="id_bioskop">Lokasi Bioskop</label>
              <select name="id_bioskop" id="id_bioskop" class="custom-select">
                <option value="" selected disabled hidden>-- Pilih Lokasi  --</option>
                @foreach ($data2 as $row)
                  <option value="{{ $row->id }}">{{ $row->nama }} | {{ $row->lokasi }}</option>
                @endforeach
              </select>
              </div>
          </div>
          <div class="row">
            <div class="col">
              <label id="label">Pilih Kursi</label>
          
              <div id="seat-map">
                <div class="screen">Screen</div>
                
                <div class="row">
                  @foreach($seats as $seat)
                  
                    <div class="seat" id="seat-{{ $seat->id }}" data-seat="{{ $seat->seat_number }}"></div>
                  @endforeach
                </div>
              </div>
              <input type="text" id="selected-seats-input" name="kursi[]" hidden>
              <div id="selected-seats">
                <label id="label">Kursi yang Dipilih:</label>
                <ul></ul>
              </div>
            </div>
          </div>
          
          <div class="form-group row">
            <div class="col-4">
              <label id="label" for="id_bioskop">Harga Tiket</label>
                @foreach ($data as $price)                  
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="harga" id="inlineRadio1" value="{{ $price->id }}">
                    <input class="form-check-input" type="radio" name="harga1" id="inlineRadio1" value="{{ $price->harga }}"hidden>
                    <label class="form-check-label" for="inlineRadio1">{{ $price->tipe }} | {{ $price->harga }}</label>
                  </div>
                @endforeach
          </div>        
          <input class="btn btn-primary" type="submit" name="submit">
  
  
        </form>
      </div>
    </div>
    <!-- akhir Pembelian -->

    @endsection