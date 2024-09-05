<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
       $quary = Student::query();
       if ($search  = $request->input('search')) {
        $quary->where('name','like',"%{$search}")
        ->orWhere('email','like',"%{$search}");
       }

       $siswa = $quary->paginate(10);
       return view('admin.student.index',compact('siswa'));
    }

    public function detail(Student $siswa)
    {
        return view('admin.student.detail', compact('siswa'));
    }
}
