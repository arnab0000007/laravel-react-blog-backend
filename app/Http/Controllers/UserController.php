<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
class UserController extends Controller
{
    function register(Request $req)
   {
       $rules = [
           'username' => 'required|min:3',
           'email' => 'required|min:3',
           'password' => 'required|min:3',
           'name' => 'required|min:3',
           'website' => 'required|min:3',
       ];
       $validator = Validator::make($req->all(),$rules);
       if($validator->fails()){
        return response()->json(["error"=>$validator->errors()]);
       }
       $user = new User;
       $user->username = $req->input('username');
       $user->email = $req->input('email');
       $user->password = Hash::make($req->input('password'));
       $user->name = $req->input('name');
       $user->website = $req->input('website');
       $user->save();
       return $user;
   }
   function login(Request $req)
   {
       if(filter_var( $req->input('emailOrUsername'), FILTER_VALIDATE_EMAIL)) { 
        $usermail = User::where('email',$req->emailOrUsername)->first(); 
        if ($usermail) {
           if (Hash::check($req->password, $usermail->password)) {
            return response()->json($usermail);
           } else {
            return response()->json(["error"=>"Password Is Wrong"]);
           }
        } else {
            return response()->json(["error"=>"User Not Found"]);
        }
     } else{
        $username = User::where('username',$req->emailOrUsername)->first(); 
        if ($username) { 
           if (Hash::check($req->password, $username->password)) {
            return response()->json($username);
           } else {
            return response()->json(["error"=>"Password Is Wrong"]);
           }
        } else {
            return response()->json(["error"=>"Wrong user Name"]);
        }
     }
   }
   function users(){
    return User::all();
    }
    function user($id){
        return $result = User::find($id);
     }
}
