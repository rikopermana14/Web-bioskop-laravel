<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
  <!-- Import Icons Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

  <title>Now Playing</title>
</head>

<body>
  @include('layout.navbar')

  @yield('content')
  <br><br>
  @include('layout.footer')
   <!-- Import JS -->
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
  </script>
  <script>
    document.getElementById('bayar').addEventListener('keyup', function (e) {
      let amount = this.value.replace(/\./g, ''); // Menghapus titik yang sudah ada
      this.value = formatNumber(amount); // Menambahkan titik pada angka
  
      // Fungsi untuk menambahkan titik pada angka
      function formatNumber(amount) {
        let formatter = new Intl.NumberFormat('id-ID');
        return formatter.format(amount);
      }
    });
  </script>

<script>
  $(document).ready(function () {
    // Array untuk menyimpan kursi yang dipilih
    var selectedSeats = [];

    // Mengambil elemen kursi
    var seats = document.getElementsByClassName('seat');

    // Event listener saat klik pada kursi
    Array.from(seats).forEach(function (seat) {
        seat.addEventListener('click', function () {
            // Mengubah status kursi (dipilih/tidak dipilih)
            this.classList.toggle('selected');

            // Mengambil ID kursi
            var seatId = this.getAttribute('data-seat');

            // Menambah atau menghapus kursi dari array selectedSeats
            if (selectedSeats.includes(seatId)) {
                selectedSeats = selectedSeats.filter(function (selectedSeat) {
                    return selectedSeat !== seatId;
                });
            } else {
                selectedSeats.push(seatId);
            }

            // Memperbarui tampilan kursi yang dipilih
            var selectedSeatsList = document.querySelector('#selected-seats ul');
            selectedSeatsList.innerHTML = '';
            selectedSeats.forEach(function (selectedSeat) {
                var li = document.createElement('li');
                li.textContent = selectedSeat;
                selectedSeatsList.appendChild(li);

                // Set the value of the input field to the selected seats
                var selectedSeatsInput = document.getElementById('selected-seats-input');
                selectedSeatsInput.value = selectedSeats.join(', ');
            });
        });
    });

    // Event listener saat klik tombol Pesan
    document.getElementById('btn-book').addEventListener('click', function () {
        // Kirim data kursi yang dipilih ke server
        console.log(selectedSeats);
        // ... lakukan tindakan selanjutnya, seperti mengirim data ke backend
    });
});
</script>

  
  
</body>

</html>