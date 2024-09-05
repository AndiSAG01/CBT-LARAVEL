<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function profil($id)
    {
        $siswa = Student::find($id);
        return view('user.Profil.index', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Student::find($id);
        return view('user.Profil.edit', compact('siswa'));
    }
    public function UpdateProfil(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'number_phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'class' => 'required|in:Polri,TNI',
        ]);

        // If a new image is uploaded, handle the upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets/FotoSiswa', 'public');
        } else {
            $imagePath = $student->image; // Use existing image if no new one is uploaded
        }

        // Update the student's profile
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
            'image' => $imagePath,
            'class' => $request->class,
        ]);

        return redirect()->route('profil.index', ['id' => $student->id])->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $siswa = Auth::user();

        // Validasi password baru
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Update password yang baru
        $siswa->password = Hash::make($request->new_password);
        $siswa->save();

        return redirect()->route('profil.index', ['id' => $siswa->id])->with('success', 'Password berhasil diperbarui');
    }
}
