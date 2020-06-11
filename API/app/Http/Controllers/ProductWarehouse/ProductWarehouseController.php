<?php

namespace App\Http\Controllers;

use App\Model\Product\Product;


class ProductWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'data' => 'Sorry, product with id ' . $id . ' cannot be found.'
                ], 400);
            }
            return response()->json([
                'success' => true,
                'data' => $product->warehouses
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => ['title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error']
            ],
                $e->getCode());
        }
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
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $id)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        //
//    }
}
