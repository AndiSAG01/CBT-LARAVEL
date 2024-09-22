<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('user.Hasil.index', compact('hasil'));
    }

    public function show($id)
    {
        $hasil = ExamAnswer::with('soal') // Load the 'soal' relationship
            ->whereHas('soal', function ($query) use ($id) {
                $query->where('kategori_id', $id);
            })->get();

        return view('user.Hasil.detail', compact('hasil'));
    }
    
    
    

}
    