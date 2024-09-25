<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestGuru;
use App\Http\Requests\Admin\RequestGuruUpdate;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('isAdmin', 0); // Only select users where isAdmin is 0

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('Position', 'like', "%{$search}%")
                    ->orWhere('NIK', 'like', "%{$search}%");
            });
        }

        $gurus = $query->paginate(10);

        return view('admin.guru.index', compact('gurus'));
    }


    public function store(RequestGuru $request)
    {
        // Create a new guru data array except for password and image fields
        $guruData = $request->except('password', 'image');
        $guruData['password'] = Hash::make($request->password);

        // Handle file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('assets/Fotoguru', 'public');
            $guruData['image'] = $path;
        }

        // Assign default value for isAdmin
        $guruData['isAdmin'] = 0;

        // Create the new user (Guru)
        User::create($guruData);

        return redirect()->route('guru')->with('success', 'Guru berhasil ditambahkan!');
    }


    public function edit(User $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(RequestGuruUpdate $request, User $guru)
    {
        // Update the guru
        $guruData = $request->except('password', 'image');

        if ($request->has('password')) {
            $guruData['password'] = Hash::make($request->password);
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($guru->image && file_exists(storage_path('public/' . $guru->image))) {
                Storage::delete('public/' . $guru->image);
            }

            $path = $request->file('image')->store('assets/Fotoguru', 'public');
            $guruData['image'] = $path;
        }

        $guru->update($guruData);

        return redirect()->route('guru')->with('success', 'Guru berhasil diubah!');
    }

    public function destroy(User $guru)
    {
        // Delete the guru
        if ($guru->image && file_exists(storage_path('public/' . $guru->image))) {
            Storage::delete('public/' . $guru->image);
        }

        $guru->delete();

        return redirect()->route('guru')->with('success', 'Guru berhasil dihapus!');
    }
}
