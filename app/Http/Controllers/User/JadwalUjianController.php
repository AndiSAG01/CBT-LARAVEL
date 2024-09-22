<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use App\Models\Kategori;
use App\Models\Student;
use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the selected category ID from the request input
        $categoryId = $request->input('category_id');
        
        // Fetch the exam schedule (Ujian) and its relationship with 'kategori'
        // Ensure that only exams for the authenticated student (siswa_id) are retrieved
        $jadwal = Ujian::with('kategori') // Assuming Ujian has a relationship with kategori
            ->where('siswa_id', auth()->user()->id) // Make sure Auth() is correctly used as auth()->user()->id
            ->when($categoryId, function ($query) use ($categoryId) {
                // If a category is selected, filter by that category
                return $query->where('kategori_id', $categoryId);
            })
            ->paginate(10); // Paginate the results
        
        // Fetch the current date and time
        $waktu = Carbon::now()->format('d F Y, H:i');
        
        // Fetch all categories for the dropdown in the view
        $categories = Kategori::all(); // Adjust this according to your model (e.g., Category::all() if named differently)
        
        // Return the view with the necessary data
        return view('user.jadwalujian.index', compact('jadwal', 'waktu', 'categories'));
    }
    
    

   
    


}
