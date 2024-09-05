<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PengajarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('Guru.page.index',compact('user'));
    }
    public function regisguru()
    {
        return view('Guru.Login.regis');
    }
    public function loginguru()
    {
        return view('Guru.Login.index');
    }

    public function storeLoginguru(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        Log::info('Login attempt:', ['email' => $request->email]);

        if (Auth::guard('guru')->attempt($request->only('email', 'password'))) {
            Log::info('Login successful for email:', ['email' => $request->email]);
            return redirect()->route('Pengajar.index');
        }

        Log::warning('Login failed for email:', ['email' => $request->email]);
        return redirect()->back()->with('error', 'Email or Password is incorrect.');
    }
}
