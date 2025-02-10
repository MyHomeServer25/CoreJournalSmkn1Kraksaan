<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'name' => 'required|max:255|regex:/^[\pL\s\d]+$/u',
            'password' => 'required|min:8',
            'email' => 'required|email|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Panjang nama maksimal 255 karakter',
            'name.regex' => 'Nama hanya boleh berisi huruf, spasi, dan angka',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email salah',
            'email.max' => 'Panjang email maksimal 255 karakter'
        ];
    }
}
