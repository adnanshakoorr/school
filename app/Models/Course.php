<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];


    public function User()
    {
        return $this->belongsToMany(User::class,'assign_course_teachers');
    }
}
