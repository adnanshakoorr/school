<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Teacher\CourseStudentController;
use App\Http\Controllers\Student\CourseTeacherController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[LoginController::class,'loginForm'])->name('login-form');
Route::post('login-process', [LoginController::class, 'loginProcess'])->name('login-process');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'admin'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [LoginController::class, 'admin'])->name('admin');
        // teachers
        Route::get('teachers', [TeacherController::class, 'teachers'])->name('teachers');
        Route::post('add-new-teacher', [TeacherController::class, 'addNewTeacher'])->name('add-new-teacher');
        Route::get('edit-teacher', [TeacherController::class, 'editTeacher'])->name('edit-teacher');
        Route::post('update-teacher', [TeacherController::class, 'updateTeacher'])->name('update-teacher');
        Route::get('delete-teacher', [TeacherController::class, 'deleteTeacher'])->name('delete-teacher');
        Route::get('verify-email/{id}', [TeacherController::class, 'verifyemail'])->name('verify-email');
        // students
        Route::get('students', [StudentController::class, 'students'])->name('students');
        Route::post('add-new-student', [StudentController::class, 'addNewStudent'])->name('add-new-student');
        Route::get('edit-student', [StudentController::class, 'editStudent'])->name('edit-student');
        Route::post('update-student', [StudentController::class, 'updateStudent'])->name('update-student');
        Route::get('delete-student', [StudentController::class, 'deleteStudent'])->name('delete-student');
        // courses
        Route::get('courses', [CourseController::class, 'courses'])->name('courses');
        Route::post('add-new-course', [CourseController::class, 'addNewCourse'])->name('add-new-course');
        Route::get('edit-course', [CourseController::class, 'editCourse'])->name('edit-course');
        Route::post('update-course', [CourseController::class, 'updateCourse'])->name('update-course');
        Route::get('delete-course', [CourseController::class, 'deleteCourse'])->name('delete-course');

        // courses  to teacher
        Route::get('assign-course-to-teacher', [CourseController::class, 'assignCourseToTeacher'])->name('assign-course-to-teacher');
        Route::post('assignCourse', [CourseController::class, 'assignCourse'])->name('assignCourse');

        // course to student
        Route::get('assign-course-to-student', [CourseController::class, 'assignCourseToStudent'])->name('assign-course-to-student');
        Route::post('assignCourseStudent', [CourseController::class, 'assignCourseStudent'])->name('assignCourseStudent');
        Route::get('get-course', [CourseController::class, 'getCourse'])->name('get-course');
        
    });
});

Route::group(['middleware' => 'teacher'], function () {
    Route::prefix('teacher')->group(function () {
        Route::get('course-students', [CourseStudentController::class, 'courseStudents'])->name('course-students');
    });
});

Route::group(['middleware' => 'student'], function () {
    Route::prefix('student')->group(function () {
        Route::get('course-teacher', [CourseTeacherController::class, 'courseTeacher'])->name('course-teacher');
    });
});
