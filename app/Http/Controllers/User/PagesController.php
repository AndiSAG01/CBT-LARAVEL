<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }

    public function hasil()
    {
        // Mengambil data jawaban siswa dengan relasi ujian dan soal
        $hasil = ExamAnswer::with(['ujian', 'soal'])
            ->where('student_id', auth()->id())
            ->where('status', 'Selesai')
            ->get()
            ->groupBy(function ($item) {
                return $item->ujian->jam_ujian; // Mengelompokkan berdasarkan jam ujian
            });

        // Mengubah hasil ke bentuk paginasi manual
        $currentPage = request()->get('page', 1); // Mendapatkan halaman saat ini
        $perPage = 10; // Jumlah item per halaman
        $paginatedHasil = $hasil->forPage($currentPage, $perPage); // Mengambil item sesuai halaman

        // Membuat LengthAwarePaginator manual
        $hasil = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedHasil,
            $hasil->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $total = Soal::select('kategori_id', DB::raw('count(*) as total_soal'))
        ->groupBy('kategori_id')
        ->pluck('total_soal', 'kategori_id');

        return view('user.Hasil.index', compact('hasil','total'));
    }

    public function show($ujianId, $kategoriId)
    {
        // Load the 'soal' relationship and filter by both exam (ujianId) and category (kategoriId)
        $hasil = ExamAnswer::with('soal')
            ->whereHas('soal', function ($query) use ($ujianId, $kategoriId) {
                $query->where('kategori_id', $kategoriId) // Filter by category
                      ->where('ujian_id', $ujianId); // Filter by specific exam (ujian_id)
            })
            ->get();
    
        return view('user.Hasil.detail', compact('hasil'));
    }
    
    
    
    

}
    