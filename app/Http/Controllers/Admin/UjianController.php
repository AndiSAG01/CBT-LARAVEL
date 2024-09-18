<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestUjian;
use App\Models\Kategori;
use App\Models\Student;
use App\Models\Ujian;
use Illuminate\Http\Request;
use App\Models\CategoryExam as ModelsCategoryExam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        
        // Retrieve all exams for the user
        $ujian = Ujian::where('user_id', $user)->get();
        
        // Group by category and exam time
        $groupedUjian = $ujian->groupBy(function($item) {
            return $item->kategori->name . '|' . $item->jam_ujian;
        })->map(function($group) {
            // Return a single item with aggregated data
            return [
                'kelas' => $group->first()->kelas,
                'kategori' => $group->first()->kategori->name,
                'category' => $group->first()->category->name,
                'tanggal_ujian' => $group->first()->tanggal_ujian,
                'jam_ujian' => $group->first()->jam_ujian,
                'durasi' => $group->first()->durasi,
                'id' => $group->first()->id,  // Ensure you include the ID for detail links
            ];
        });
    
        // Get current page from request
        $currentPage = Paginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $groupedUjian->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        $paginatedUjian = new LengthAwarePaginator(
            $currentItems,
            $groupedUjian->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );
    
        return view('admin.ujian.index', compact('paginatedUjian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::id();
        $siswa = Student::all();
        $kategori = Kategori::where('user_id', $user)->get();
        $jenis_ujian  = ModelsCategoryExam::where('user_id',$user)->get();
        return view('admin.ujian.create', compact('siswa', 'kategori', 'jenis_ujian','user'));
    }

    public function show($id)
{
    // Fetch the exam details by id
    $exam = Ujian::findOrFail($id);

    // Fetch students with the same exam schedule
    $ujian = Ujian::where('tanggal_ujian', $exam->tanggal_ujian)
                     ->where('jam_ujian', $exam->jam_ujian)
                     ->where('kategori_id', $exam->kategori_id)
                     ->get();
                     
    return view('admin.ujian.detail', compact('ujian'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestUjian $request)
    {
        foreach ($request->siswa_id as $siswaId) {
            Ujian::create([
                'kelas' => $request->kelas,
                'tanggal_ujian' => $request->tanggal_ujian,
                'jam_ujian' => $request->jam_ujian,
                'category_id' => $request->category_id,
                'kategori_id' => $request->kategori_id,
                'user_id' => $request->user_id,
                'siswa_id' => $siswaId,
                'durasi' => $request->durasi,
                'status' => 'Belum Dimulai'
            ]);
        }

        return redirect()->route('ujian.index')->with('success', 'Data ujian berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ujian $ujian)
    {
        $user = Auth::id();
        $siswa = Student::all();
        $kategori =  Kategori::all();
        $jenis_ujian  = ModelsCategoryExam::all();
        return view('admin.ujian.edit', compact('ujian', 'siswa', 'kategori', 'jenis_ujian','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestUjian $request, Ujian $ujian)
    {
        // Validate the incoming request data
        $validated = $request->validated();
    
        // Delete existing ujian records related to this ujian instance
        $ujian->where('kelas', $ujian->kelas)
              ->where('tanggal_ujian', $ujian->tanggal_ujian)
              ->where('jam_ujian', $ujian->jam_ujian)
              ->delete();
    
        // Re-create the ujian records for each selected siswa
        foreach ($request->siswa_id as $siswaId) {
            Ujian::create([
                'kelas' => $validated['kelas'],
                'tanggal_ujian' => $validated['tanggal_ujian'],
                'jam_ujian' => $validated['jam_ujian'],
                'category_id' => $validated['category_id'],
                'kategori_id' => $validated['kategori_id'],
                'user_id' => $validated['user_id'],
                'siswa_id' => $siswaId,
                'durasi' => $validated['durasi'],
                'status' => 'Belum Dimulai'
            ]);
        }
    
        return redirect()->route('ujian.index')->with('success', 'Data ujian berhasil diperbarui');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        return redirect()->route('ujian.index')->with('success', 'Data ujian berhasil dihapus');
    }
}
