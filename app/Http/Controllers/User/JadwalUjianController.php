<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ExamAnswer;
use App\Models\Student;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $jadwal = Ujian::where('siswa_id',Auth()->user()->id)->paginate(10);    
        return view('user.jadwalujian.index', compact('jadwal'));
    }

   
    


}
