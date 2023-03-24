<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum','isAdmin')->group(function(){
    Route::apiResource('category',CategoryController::class)->only([
        'store', 'update', 'destroy'
    ]);
    Route::apiResource('plante',PlantController::class)->only([
        'store', 'update', 'destroy'
    ]);
}

);
Route::middleware('auth:sanctum','isSeller')->group(function(){
   
    Route::apiResource('plante',PlantController::class);
   
}




);

Route::middleware('auth:sanctum')->group(function(){
   
    Route::get('profile', [userController::class,'profile']);

    Route::put('Updateprofile/{User}', [userController::class,'Updateprofile']);
    
    Route::get('logout', [userController::class,'logout']);
}




);
Route::apiResource('category',CategoryController::class)->only([
    'index', 'show'
]);
Route::apiResource('plante',PlantController::class)->only([
    'index', 'show'
]);

Route::post('register', [userController::class,'register']);
Route::post('login', [userController::class,'login']);



// Route::apiResource('category',CategoryController::class)->middleware('auth:sanctum');
// Route::apiResource('plante',PlantController::class)->middleware('auth:sanctum');