<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
  public function login(Request $request){
      if($request->ismethode('post')){
        $data = $request->all();

        //echo '<pre>'; print_r($data);die();
        $user = User::create([
          'name'=>$request->name,
          'email'=>$request->email,
          'password' =>$request->password
        ]);
         return response()->json([
             'status'=>200,
             'user'=>$user,
             'message'=>'User added Successfully'
         ]);
         //$user = DB::table('users)->get();
      }

      //Validation
      $validator= Validator::make($data,[
           'email'=>'required|email|max:191',
           'password'=>'required|max:10|min:5'
      ]);

      if($validator->fails()){
        return response()->json([
        'status'=>422,
        'error'=>$validator->messages()
        ]);
      }else{
        //$user = DB::table('users)->where('email',$data['email'])->first();
        //echo "<pre>;print_r($user);die();

        $user =User::where('email', $request->email)->first();
           $requst_pass = $data['password'];
           if(!$user ||! Hash::check($request_pass, $user->password)){
            return response()->json([
                'status'=>401,
                'message'=>"invalid credentials"
            ]);
           }
        $token = $user->createToken($user->email. '_token')->plainText;
        return response()->json([
            'status'=>200,
            'name'=>$user->name,
            'token'=>$token,
            'message'=>'Login Successfful'
        ]);
      }
  }   

  public function logout(){
    auth()->user()->tokens()->delete();
    return response()->json([
        'status'=>200,
        'message'=>"Logout successfully"
    ]);
  }
}
