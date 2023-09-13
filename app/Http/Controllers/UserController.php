<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()->messages()
            ], 420);
        }

        $user = User::where('email', $request->email)->first();
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

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message'=>'user logout successfully!'], 200);
    }
    public function users()
    {
        $users = User::all();
        if (!$users) {
            return response()->json([
                'message' => 'Unable to get users'
            ], 420);
        }
        return response()->json([
            'users' => $users,
            'message' => "Users get successfully"
        ], 200);


    }

    public function user(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Unable to get user'
            ], 420);
        }
        return response()->json([
            'user' => $user,
            'message' => "User get successfully"
        ], 200);

    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()->messages()
            ], 420);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        if (!$user) {
            return response()->json([
                "message" => 'fail..unable to create user'
            ], 420);
        }

        return response()->json([
            "User" => $user,
            "message" => "User Created Successfully"
        ], 200);



    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                "message" => 'User not found'
            ], 420);
        }
        
        $user->name = $request->name ? $request->name : $user->name;
        $user->email = $request->email ? $request->email : $user->email;
        $user->password = $request->password ? $request->password : $user->password;
        $user->save();

        if (!$user) {
            return response()->json([
                "message" => "User Can't Update, Try again"
            ], 200);

        }
        return response()->json([
            "User" => $user,
            "message" => "User Updated Successfully"
        ], 200);


    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                "message" => 'User not found'
            ], 420);
        }
        $user->delete();
        if (!$user) {
            return response()->json([
                "user" => "unable to delete user",
                "message" => 'fail'
            ], 420);
        }

        return response()->json([
            "user" => $user,
            "message" => "user deleted Successfully"
        ], 200);
    }

    
}