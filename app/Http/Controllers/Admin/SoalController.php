<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestSoal;
use App\Models\Kategori;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $soals = Soal::where('user_id', $user->id)->paginate(10);

        return view('admin.soal.index', compact('soals'));
    }

    public function create()
    {
        $user = Auth::user();
        $kategori = Kategori::where('user_id', $user->id)->get();
        $user = Auth::id();
        return view('admin.soal.create', compact('kategori', 'user'));
    }

    public function store(RequestSoal $request)
    {
        // Validasi data input sesuai rules yang telah didefinisikan
        $validatedData = $request->validated();

        // Generate random 2-digit code
        $validatedData['code'] = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

        // Buat entri baru di database menggunakan data yang telah divalidasi
        Soal::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambahkan');
    }

    public function edit(Soal $soal)
    {
        $kategori = Kategori::all();
        $user = Auth::id();
        return view('admin.soal.edit', compact('soal', 'kategori', 'user'));
    }

    public function update(RequestSoal $request, Soal $soal)
    {
        // Validasi data input sesuai rules yang telah didefinisikan
        $validatedData = $request->validated();

        // Update data soal di database menggunakan data yang telah divalidasi
        $soal->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses

        return redirect()->route('soal.index')->with('success', 'Soal berhasil diubah');
    }

    public function destroy(Soal $soal)
    {
        // Hapus data soal di database
        $soal->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus');
    }

    public function togglePublish(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);
        $soal->published = $request->published;
        $soal->save();
    
        return response()->json(['message' => 'Publish status updated successfully']);
    }
    

}
