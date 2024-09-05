<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryExam as ModelsCategoryExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryExam extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $categorys = ModelsCategoryExam::where('user_id',$user)->paginate(10);
        return view('admin.jenis-ujian.index', compact('categorys','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'user_id' => 'nullable|string|exists:users,id',
        ]);

        ModelsCategoryExam::create($validateData);

        return redirect()->route('CategoryExam.index')->with('success', 'Jenis Ujian Berhasil Ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'user_id' => 'nullable|string|exists:users,id',
        ]);

        $category = ModelsCategoryExam::find($id);
        $category->update($validateData);

        return redirect()->route('CategoryExam.index')->with('success', 'Jenis Ujian Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = ModelsCategoryExam::find($id);
        $category->delete();

        return redirect()->route('CategoryExam.index')->with('success', 'Jenis Ujian Berhasil Dihapus');
    }
}
