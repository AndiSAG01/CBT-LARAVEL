<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use App\Models\Soal;
use App\Models\Student;
use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{   
    public function index(Ujian $ujian)
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Fetch all questions for the given exam category to display in the navigation
        $allSoals = Soal::where('kategori_id', $ujian->kategori_id)->get();
    
        // Paginate questions to display one at a time (paginate 1 question)
        $soals = Soal::where('kategori_id', $ujian->kategori_id)
             ->where('published', true) // Only fetch published questions
             ->get();

    
        // Retrieve student's answered questions from the ExamAnswer model
        $answeredSoals = ExamAnswer::where('student_id', $user->id)
                                   ->where('ujian_id', $ujian->id)
                                   ->pluck('answer', 'soal_id');

        // Mengirimkan data ke view
        return view('user.Ujian.index', compact('ujian', 'user', 'allSoals', 'soals', 'answeredSoals'));
    }
    
    

    

    public function startExam($examId)
    {
        $siswa = Auth::user();
        ExamAnswer::firstOrCreate(
            ['student_id' => $siswa->id, 'ujian_id' => $examId],
            ['start_time' => now()]
        );


        // Redirect to the exam page with the remaining time
        return redirect()->route('exam.index', $examId);
    }

    public function storeAnswer(Request $request)
    {
        $siswa = Auth::user();
    
        // Validate the request to ensure answers is present and is an array
        $request->validate([
            'answers' => 'required|array',
            'ujian_id' => 'required|exists:ujians,id', // Ensure ujian_id exists in the ujians table
        ]);
    
        // Check if answers is an array before processing
         if (is_array($request->answers)) {
            foreach ($request->answers as $soal_id => $answer) {
               $jawaban = ExamAnswer::updateOrCreate(
                    [
                        'student_id' => $siswa->id, 
                        'ujian_id' => $request->ujian_id, 
                        'soal_id' => $soal_id
                    ],
                    [
                        'answer' => $answer, 
                        'status' => 'Selesai'
                    ]
                );
            }
        }
        if(!$jawaban){
            return redirect()->route('exam.index', $request->ujian_id)->with('error','Anda Tidak Boleh Mengkosongkan Jawbaan');
        }
    
        // Update the Ujian status to 'Selesai'
        Ujian::where('siswa_id', $siswa->id)
            ->where('id', $request->ujian_id)
            ->update(['status' => 'Selesai']);
    
        return redirect()->route('jadwal.index', ['id' => $request->ujian_id])
            ->with('success', 'Anda Telah Selesai Mengerjakan Ujian 😉');
    }
    
}
