<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        if(!$user){
            return response()->json([
                'success'   => 'False',
                'message'   => 'Admin Stored falis',]);
        }
        return response()->json([
            'success'   => 'True',
            'message'   => 'Admin Stored successfully',
            'token'=>$token
        ]);


    }
    public function login(LoginRequest $request){
        $user = Admin::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'success'   => 'False',
                'message'   => 'Incorruct User Email Or Password',
            ],401);
        };
        $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json([
            'success'   => 'True',
            'message'   => 'Admin Login Successfully',
            'token'=>$token
        ],200);
        }

    public function logout(Request $request){
        Auth::user()->tokens()->delete();
        return response()->json(['message'=>'user logout successfully!'], 200);
    }
}
