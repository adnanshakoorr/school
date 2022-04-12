<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignCourseStudent;

class CourseStudentController extends Controller
{
    public function courseStudents(){
        $teachers_students = AssignCourseStudent::with('course','students')->where('teacher_id',Auth()->user()->id)->get();
        return view('teacher.assign_course_students',compact('teachers_students'));
    }
}
