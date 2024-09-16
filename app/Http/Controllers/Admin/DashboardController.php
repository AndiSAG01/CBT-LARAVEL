<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use App\Models\Guru;
use App\Models\Student;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Barryvdh\DomPDF\Facade\Pdf;  // <-- This is important!
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected year, or default to the current year
        $selectedYear = $request->input('year', Carbon::now()->year);

        // Get the count of students for each month of the selected year
        $studentsPerMonth = Student::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $selectedYear)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Prepare data for all 12 months
        $months = collect(range(1, 12))->map(function ($month) use ($studentsPerMonth) {
            return $studentsPerMonth[$month] ?? 0;
        });

        // Generate the chart
        $chart = (new LarapexChart)->barChart()
            ->setTitle('Siswa/Siswi PerBulan')
            ->setSubtitle('Year: ' . $selectedYear)
            ->addData('Students', $months->toArray())
            ->setXAxis([
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ]);

        // Get a list of years for the dropdown (e.g., last 10 years)
        $years = range(Carbon::now()->year, Carbon::now()->year - 10);
        $guru = Guru::count();
        $siswa = Student::count();
        return view('admin.dashboard', compact('chart', 'selectedYear', 'years', 'guru', 'siswa'));
    }

    public function hasil(Request $request)
    {
        // Mendapatkan input pencarian dari request
        $search = $request->input('search');
    
        // Mengambil data jawaban ujian dengan relasi student, ujian, dan soal
        $hasil = ExamAnswer::with(['student', 'ujian', 'soal'])
            ->where('status', 'Selesai')
            ->when($search, function ($query) use ($search) {
                // Filter berdasarkan nama siswa
                $query->whereHas('student', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->get()
            ->groupBy(function ($item) {
                return $item->ujian->jam_ujian; // Mengelompokkan berdasarkan jam ujian
            });
    
        // Paginasi manual pada Collection
        $currentPage = $request->input('page', 1);
        $perPage = 10;
        $paginatedHasil = $hasil->forPage($currentPage, $perPage);
    
        // Membuat LengthAwarePaginator manual
        $hasil = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedHasil,
            $hasil->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        // Mengirim hasil ke view admin
        return view('admin.hasilujian.hasil', compact('hasil'));
    }
    

    public function cetaksemua(Request $request)
    {
        // Mendapatkan input pencarian dari request
        $search = $request->input('search');
    
        // Mengambil data jawaban ujian dengan relasi student, ujian, dan soal
        $hasil = ExamAnswer::with(['student', 'ujian', 'soal'])
            ->where('status', 'Selesai')
            ->when($search, function ($query) use ($search) {
                // Filter berdasarkan nama siswa
                $query->whereHas('student', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->get()
            ->groupBy(function ($item) {
                // Mengelompokkan berdasarkan jam ujian
                return $item->ujian->jam_ujian;
            });
    
        // Membuat PDF dengan data yang sudah dikelompokkan
        $pdf = Pdf::loadView('admin.hasilujian.cetaksemua', [
            'hasil' => $hasil,
            'school_name' => 'Bimbel',
            'school_address' => 'Jl. Sekuduk no.04',
            'report_date' => now()->format('d/m/Y H:i:s'),
            'report_title' => 'Laporan Hasil Ujian'
        ]);
    
        // Menghasilkan file PDF dan menampilkannya
        return $pdf->stream('laporan-hasil-ujian.pdf');
    }
    

    
    public function pages1()
    {
        return view('home');
    }

    public function contoh()
    {
        return view('admin.contoh');
    }
}
