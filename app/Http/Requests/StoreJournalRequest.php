<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJournalRequest extends FormRequest
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
            'date' => 'required|date|unique:journals,date,NULL,id,users_id,' . auth()->user()->id,
            'character_values' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'date.unique' => 'Anda sudah mengisi jurnal di tanggal tersebut'
        ];
    }
}
