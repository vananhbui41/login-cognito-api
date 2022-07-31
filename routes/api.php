<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['api'])->group(function () {
    Route::post('login', [AuthController::class,'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/user-profile', [AuthController::class, 'userProfile']); 
});

 




