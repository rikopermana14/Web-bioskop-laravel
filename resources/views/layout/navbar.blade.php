
  <!-- AWAL Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top" id="mainnav">
    <div class="container-fluid">
      <a class="navbar-brand"><img src="{{ asset('image/kel1.png') }}" alt="Nama Gambar" height="40" width="100px"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link"> 
              Hallo 
              @if(Auth::user() == null)
              Please Login
              @else
              {{ Auth::user()->name }}
@endif</a>
         
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}"><i class="bi bi-film"></i> Now Playing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('aboutus') }}"><i class="bi bi-person-circle"></i> About Us</a>
          </li>
          @if (auth()->user()->role == 'Admin')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('menu') }}"><i class="bi bi-list"></i> Menu</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan') }}"><i class="bi bi-book"></i> Laporan Pemesanan</a>
          </li>
          @endif
          <small hidden>{{ auth()->user()->role }}</small>
          <li class="nav-item">
            <a class="btn btn-dark btn-lg tombol" href="{{ route('logout') }}">Logout</a>
          </li>

          
        </ul>
      </div>
    </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->