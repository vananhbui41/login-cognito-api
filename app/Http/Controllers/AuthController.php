<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CognitoJWT;
use App\Models\Account;
use Illuminate\Contracts\Auth\Factory;

class AuthController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $jwt = $request->bearerToken(); 
        $region = env('AWS_REGION','');//must be string 
        $userPoolId = env('AWS_COGNITO_USER_POOL_ID', '');//must be string 
        if ($jwt) { 
            $decode = CognitoJWT::verifyToken($jwt, $region, $userPoolId); 
        } 
        if (! $decode) {
            return \response()->json(['error' => 'Unauthorized'], 401);
        }
        if (! $user = Account::where('cognito_user_id',$decode->sub)->first() ) {
            return \response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = Auth::login($user);
        
        return $this->createNewToken($token);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function userProfile() {
        return response()->json(Auth::user());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
