@extends('layout.layout')
@section('content')

<!-- About -->
<section id="about text">
    <div class="container mt-5">
        <div class="row text-center mb-3">
            <div class="col">
                <h2>Kelompok </h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center fs-5 text-left">
        <div class="col-4">
            <p>Web ini dibangun dengan rangka untuk menyelesaikan tugas akhir yang telah diberikan pada praktikum
                Interaksi Manusia Komputer dan Basis Data Lanjut.</p>
        </div>
        <div class="col-4">
            <p style="color:var(--col-main);">Kelompok ini membuat sebuah website Pemesanan Tiket Bioskop secara online.
            </p>
        </div>
    </div>
</section>
<!-- Akhir About -->

<!-- Project -->
<section id="projects ">
    <div class="container mt-4">
        <div class="row text-center">
            <div class="col">
                <h2>About Us</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4" style="height:500px">
                <div class="card p-5 h-100">
                    <img src="{{ asset('image/user.png') }}" class="card-img-top" alt="Projects1" height="200px" width="200px">
                    <div class="card-body text-center">
                        <p class="card-text">Kelompok XXI</p>
                    </div>
                </div>
            </div>
</section>

@endsection