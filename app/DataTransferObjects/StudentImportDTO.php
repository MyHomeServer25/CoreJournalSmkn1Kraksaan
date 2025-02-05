<?php
namespace App\DataTransferObjects;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentImportDTO
{
    public string $nisn;
    public string $name;
    public string $email;
    public string $password;
    
    public function __construct(array $row, int $rowIndex)
    {
        $validator = Validator::make($row, [
            'nisn'     => ['required', 'size:10', 'unique:students,nisn'],
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', Rule::unique('users', 'email')],
        ], [
            'nisn.required' => "Baris {$rowIndex}: Kolom NISN harus diisi.",
            'nisn.size' => "Baris {$rowIndex}: NISN harus memiliki panjang 10 karakter.",
            'nisn.unique' => "Baris {$rowIndex}: NISN sudah terdaftar.",
            'name.required' => "Baris {$rowIndex}: Kolom Nama harus diisi.",
            'name.max' => "Baris {$rowIndex}: Nama tidak boleh lebih dari 255 karakter.",
            'email.required' => "Baris {$rowIndex}: Kolom Email harus diisi.",
            'email.email' => "Baris {$rowIndex}: Format Email tidak valid.",
            'email.unique' => "Baris {$rowIndex}: Email sudah digunakan.",
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $this->nisn = $row['nisn'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->password = 'pklsiswasmk';
    }
}
