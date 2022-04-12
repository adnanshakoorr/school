<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;

class TeacherController extends Controller
{
    public function teachers(){
        $records = User::where('role','Teacher')->orderBy('id','DESC')->get();
        
        return view('admin.teachers.list',compact('records'));
    }
    public function addNewTeacher(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email'      =>'unique:users|email|required',
            'password'   => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['alert'=>'error','message'=>"Email already exists."]);
        }
        $fourRandomDigit = time().rand(1000,9999);
        $first_name = $request->input('first_name')??'';
        $last_name = $request->input('last_name')??'';
        $email = $request->input('email');
        $result =  User::create([
            'first_name'    => $first_name,
            'last_name'     => $last_name??NULL,
            'gender'        => $request->input('gender'),
            'email'         => $email,
            'password'      => Hash::make($request->input('password')),
            'verify_token'  => $fourRandomDigit,
            'role'          => 'Teacher',
        ]);
        if($result){
            $data = array('otp'=>$fourRandomDigit);
            Mail::send("emails/verifyemail", $data, function($message) use($email,$first_name,$last_name) {
                $message->to($email, $first_name." ".$last_name)->subject('For Teacher: Verify Your E-mail Address');
                $message->from('spidercard420@gmail.com','School-Management-System');
            });
            return response()->json(['alert'=>'success','message'=>"Record added and verification email sent successfully."]);
        }else{
            return response()->json(['alert'=>'error','message'=>"Something went wrong"]);
        }
    }
    public function verifyemail($otp){
        //dd($otp);
        $user = User::where('verify_token',$otp)->first();
        if($user){
            User::where('verify_token',$otp)->update(['verify_token'=>time().rand(1000,9999),'status'=>'enabled']);
            return redirect()->route("login-form")->with(['alert' => 'success', 'message' => 'E-mail verified successfully now you can login.']);
        }else{
            return redirect()->route("login-form")->with(['alert' => 'error', 'message' => 'E-mail verification code expired please try again.']);
        }
    }
    public function editTeacher(Request $request){
        $records = User::where('id',$request->user_id)->first();
        return response()->json($records,200);
    }
    public function updateTeacher(Request $request){
        User::where('id',$request->user_id)->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'gender'        => $request->gender,
            'email'         => $request->email,
            'status'        => $request->status,
        ]);
        return response()->json("Record updated successfully.");
    }
    public function deleteTeacher(Request $request){
        User::where('id',$request->user_id)->delete();
        return response()->json("Record deleted successfully.");
    }
}
