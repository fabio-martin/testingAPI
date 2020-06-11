<?php

namespace App\Http\Controllers;

use App\Model\Product\Product;
use App\Warehouse\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WarehouseProductController extends Controller
{
    /**
     * Add products to the warehouse
     * @param Request $request
     * @param $wId
     * @param $pId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProductsToTheWarehouse(Request $request, $wId, $pId){
        try {
            $product = Product::find($pId);
            if (!$product) {
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
                'stock' => 'integer',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'data' => $validator->errors()], 422);
            }
            $productWarehouse = $product->warehouses->find($wId);
            $stock = $productWarehouse->pivot->stock;
            $validateStock = $stock + $request->stock;
            if ($validateStock < 0) {
                return response()->json([
                    'success' => false,
                    'data' => 'Sorry, only ' . $stock . ' products can be taken out of stock.'
                ], 400);
            }
            $productWarehouse->pivot->stock += $request->stock;
            $productWarehouse->pivot->save();
            return response()->json([
                'success' => true,
                'data' => $productWarehouse
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
     * Put product in a warehouse
     * @param  \Illuminate\Http\Request  $request
     * @param $wId
     * @param $pId
     * @return \Illuminate\Http\JsonResponse
     */
    public function putProductsInAWarehouse(Request $request, $wId, $pId){
        try {
            $product = Product::find($pId);
            if (!$product) {
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
            $params = ['product_id' => $pId, 'warehouse_id' => $wId];
            $paramsValidator = Validator::make($params, [
                'product_id' => [
                    'required',
                    Rule::unique('product_warehouse')->where(function ($query) use ($pId, $wId) {
                        return $query->where('product_id', $pId)->where('warehouse_id', $wId);
                    })
                ],
            ]);
            if ($paramsValidator->fails()) {
                return response()->json([
                    'success' => false,
                    'data' => $paramsValidator->errors()]);
            }
            $validator = Validator::make($request->all(), [
                'stock' => 'regex:/^\d+(\.\d{1,2})?$/',
                'units_of_measure' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'data' => $validator->errors()]);
            }
            $product->warehouses()->attach($wId);

            DB::table('product_warehouse')
                ->where(['product_id' => $pId, 'warehouse_id' => $wId])
                ->update($request->all());

            return response()->json([
                'success' => true,
                'data' => $product->warehouses->find($wId)
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
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        try {
            $warehouse = Warehouse::find($id);
            if(!$warehouse){
                return response()->json([
                    'success' => false,
                    'data' => 'Sorry, warehouse with id ' . $id . ' cannot be found.'
                ], 400);
            }
            return response()->json([
                'success' => true,
                'data' => $warehouse->products
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
     * @param  int  $pId
     * @param  int  $wId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($wId, $pId)
    {
        try {
            $product = Product::find($pId);
            if (!$product) {
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
            $result = $product->warehouses()->detach($wId);
            if($result){
                return response()->json([
                    'success' => true,
                    'data' => [
                        'wId' => $wId,
                        'pId' => $pId,
                    ]
            ]);
            }
            else {
                return response()->json([
                    'success' => false,
                    'data' => 'There was a problem removing the product with id ' . $pId. ' from warehouse with id ' .$wId. '.'
                ]);
            }


        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => ['title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error']
            ],
                $e->getCode());
        }

    }
}
