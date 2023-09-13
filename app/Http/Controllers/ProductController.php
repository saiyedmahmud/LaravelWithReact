<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::all();
        return response()->json([
            "products" => $products,
            "message" => 'success'
        ], 200);

    }

    public function product(Request $request, $id)
    {
        $product = Product::where('id', $id)->get();
        if (!$product) {
            return response()->json([
                "product" => "product not found",
                "message" => 'fail'
            ], 420);
        }
        return response()->json([
            "product" => $product,
            "message" => 'success'
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'description' => 'required|string',
            'price' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->messages()
            ], 420);
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        if (!$product) {
            return response()->json([
                "product" => "unable to add product",
                "message" => 'fail'
            ], 420);
        }

        return response()->json([
            "product" => $product,
            "message" => "product added Successfully"
        ], 200);



    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name ? $request->name : $product->name;
        $product->description = $request->description ? $request->description : $product->description;
        $product->price = $request->price ? $request->price : $product->price;
        $product->save();

        if (!$product) {
            return response()->json([
                "product" => "unable to update product",
                "message" => 'fail'
            ], 420);
        }

        return response()->json([
            "product" => $product,
            "message" => "product updated Successfully"
        ], 200);


    }

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();
        if (!$product) {
            return response()->json([
                "product" => "unable to delete product",
                "message" => 'fail'
            ], 420);
        }

        return response()->json([
            "product" => $product,
            "message" => "product delete Successfully"
        ], 200);
    }
}