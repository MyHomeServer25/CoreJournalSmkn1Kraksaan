<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDudiRequest extends FormRequest
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
            'name' => 'required|string|max:255|regex:/^[\pL\s\d]+$/u'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'nama dudi harus di isi',
            'name.string' => 'Judul dudi harus berupa teks.',
            'name.max'      => 'Nama perusahaan tidak boleh lebih dari 255 karakter.',
            'name.regex'    => 'Nama perusahaan hanya boleh berisi huruf, angka, dan spasi.',
        ];
    }
}
