<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use App\Models\Kategori;
use App\Models\Soal;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $quary = Student::query();
        if ($search  = $request->input('search')) {
            $quary->where('name', 'like', "%{$search}")
                ->orWhere('email', 'like', "%{$search}");
        }

        $siswa = $quary->paginate(10);
        return view('admin.student.index', compact('siswa'));
    }

    public function detail(Student $siswa)
    {
        // Get the selected category from the request (category_id instead of kategori)
        $selectedCategoryId = request('category_id');

        // Query to get the exam answers for the specific student
        $query = ExamAnswer::with(['ujian', 'soal.kategori']) // Eager load necessary relationships
            ->where('student_id', $siswa->id) // Use $siswa->id to target the correct student
            ->where('status', 'Selesai');

        // If a category is selected, filter by the selected category
        if ($selectedCategoryId) {
            $query->whereHas('soal', function ($q) use ($selectedCategoryId) {
                $q->where('kategori_id', $selectedCategoryId);
            });
        }

        // Get the exam results and group by exam time
        $hasil = $query->get()->groupBy(function ($item) {
            return $item->ujian->jam_ujian; // Group by exam time
        });

        // Implement manual pagination
        $currentPage = request()->get('page', 1); // Get the current page from the request
        $perPage = 10; // Items per page
        $paginatedHasil = $hasil->forPage($currentPage, $perPage); // Paginate the results

        // Create a LengthAwarePaginator instance for paginated data
        $hasil = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedHasil,
            $hasil->count(), // Total count of items
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()] // Maintain query parameters
        );

        // Get the total number of questions per category
        $total = Soal::select('kategori_id', DB::raw('count(*) as total_soal'))
            ->groupBy('kategori_id')
            ->pluck('total_soal', 'kategori_id');

        // Fetch all available categories
        $kategori = Kategori::all();

        // Return the view with the filtered data, total questions, student, and categories
        return view('admin.student.detail', compact('hasil', 'total', 'siswa', 'kategori'));
    }

    public function laporan(Request $request)
    {
        $quary = Student::query();
        if ($search  = $request->input('search')) {
            $quary->where('name', 'like', "%{$search}")
                ->orWhere('email', 'like', "%{$search}");
        }

        $siswa = $quary->paginate(10);

        return view('admin.student.laporan', compact('siswa'));
    }

    public function cetakLaporan(Request $request)
    {
        $search = $request->input('search');
        $query = Student::query();

        // Filter students based on search input (name or email)
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $siswa = $query->get(); // Get all matching students without pagination for the PDF report

        // Generate PDF with the filtered student data
        $pdf = Pdf::loadView('admin.student.cetaklaporan', [
            'siswa' => $siswa,
            'school_name' => 'Bimbel',
            'school_address' => 'Jl. Sekuduk no.04',
            'report_date' => now()->format('d/m/Y H:i:s'),
            'report_title' => 'Laporan Data Siswa'
        ]);

        // Stream the generated PDF file for download or display
        return $pdf->stream('laporan-data-siswa.pdf');
    }
}
