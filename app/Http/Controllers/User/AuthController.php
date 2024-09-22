<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function regis()
    {
        return view('user.Login.registrasi');
    }

    public function StoreRegis(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'password' => 'required|string|min:8|confirmed',
            'number_phone' => 'required|string|max:15',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'class' => 'required|in:Polri,TNI',
        ]);

        // Inisialisasi path gambar
        $imagePath = null;

        // Proses unggah gambar
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('assets/FotoSiswa', 'public');
            $imagePath = $path;
        }

        // Buat record student
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number_phone' => $request->number_phone,
            'image' => $imagePath,
            'class' => $request->class,
            'role' => 'siswa',
        ]);

        // Log in the student
        Auth::login($student);

        return redirect()->route('login.siswa')->with('success', 'Berhasil Registrasi');
    }

    public function login()
    {
        return view('user.Login.login');
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);
    
        // Log the incoming request data (without logging the password for security reasons)
        Log::info('Login attempt:', ['email' => $request->email]);
    
        // Attempt to log the user in
        if (Auth::guard('student')->attempt($request->only('email', 'password'))) {
            // Log successful login
            Log::info('Login successful for email:', ['email' => $request->email]);
    
            // Redirect to the student dashboard
            return redirect('/pages/siswa');
        }
    
        // Log failed login attempt
        Log::warning('Login failed for email:', ['email' => $request->email]);
    
        // Redirect back to the login page with an error message
        return redirect()->back()->with('error', 'Email atau Password salah');
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('pages1')->with('success', 'Berhasil Logout');
    }
}
