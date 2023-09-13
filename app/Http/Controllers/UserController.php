<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request){
        $validate = Validator::make($request->all(),[
            'name'=>'required|string',
            'password'=>'required|min:8'
        ]);

        if($validate->fails()){
            return response()->json([
                'message'=>$validate->errors()->messages()
            ], 420);
        }

        
    }

    public function logout(){

    }
    public function users(){

    }

    public function user(Request $request, $id){

    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }

    public function delete(Request $request, $id){
        
    }
}
