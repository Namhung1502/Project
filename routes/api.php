<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\MemberController;

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


// member
// http:://..../api/login
Route::post('/member/login',[MemberController::class, 'login']);
Route::post('/member/register',[MemberController::class, 'postRegister']);



//Blog Api
// http:://..../api/blog
Route::get('/blog',[BlogController::class, 'index']);
