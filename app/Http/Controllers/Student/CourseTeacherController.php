<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignCourseStudent;
class CourseTeacherController extends Controller
{
    public function courseTeacher(){
        $course_teacher =  AssignCourseStudent::with('course','teacher')->where('user_id',Auth()->user()->id)->get();
        return view('student.assign_course_teacher',compact('course_teacher'));
    }
}
