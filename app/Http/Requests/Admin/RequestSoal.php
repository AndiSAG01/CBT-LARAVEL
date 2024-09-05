<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestSoal extends FormRequest
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
            'code' => 'nullable|string',
            'kategori_id' => 'nullable|string|exists:kategoris,id',
            'user_id' => 'nullable|string|exists:users,id',
            'soal_ujian' => 'required|string',
            'kunci_A' => 'nullable|string',
            'kunci_B' => 'nullable|string',
            'kunci_C' => 'nullable|string',
            'kunci_D' => 'nullable|string',
            'kunci_E' => 'nullable|string',
            'kunci_jawaban' => 'required|string|in:A,B,C,D,E',
        ];
    }
}
