<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestUjian extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kelas' => 'required|string',
            'tanggal_ujian' => 'required|date',
            'jam_ujian' => 'required|date_format:H:i',
            'category_id' => 'required|exists:category_exams,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'user_id' => 'nullable|exists:users,id',
            'siswa_id' => 'required|array',
            'siswa_id.*' => 'required|string|exists:students,id',
            'durasi' => 'required|integer',
            'status' => 'nullable|string',
        ];
    }
    
}
