<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request){
        // dd ($request);
        $token = Str::random(60);
            // return $token;
        try {
            User::create([
                'name'=>$request->Username,
                'email'=>$request->Email,
                'password'=>$request->Password,
                'remember_token'=>$token,
                ]);
                return 'success';
        } catch (\Throwable $th) {
           return 'failed';
        }
       
         
    }
    public function loginCheck(Request $request){
        $mailId=$request->Email;
        $pwd=$request->Password;
        if($users=User::where('email',$mailId)->exists()){
        $users=User::where('email',$mailId)->first();
        $password = $users->password;
        if($pwd==$password){
            return $users->remember_token;
        }else{
            return "";
        }
    

        // if(Auth::attempt(['email'=>$mailId, 'password'=>$pwd])){
        //     $user=User::where('email',$mailId)->first();
        //     return $user;
        }else{
            return "";
        }
    }
}