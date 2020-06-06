<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'success'=> true,
            'data'=> Product::where('active', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, product with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $product
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'numeric',
            'name' => 'min:2',
            'price'=> 'regex:/^\d+(\.\d{1,2})?$/'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()
            ], 422);
        }
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, product with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $product->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, product with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $product->active = 0;
        if ($product->save()) {
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'Product could not be deleted.'
            ], 500);
        }
    }
}
