<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use App\Models\Kategori;
use App\Models\Student;
use Illuminate\Http\Request;

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
        // Retrieve all exam answers related to the student
        $hasil = ExamAnswer::where('student_id', $siswa->id)
            ->with(['soal', 'ujian']) // Eager load related models if needed
            ->get();

        // Initialize variables for correct and incorrect answers
        $correct = 0;
        $incorrect = 0;

        // Loop through each exam answer and calculate correct/incorrect answers
        foreach ($hasil as $item) {
            if ($item->answer === $item->soal->kunci_jawaban) {
                $correct++;
            } else {
                $incorrect++;
            }
        }

        $nilai = $correct * 10;

        // Retrieve all categories
        $categories = Kategori::all();

        // Return the view with student results and categories
        return view('admin.student.detail', compact('siswa', 'hasil', 'nilai', 'categories'));
    }
}
