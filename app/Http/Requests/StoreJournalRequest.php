<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
    // public function rules(): array
    // {
    //     return [
    //         'date' => [
    //             'required',
    //             'date',
    //             'unique:journals,date,NULL,id,users_id,' . auth()->user()->id,
    //             function ($attribute, $value, $fail) {
    //                 $today = Carbon::today()->format('Y-m-d');
    //                 if ($value > $today) {
    //                     $fail("Kolom {$attribute} hanya boleh diisi dengan tanggal hari ini atau sebelumnya.");
    //                 }
    //             },
    //         ],
    //         'character_values' => 'required|string',
    //         'description' => 'required|string',
    //     ];
    // }

    // public function messages()
    // {
    //     return [
    //         'date.unique' => 'Anda sudah mengisi jurnal untuk tanggal tersebut.',
    //         'date.required' => 'Kolom date harus diisi',
    //         'character_values.required' => 'Kolom nilai karakter harus diisi.',
    //         'character_values.string' => 'Kolom nilai karakter harus berupa string.',
    //         'description.required' => 'Kolom deskripsi harus diisi.',
    //         'description.string' => 'Kolom deskripsi harus berupa string.'
    //     ];
    // }

    public function rules(): array
    {
        return [
            'date' => [
                'required',
                'date',
                'unique:journals,date,NULL,id,users_id,' . auth()->user()->id,
                function ($attribute, $value, $fail) {
                    $today = Carbon::today()->format('Y-m-d');
                    if ($value > $today) {
                        $fail("Kolom {$attribute} hanya boleh diisi dengan tanggal hari ini.");
                    }
                },
            ],
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'date.unique' => 'Anda sudah mengisi jurnal untuk tanggal tersebut.',
            'date.required' => 'Kolom date harus diisi',
            'name.required' => 'Kolom nilai karakter harus diisi.',
            'name.string' => 'Kolom nilai karakter harus berupa string.',
            'description.required' => 'Kolom deskripsi harus diisi.',
            'description.string' => 'Kolom deskripsi harus berupa string.'
        ];
    }
}
