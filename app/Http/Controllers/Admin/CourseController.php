<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\AssignCourseTeacher;
use App\Models\AssignCourseStudent;


class CourseController extends Controller
{
    public function courses(){
        $records = Course::orderBy('id','DESC')->get();
        return view('admin.courses.list',compact('records'));
    }
    public function addNewCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('Title is required');
        }
        Course::create([
            'title'    => $request->title,
        ]);
        return response()->json("Record added successfully.");
    }

    public function editCourse(Request $request){
        $records = Course::where('id',$request->user_id)->first();
        return response()->json($records,200);
    }
    public function updateCourse(Request $request){
        Course::where('id',$request->user_id)->update([
            'title'    => $request->title,
        ]);
        return response()->json("Record updated successfully.");
    }
    public function deleteCourse(Request $request){
        Course::where('id',$request->user_id)->delete();
        return response()->json("Record deleted successfully.");
    }

    public function assignCourseToTeacher()
    {
        $teachers = AssignCourseTeacher::pluck('user_id');
        $records = Course::orderBy('id','DESC')->get();
        $users = User::orderBy('id','DESC')->where('role','Teacher')->get();
         $assigned_courses =  User::with('Course')->whereIn('id',$teachers)->get();
        return view('admin.courses.assign_course_teacher',compact('records','users','assigned_courses'));
    }

    public function assignCourse(Request $request)
    {
        $check = AssignCourseTeacher::where(['course_id'=>$request->course_id,'user_id'=>$request->user_id])->first();
        if($check)
        {
            return array('message'=>'User already exist in our database','type'=>'error');
        }else{
            AssignCourseTeacher::create(['course_id'=>$request->course_id,'user_id'=>$request->user_id]);
            return array('message'=>'Course has been assigned to teacher','type'=>'success');
        }
       
    }

    public function assignCourseToStudent()
    {
        $teachers = AssignCourseTeacher::pluck('user_id');
        $records = Course::orderBy('id','DESC')->get();
        $users = User::orderBy('id','DESC')->where('role','Student')->get();
        $assigned_courses =  User::with('Course')->whereIn('id',$teachers)->where('role','Student')->get();
        // $c_students = AssignCourseStudent::pluck('user_id');
        // $c_teachers = AssignCourseStudent::pluck('user_id');

   $teachers_students =  AssignCourseStudent::with('student','teacher','course')->get();
// dd($teachers_students->toArray());
        

        return view('admin.courses.assign_course_student',compact('records','users','teachers_students'));
    }


    public function assignCourseStudent(Request $request)
    {
        
        $check = AssignCourseStudent::where(['course_id'=>$request->course_id,'user_id'=>$request->user_id])->first();
        if($check)
        { 
            return array('message'=>'Teacher already assigned for course to this Student.','type'=>'error');
        }else{
            AssignCourseStudent::create(['course_id'=>$request->course_id,'user_id'=>$request->user_id,'teacher_id'=>$request->teacher_id]);
            return array('message'=>'Course has been assigned to student','type'=>'success');
        }
       
    }

    public function getCourse(Request $request)
    {
        $teachers = AssignCourseTeacher::where('course_id',$request->course_id)->pluck('user_id');
        return  $products = User::whereIn('id',$teachers)
                ->get();
    }
}
