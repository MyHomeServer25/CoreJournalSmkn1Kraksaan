<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
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
            "email" => "required|string|email|max:255|regex:/^[\pL\s\d@\.\-_]+$/u",
            "password" => "required|min:8",
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "Email harus diisi",
            "email.string" => "Email harus berupa string",
            "email.email" => "Email harus valid",
            "email.max" => "Email maksimal 255 karakter",
            "email.regex" => "Nama hanya boleh berisi huruf, angka, spasi, @, ., -, dan _.",
            "password.required" => "Password harus diisi",
            "password.min" => "Password minimal 8 karakter",
        ];
    }
}
