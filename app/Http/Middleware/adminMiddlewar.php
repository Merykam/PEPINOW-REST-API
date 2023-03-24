<?php

namespace App\Http\Middleware;

use Closure;

// use Illuminate\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Http\Controllers\userController;
class adminMiddlewar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if(Auth::check()){

            if(Auth::user()->role == '1'){
                return $next($request); 
            }else{

                 return response()->json([
                    'message'=>'You are not an admin'
                
                ]);
            }

        }else{
            return response()->json([
                'message'=>'You are not authenticated'
            
            ]);
        }
        return $next($request);
    }
}
