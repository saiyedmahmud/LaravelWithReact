<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function products(){
        $products = Product::all();
        return response()->json([
            "products"=> $products,
            "message"=> 'success'
        ],200);

    }

    public function product(Request $request, $id){
        $product = Product::where('id', $id)->get();
        if(!$product){
            return response()->json([
                "product"=> "product not found",
                "message"=> 'fail'
            ],420);
        }
        return response()->json([
            "product"=> $product,
            "message"=> 'success'
        ],200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255|string',
            'description'=>'required|string',
            'price'=>'required|integer'
        ]);

        if($validator->falis()){
            return response()->json([
                "message"=> $validator->errors()->messages()
            ],200);
        }

        $product = Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price
        ]);

        if(!$product){
            return response()->json([
                "product"=> "unable to add product",
                "message"=> 'fail'
            ],420);
        }

        return response()->json([
            "product"=> $product,
            "message"=> "product added Successfully"
        ],200);



    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255|string',
            'description'=>'required|string',
            'price'=>'required|integer'
        ]);

        if($validator->falis()){
            return response()->json([
                "message"=> $validator->errors()->messages()
            ],200);
        }

        $product = Product::update([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price
        ]);

        if(!$product){
            return response()->json([
                "product"=> "unable to add product",
                "message"=> 'fail'
            ],420);
        }

        return response()->json([
            "product"=> $product,
            "message"=> "product added Successfully"
        ],200);


    }

    public function delete(Request $request, $id){

    }
}
