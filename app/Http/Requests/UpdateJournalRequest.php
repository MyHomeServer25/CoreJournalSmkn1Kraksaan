<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Journal;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJournalRequest extends FormRequest
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
    //     $journalId = $this->route('journal');
    //     return [
    //         'date' => ['date', 
    //         'required', 
    //         'before_or_equal:' 
    //         . now()->format('Y-m-d'),        
    //         Rule::unique('journals', 'date')
    //             ->where('users_id', auth()->user()->id)
    //             ->ignore($journalId),
    //     ],
    //         'character_values' => 'required',
    //         'description' => 'required'
    //     ];
    // }

    // public function messages()
    // {
    //     return [
    //         'date.unique' => 'Anda sudah mengisi jurnal di tanggal tersebut'
    //     ];
    // }

    public function rules(): array
    {
        $journal = $this->route('journal');

        return [
            // 'date' => [
            //     'date',
            //     Rule::unique('journals', 'date')
            //         ->where('users_id', auth()->user()->id)
            //         ->ignore($journal->id),
            //     function($attribute, $value, $fail) use ($journal) {
            //         $today = now()->format('Y-m-d');
            //         $journalDate = Carbon::parse($journal->date)->format('Y-m-d');
            //         if ($today !== $journalDate) {
            //             $fail('Anda hanya dapat mengupdate jurnal pada tanggal yang sama dengan tanggal pembuatan jurnal.');
            //         }
            //     }
            // ],
            // 'date' => [
            //     function($attribute, $value, $fail) use ($journal) {
            //         $today = now()->format('Y-m-d');
            //         $journalDate = Carbon::parse($journal->date)->format('Y-m-d');
            //         // Langsung periksa tanggal jurnal tanpa membutuhkan value dari request
            //         if ($today !== $journalDate) {
            //             $fail('Anda hanya dapat mengupdate jurnal pada tanggal yang sama dengan tanggal pembuatan jurnal.');
            //         }
            //     }
            // ],
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            // 'date.unique' => 'Anda sudah mengisi jurnal di tanggal tersebut',
            // 'date.before_or_equal' => 'Kolom date hanya boleh diisi dengan tanggal hari ini atau sebelumnya.',
            'name.required' => 'Kolom nilai karakter harus diisi',
            'description.required' => 'Kolom deskripsi harus diisi',
            'description.string' => 'Kolom deskripsi harus berupa string',
            'name.string' => 'Kolom description harus berupa string',
        ];
    }
}
