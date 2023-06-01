<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
	public function register()
	{
		return view('auth/register');
	}

	public function registerSimpan(Request $request)
	{
		Validator::make($request->all(), [
			'nama' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed|min:8'
		])->validate();

		User::create([
			'name' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'User',
        'email_verified_at' => now(), // Menyimpan nilai email_verified_at saat registrasi
        'remember_token' => Str::random(10),
		]);

		return redirect()->route('login');
	}

	public function login()
	{
		return view('auth/login');
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
}
