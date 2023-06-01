<?php

namespace App\Http\Controllers;

use App\Models\Bioskop;
use App\Models\Booking;
use App\Models\Dashboard;
use App\Models\Film;
use App\Models\Price;
use App\Models\User;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use PDF;

class DashboardController extends Controller
{
    public function generatePDF($id_user, $judul, $tanggal, $price, $bioskop, $kursi, $jam)
{
    $data = [
        'id_user' => $id_user,
        'judul' => $judul,
        'tanggal' => $tanggal,
        'price' => $price,
        'bioskop' => $bioskop,
        'kursi' => $kursi,
        'jam' => $jam,
    ];

    $pdf = new Dompdf();
    $pdf->loadHtml(View::make('dashboard/cetak_pdf', $data));
    $pdf->setPaper('A4', 'portrait');

    $pdf->render();

    $pdf->stream('cetak.pdf', ['Attachment' => false]);
}
    public function register()
    {
        return view('dashboard.auth.register');
    }

    public function registerSimpan(Request $request)
{
    
    $nama=$request->nama;
    
    // dd($nama);
    User::create([
        'name' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'User',
        'email_verified_at' => now(), // Menyimpan nilai email_verified_at saat registrasi
        'remember_token' => Str::random(10), // Menyimpan remember_token saat registrasi
    ]);

    return redirect('/');
}

    public function login()
    {
        return view('dashboard/auth/login');
    }

    public function loginAksi(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('index');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Film::all();
        $user = Auth::user();

if ($user !== null) {
    $users = $user->name;
} else {
    $users = "-";
}

        return view('dashboard.index', compact('data','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/crfilm');
    }

    public function menu()
    {
        return view('dashboard/menu');
    }

    public function bioskop()
    {
        return view('dashboard/bioskop');
    }

    public function price()
    {
        return view('dashboard/price');
    }

    public function cetak()
    {
        return view('dashboard/cetak');
    }

    public function aboutus()
    {
        return view('dashboard/aboutus');
    }

    public function booking($id)
    {
        $data1 = Film::where('id',Crypt::decrypt($id))->get();
        $data2 = Bioskop::all();
        $data = Price::all();
        $seats = Seat::all();
        return view('dashboard/booking', compact('data1', 'data2', 'data','seats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storebioskop(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'lokasi' => 'required',
        ]);
        Bioskop::create([
            'nama' => $request->get('nama'),
            'lokasi' => $request->get('lokasi'),
        ]);

        return redirect()->route('bioskop');with('success', 'Add Data Success');
    }

    
    public function storebooking(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required',
            'id_bioskop'=> 'required',
            'kursi'=> 'required',
            'jam'=> 'required',
            'harga'=> 'required',
        ]);
        $kursi= implode(', ', $request->get('kursi'));
        $user = Auth::User()->id;
    

        Booking::create([
            'id_user'=>$user,
            'id_film' => $request->get('judul'),
            'tanggal' => $request->get('tanggal'),
            'jam' => $request->get('jam'),
            'id_bioskop' => $request->get('id_bioskop'),
            'kursi' => $kursi,
            'id_price' => $request->get('harga'),
        ]);

        
        $getbooking = Booking::join('tb_film', 'tb_booking.id_film', '=', 'tb_film.id')
        ->join('bioskops', 'tb_booking.id_bioskop', '=', 'bioskops.id')
        ->join('tb_price', 'tb_booking.id_price', '=', 'tb_price.id')
        ->join('users', 'tb_booking.id_user', '=', 'users.id')
        ->select('tb_booking.*', 'tb_film.judul as judul_film','users.name as id_user', 'bioskops.nama as nama_bioskop','bioskops.lokasi as lokasi_bioskop','tb_price.harga as id_price',)
        ->where('tb_booking.id_user', $user)
        ->latest('tb_booking.id')
        ->first();
    
        $kursiArray = explode(', ', $getbooking->kursi);
$jumlahKursi = count($kursiArray);

