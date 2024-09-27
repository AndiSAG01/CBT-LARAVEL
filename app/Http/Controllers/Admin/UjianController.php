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
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::id();
        $search = $request->input('search');
        // Group by category and exam time (jam_ujian), and count the number of exams
        $ujian = Ujian::where('user_id', $user)
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('tanggal_ujian', 'like', "%{$search}%");
            });
        })
        ->select( 'kategori_id', 'category_id', 'jam_ujian', 'tanggal_ujian', 'kelas', 'durasi', DB::raw('COUNT(*) as student_count'))
        ->groupBy( 'kategori_id', 'category_id', 'jam_ujian', 'tanggal_ujian', 'kelas', 'durasi') // Add 'id' to the groupBy clause
        ->paginate(10);
    

        return view('admin.ujian.index', compact('ujian'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::id();
        $siswa = Student::all();
        $kategori = Kategori::where('user_id', $user)->get();
        $jenis_ujian  = ModelsCategoryExam::where('user_id', $user)->get();
        return view('admin.ujian.create', compact('siswa', 'kategori', 'jenis_ujian', 'user'));
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

    public function show($kategori_id, $jam_ujian)
    {
        // Find all students with the same category and exam time
        $students = Ujian::where('kategori_id', $kategori_id)
            ->where('jam_ujian', $jam_ujian)
            ->paginate(10);

        return view('admin.ujian.detail', compact('students'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kategori_id, $jam_ujian)
    {
        // Retrieve the ujian record using kategori_id and jam_ujian
        $ujian = Ujian::where('kategori_id', $kategori_id)
                      ->where('jam_ujian', $jam_ujian)
                      ->firstOrFail(); // Retrieve the first record or fail
    
        $user = Auth::id();
        $siswa = Student::all();
        $kategori = Kategori::all();
        $jenis_ujian = ModelsCategoryExam::all();
    
        return view('admin.ujian.edit', compact('ujian', 'siswa', 'kategori', 'jenis_ujian', 'user'));
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

    public function getSiswaByClass(Request $request)
    {
        $kelas = $request->input('kelas');
        // Fetch students based on the selected class
        $siswa = Student::where('class', $kelas)->get();
        return response()->json($siswa);
    }
}
