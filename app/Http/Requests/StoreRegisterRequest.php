<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
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
            'nisn' => 'required|string|min:10|max:10|unique:students|regex:/^[0-9]+$/',
            'name' =>'required|string|max:255|regex:/^[\pL\s\d]+$/u',
            'email' =>'required|string|email|max:255|unique:users|regex:/^[\pL\s\d@\.\-_]+$/u',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'nisn.required' => 'NISN harus di isi',
            'nisn.min' => 'NISN minimal 10 digit',
            'nisn.max' => 'NISN maksimal 10 digit',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nisn.regex' => 'NISN hanya boleh berisi angka.',
            'name.required' => 'Nama harus di isi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Panjang nama maksimal 255 karakter',
            'name.regex' => 'Nama hanya boleh berisi huruf, spasi, dan angka',
            'email.required' => 'Email harus di isi',
            'email.email' => 'Email harus valid',
        ];
    }
}
