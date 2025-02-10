<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'name' => 'required|string|max:255|regex:/^[\pL\s\d]+$/u',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'nama harus di isi',
            'email.required' => 'email harus di isi',
            'email.email' => 'email harus valid',
            'password.required' => 'password harus di isi',
            'password.min' => 'password minimal 8 huruf',
            'name.regex' => 'Nama hanya boleh berisi huruf, spasi, dan angka',
            'email.unique' => 'email sudah digunakan',
            'password.confirmed' => 'password harus sama dengan konfirmasi password'
        ];
    }
}
