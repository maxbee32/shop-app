<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function sendResponse($data, $message, $status = 200){
        $response =[
            'data' => $data,
            'message' => $message
        ];
        return response()->json($response, $status);
     }


     public function __construct(){
        $this->middleware('auth:api', ['except'=>['productStore']]);
    }


public function productStore(Request $request){
    $validator = Validator::make($request->all(), [
        'product_name'=> ['required','string'],
        'price' => ['required'],
        'description' =>['required'],
        'image' =>['required','image','mimes:jpg,png,jpeg,gif,svg','max:2048']
    ]);



    if($validator->stopOnFirstFailure()-> fails()){
        return $this->sendResponse([
            'success' => false,
            'data'=> $validator->errors(),
            'message' => 'Validation Error'
        ], 400);
    }

    $image_path = $request->file('image')->store('image',['disk' => 'public']);
 
       Product::create(array_merge(
        ['image'=> $image_path],
        $validator-> validated()));


    // $token = $product->createToken('token')->plainTextToken;

    return $this ->sendResponse([
        'success' => true,
         'message' =>'product added successfully.'

       ],200);
}
}
