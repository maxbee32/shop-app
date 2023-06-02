<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function sendResponse($data, $message, $status = 200){
        $response =[
            'data' => $data,
            'message' => $message
        ];
        return response()->json($response, $status);
     }

    public function __construct(){
        $this->middleware('auth:api', ['except'=>['getProduct']]);
    }


    // get all produuct
public function getProduct(){
    $result = DB::table('products')
    ->orderBy("products.created_at", 'desc')
    ->get(array(
              'id',
              'product_name',
              'price',
              'description',
              'image',

    ));
    return $this ->sendResponse([
        'success' => true,
         'message' => $result,

       ],200);


 }
}
