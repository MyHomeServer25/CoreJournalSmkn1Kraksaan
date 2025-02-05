<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRequest extends Model
{
    /** @use HasFactory<\Database\Factories\StudentRequestFactory> */
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'student_id',
        'teacher_id',
        'dudi_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relasi ke model Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Relasi ke model Dudi
     */
    public function dudi()
    {
        return $this->belongsTo(Dudi::class);
    }
}
