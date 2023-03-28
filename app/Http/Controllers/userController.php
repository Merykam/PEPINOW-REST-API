<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class userController extends Controller
{
    public function register(Request $request){

        $this ->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        $User = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash :: make ($request->password)


        ]);
        return response()->json($User);
    }


    public function login(Request $request){

        $userr = User :: whereEmail($request->email)->first();
        if(isset($userr->id)){
            if(Hash :: check($request->password, $userr->password)){
                $token = $userr -> createToken('auth_token')->plainTextToken;
                return response()->json([
                    'message'=>'connected successfully',
                    'token'=>$token 
                ]);
            }else{
                return response()->json([
                    'message'=> 'incorrect password'
                ]);
            }

        }else{
            return response()->json([
                'message'=> 'invalid email'
            ]);
        }

    }


    public function profile(){
        return new UserResource(auth()->user());
    }

    public function Updateprofile(Request $request, User $User){
        $User->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash :: make ($request->password)


        ]);
        return response()->json($User);
    }

    public function logout(){
       auth()->user()->tokens()->delete();
       return response()->json([
        'message'=> 'logout successfully'
    ]);
    }

  

    public function changeRole(Request $request,  User $User){
        $User->update([
            'role'=>$request->role
          


        ]);
        // return response()->json($User);

         return response()->json(['message' => 'User role has been updated']);
    }

   
}