<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginForm(){
        return view('login');
    }
    public function loginProcess(Request $request){

        Validator::make($request->all(), [
            'email'     => ['required'],
            'password'  => ['required'],
        ])->validate();
        $credentials = $request->only('email', 'password');
        $redirectRoute = 'login-form';
        $alert = "error";
        $message = "Invalid Credentials";
        if (Auth::attempt($credentials) ) {
            $role = Auth()->user()->role;
            if(Auth()->user()->status =='disabled'){
                return redirect()->route('login-form')->with(['alert' => 'warning', 'message' =>'please verify your email address.']);
            }
            if($role== 'Admin'){
                $redirectRoute = 'teachers';
                $alert = "success";
                $message = "Admin login successfully";
            }else if($role == 'Teacher'){
                $redirectRoute = 'course-students';
                $alert = "success";
                $message = "Teacher login successfully";
            }else if($role == 'Student'){
                $redirectRoute = 'course-teacher';
                $alert = "success";
                $message = "Student login successfully";
            }
        }
        return redirect()->route($redirectRoute)->with(['alert' => $alert, 'message' => $message]);
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route("login-form")->with(['alert' => 'success', 'message' => 'Logout successfully']);
    }
}