<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id(); // Get the currently logged-in user
        $kategori = Kategori::where('user_id', $user)->paginate(10); // Assuming 'user_id' is the foreign key in the 'kategori' table that associates it with a user
        return view('admin.kategori.index', compact('kategori','user'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'user_id' => 'nullable|string|exists:users,id',
        ]);

        Kategori::create($validateData);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return response()->json($kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'nullable|string|exists:users,id',
        ]);
    
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
    
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
