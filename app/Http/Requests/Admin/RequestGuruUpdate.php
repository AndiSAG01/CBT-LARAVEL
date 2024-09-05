<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestGuruUpdate extends FormRequest
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
            'name' => 'required|string|max:100',
            'NIK' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('gurus')->ignore($this->guru->id),
            ],
            'password' => 'nullable|string',
            'image' => 'nullable',
            'Position' => 'required|string|max:50',
            'role' => 'guru',
        ];
    }
}
