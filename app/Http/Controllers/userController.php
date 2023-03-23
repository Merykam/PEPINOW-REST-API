<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
                    'message'=>'connecte successfully',
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
}