    $id_user = $getbooking->id_user;
    $judul = $getbooking->judul_film;
    $bioskop = $getbooking->nama_bioskop;
    $price =  $getbooking->id_price;
    $tanggal = $getbooking->tanggal;
    $kursi = $getbooking->kursi;
    $lokasi = $getbooking->lokasi_bioskop;
    $jam = $getbooking->jam;
    $totalHarga = $jumlahKursi * $price;

    
    return view('dashboard/cetak', compact('id_user', 'judul', 'tanggal', 'price', 'tanggal', 'bioskop', 'kursi', 'jam','lokasi','totalHarga'));
    }
    public function cetakpdf(Request $request)
    {
        $user = Auth::User()->id;
        
        $getbooking = Booking::join('tb_film', 'tb_booking.id_film', '=', 'tb_film.id')
        ->join('bioskops', 'tb_booking.id_bioskop', '=', 'bioskops.id')
        ->join('tb_price', 'tb_booking.id_price', '=', 'tb_price.id')
        ->join('users', 'tb_booking.id_user', '=', 'users.id')
        ->select('tb_booking.*', 'tb_film.judul as judul_film','users.name as id_user', 'bioskops.nama as nama_bioskop','bioskops.lokasi as lokasi_bioskop','tb_price.harga as id_price',)
        ->where('tb_booking.id_user', $user)
        ->latest('tb_booking.id')
        ->first();
    
        $kursiArray = explode(', ', $getbooking->kursi);
        $jumlahKursi = count($kursiArray);

    $id_user = $getbooking->id_user;
    $judul = $getbooking->judul_film;
    $bioskop = $getbooking->nama_bioskop;
    $price =  $getbooking->id_price;
    $tanggal = $getbooking->tanggal;
    $kursi = $getbooking->kursi;
    $lokasi = $getbooking->lokasi_bioskop;
    $jam = $getbooking->jam;
    $totalHarga = $jumlahKursi * $price;

    $this->generatePDF($id_user, $judul, $tanggal, $totalHarga, $bioskop, $kursi, $jam);
    
    return view('dashboard/cetak', compact('id_user', 'judul', 'tanggal', 'price', 'tanggal', 'bioskop', 'kursi', 'jam','lokasi','totalHarga'));
    }

    public function storeprice(Request $request)
    {
        Price::create([
            'tipe' => $request->tipe,
            'harga'=>$request->harga,
    ]);

		return redirect()->route('price');
    }

    public function storefilm(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'producer' => 'required',
            'director' => 'required',
            'writer' => 'required',
            'cast' => 'required',
            'distributor' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($files = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        }

        Film::create([
            'judul' => $request->get('judul'),
            'producer' => $request->get('producer'),
            'director' => $request->get('director'),
            'writer' => $request->get('writer'),
            'cast' => $request->get('cast'),
            'distributor' => $request->get('distributor'),
            'image' => $profileImage,
        ]);

        return redirect()->route('inputfilm');with('success', 'Add Data Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $film = Film::find($id);
        return view('dashboard.crfilm', ['film' => $film]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required',
            'producer' => 'required',
            'director' => 'required',
            'writer' => 'required',
            'cast' => 'required',
            'distributor' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $id = $request->id; 

       $film = Film::find($id);

    $data = [
        'judul' => $request->judul,
        'producer' => $request->producer,
        'director' => $request->director,
        'writer' => $request->writer,
        'cast' => $request->cast,
        'distributor' => $request->distributor,
    ];

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $destinationPath = public_path('image');

        // Hapus gambar lama jika ada
        if ($film->image) {
            $gambarPath = $destinationPath . '/' . $film->image;
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        // Pindahkan gambar baru ke direktori penyimpanan
        $gambarNama = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath, $gambarNama);

        $data['image'] = $gambarNama;
    }

    $film->update($data);

    return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $film = Film::find($id);

    // Hapus gambar jika ada
    $gambarPath = public_path('image');
    $gambarFile = $gambarPath . '/' . $film->image;

    if (file_exists($gambarFile)) {
        // Hapus file gambar
        unlink($gambarFile);
    }

    // Hapus data film
    $film->delete();

    return redirect()->route('index');
}

public function generateReport(Request $request)
{
    $tanggal = $request->input('tanggal');

    $pemesanan = Booking::join('tb_film', 'tb_booking.id_film', '=', 'tb_film.id')
        ->join('bioskops', 'tb_booking.id_bioskop', '=', 'bioskops.id')
        ->join('tb_price', 'tb_booking.id_price', '=', 'tb_price.id')
        ->join('users', 'tb_booking.id_user', '=', 'users.id')
        ->select('tb_booking.*', 'tb_film.judul as judul_film', 'bioskops.nama as nama_bioskop', 'tb_price.harga as id_price', 'users.name as nama_user', 'users.email')
        ->when($tanggal, function ($query, $tanggal) {
            return $query->whereDate('tb_booking.tanggal', $tanggal);
        })
        ->latest('tb_booking.id')
        ->get();

    // Generate PDF using the retrieved data
    $html = view('dashboard.laporan_pdf', compact('pemesanan'))->render();

    $dompdf = new Dompdf();

    // Load HTML into the PDF
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Set the PDF download filename
    $filename = 'laporan-pemesanan-' . date('YmdHis') . '.pdf';

    // Download the PDF file
    $dompdf->stream($filename);
}

public function laporan(Request $request)
    {

        $tanggal = $request->input('tanggal');

        $pemesanan = Booking::join('tb_film', 'tb_booking.id_film', '=', 'tb_film.id')
            ->join('bioskops', 'tb_booking.id_bioskop', '=', 'bioskops.id')
            ->join('tb_price', 'tb_booking.id_price', '=', 'tb_price.id')
            ->join('users', 'tb_booking.id_user', '=', 'users.id')
            ->select('tb_booking.*', 'tb_film.judul as judul_film', 'bioskops.nama as nama_bioskop', 'tb_price.harga as id_price', 'users.name as nama_user', 'users.email')
            ->when($tanggal, function ($query, $tanggal) {
                return $query->whereDate('tb_booking.tanggal', $tanggal);
            })
            ->latest('tb_booking.id')
            ->get();


        return view('dashboard/laporan', compact('pemesanan'));
    }

}
