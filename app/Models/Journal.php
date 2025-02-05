<?php

namespace App\Models;

use App\Policies\JournalPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo(User::class , 'users_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teachers_id');
    }
}
