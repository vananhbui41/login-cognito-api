<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CognitoJWT;
use App\Models\Account;

class AuthController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        // $jwt = $request->bearerToken(); 
        // $region = env('AWS_REGION','');//must be string 
        // $userPoolId = env('AWS_COGNITO_USER_POOL_ID', '');//must be string 
        // if ($jwt) { 
        //     $decode = CognitoJWT::verifyToken($jwt, $region, $userPoolId); 
        // } 
        // if (!Auth::attempt(['cognito_user_id'=>$decode->sub])) {
        //     # code...
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        
        return \response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function userProfile() {
        return response()->json(auth()->user());
    }
}
