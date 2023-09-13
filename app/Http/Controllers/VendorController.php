<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
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
        $user = Vendor::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'success'   => 'False',
                'message'   => 'Incorruct User Email Or Password',
            ],401);
        };
        $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json([
            'success'   => 'True',
            'message'   => 'Vendor Login Successfully',
            'token'=>$token
        ],200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message'=>'Vendor logout successfully!'], 200);
    }
    
    public function vendors(){

        $vendors = Vendor::all();
        if (!$vendors) {
            return response()->json([
                'message' => 'Unable to get vendors'
            ], 420);
        }
        return response()->json([
            'users' => $vendors,
            'message' => "vendors get successfully"
        ], 200);
    }

    public function vendor(Request $request, $id){
        $vendor = Vendor::find($id);
        if (!$vendor) {
            return response()->json([
                'message' => 'Unable to get vendor'
            ], 420);
        }
        return response()->json([
            'user' => $vendor,
            'message' => "User get successfully"
        ], 200);

    }

    public function store(Request $request){
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
        $vendor = Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $vendor->save();
        if (!$vendor) {
            return response()->json([
                "message" => 'fail..unable to create vendor'
            ], 420);
        }

        return response()->json([
            "User" => $vendor,
            "message" => "Vnedor Created Successfully"
        ], 200);

    }

    public function update(Request $request, $id){
        $vendor = Vendor::find($id);
        if (!$vendor) {
            return response()->json([
                "message" => 'Vendor not found'
            ], 420);
        }
         
        $vendor->name = $request->name ? $request->name : $vendor->name;
        $vendor->email = $request->email ? $request->email : $vendor->email;
        $vendor->password = $request->password ? $request->password : $vendor->password;
        $vendor->save();
        if (!$vendor) {
            return response()->json([
                "message" => "User Can't Update, Try again"
            ], 200);

        }
        return response()->json([
            "vendor" => $vendor,
            "message" => "User Updated Successfully"
        ], 200);

    }

    public function delete(Request $request, $id){
        $vendor = Vendor::find($id);
        if (!$vendor) {
            return response()->json([
                "message" => 'Vendor not found'
            ], 420);
        }
        $vendor->delete();
        if (!$vendor) {
            return response()->json([
                "Vendor" => "unable to delete Vendor",
                "message" => 'fail'
            ], 420);
        }

        return response()->json([
            "vendor" => $vendor,
            "message" => "vendor deleted Successfully"
        ], 200);
        
    }
}
