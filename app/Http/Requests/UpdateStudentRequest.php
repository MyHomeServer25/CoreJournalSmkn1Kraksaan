<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name' => 'string|min:10',
            'email' => 'email',
            'password' => 'min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'name tidak boleh mengandung angka',
            'name.min:' => 'panjang nama minimal 10 huruf',
            'email.email' => 'harus berupa email',
            'password.min:' => 'password minimal 8 huruf' 
        ];
    }
}
