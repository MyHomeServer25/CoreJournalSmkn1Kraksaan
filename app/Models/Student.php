<?php

namespace App\Models;

use App\Enums\ApproveEnum;
use App\Policies\StudentPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::deleting(function ($student) {
            User::where('id', $student->users_id)->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'users_id')->withDefault();
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class , 'teachers_id')->withDefault([
            'name' => 'No Teacher',
        ]);
    }

    public function dudi()
    {
        return $this->belongsTo(Dudi::class, 'dudis_id')->withDefault([
            'name' => 'No dudi'
        ]);
    }

    public function pendingApproval()
    {
        return $this->hasOne(StudentRequest::class);
    }
}
