<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
    public function rules()
    {
        return [
            'teachers_id' => 'required|exists:teachers,id',
            'dudis_id' => 'required|exists:dudis,id',
        ];
    }

    public function messages()
    {
        return [
            'teachers_id.required' => 'Guru pembimbing wajib diisi.',
            'teachers_id.exists' => 'Guru pembimbing tidak ditemukan.',
            'dudis_id.required' => 'Tempat PKL wajib diisi.',
            'dudis_id.exists' => 'Tempat PKL tidak ditemukan.',
        ];
    }
}
