<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductWarehouseController extends Controller
{

    /**
     * Add products to the warehouse
     * @param Request $request
     * @param $pId
     * @param $wId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProductsInAWarehouse(Request $request, $pId, $wId){
        $product = Product::find($pId);
        if(!$product){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, product with id ' . $pId . ' cannot be found.'
            ], 400);
        }
        $warehouse = Warehouse::find($wId);
        if (!$warehouse) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, warehouse with id ' . $wId . ' cannot be found.'
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'stock' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()], 422);
        }
        $warehouse = $product->warehouses->find($wId);
        $warehouse->pivot->stock += $request->stock;
        $warehouse->pivot->save();
        return response()->json([
            'success' => true,
            'date' => $warehouse
        ]);
    }

    /**
     * Put product in a warehouse
     * @param  \Illuminate\Http\Request  $request
     * @param $pId
     * @param $wId
     * @return \Illuminate\Http\JsonResponse
     */
    public function putProductsInAWarehouse(Request $request, $pId, $wId){
        $product = Product::find($pId);
        if(!$product){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, product with id ' . $pId . ' cannot be found.'
            ], 400);
        }
        $warehouse = Warehouse::find($wId);
        if (!$warehouse) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, warehouse with id ' . $wId . ' cannot be found.'
            ], 400);
        }
        $validator = Validator::make($request->all(), [
//            'stock' => 'regex:/^\d+(\.\d{1,2})?$/',
            'units_of_measure' => 'max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()], 422);
        }
        $product->warehouses()->attach($wId);

        DB::table('product_warehouse')
            ->where(['product_id' => $pId, 'warehouse_id' => $wId])
            ->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $product->warehouses->find($wId)
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
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
            'data' => $product->warehouses
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
