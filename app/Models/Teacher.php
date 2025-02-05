<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    // protected $table = 'teachers';
    protected $guarded = ['id'];
    protected static function booted()
    {
        static::deleting(function ($teacher) {
            User::where('id', $teacher->users_id)->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'users_id');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'teachers_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class, 'student_id');
    }
}
