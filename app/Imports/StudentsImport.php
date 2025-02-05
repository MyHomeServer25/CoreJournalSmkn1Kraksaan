<?php

namespace App\Imports;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\DataTransferObjects\StudentImportDTO;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImport implements ToCollection, WithHeadingRow
{
    private $errors = [];
    private $successCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            try {
                $rowNumber = $index + 2; // +2 karena index dimulai dari 0 dan ada header
                $data = new StudentImportDTO($row->toArray(), $rowNumber);
                
                // Buat User baru
                $user = User::create([
                    'name'     => $data->name,
                    'email'    => $data->email,
                    'password' => Hash::make($data->password),
                    'role'     => RoleEnum::STUDENT->value,
                ]);

                // Buat Student
                Student::create([
                    'users_id'   => $user->id,
                    'nisn'       => $data->nisn,
                    'teacher_id' => null,
                    'dudis_id'   => null,
                    'status'     => null,
                    'name'       => $data->name,
                ]);

                $this->successCount++;
            } catch (ValidationException $e) {
                foreach ($e->errors() as $field => $messages) {
                    $this->errors = array_merge($this->errors, $messages);
                }
            } catch (\Exception $e) {
                $this->errors[] = "Baris {$rowNumber}: " . $e->getMessage();
            }
        }

        if (!empty($this->errors)) {
            throw ValidationException::withMessages([
                'errors' => $this->errors
            ]);
        }
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }
}
