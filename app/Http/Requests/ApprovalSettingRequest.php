<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApprovalSettingRequest extends FormRequest
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
        $rules = [
            'status' => 'required|in:approved,rejected',
        ];

         // Jika status adalah rejected, maka alasan penolakan wajib diisi
         if ($this->input('status') === 'rejected') {
            $rules['reason'] = 'required|string';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'status.required' => 'Status persetujuan wajib diisi.',
            'status.in' => 'Status harus berupa "approved" atau "rejected".',
            'reason.required' => 'Alasan penolakan wajib diisi.'
        ];
    }
}
