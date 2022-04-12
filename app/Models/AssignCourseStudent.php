<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCourseStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id','user_id','teacher_id'
    ];

    public function student()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function teacher()
    {
        return $this->hasOne(User::class, 'id','teacher_id');
    }
    public function students()
    {
        return $this->hasMany(User::class, 'id','user_id');
    }
    public function course()
    {
        return $this->hasOne(Course::class, 'id','course_id');
    }
}
