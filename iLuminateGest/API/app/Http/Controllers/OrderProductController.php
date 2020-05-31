<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderProductController extends Controller
{

    /**
     * Update a Product Of an Order
     * @param Request $request
     * @param $oId
     * @param $pId
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateProductOfAnOrder(Request $request, $oId, $pId)
    {
        $order = Order::find($oId);
        if (!$order) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $oId . ' cannot be found.'
            ], 400);
        }
        $product = Product::find($pId);
        if (!$product) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, product with id ' . $pId . ' cannot be found.'
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric',
            'products_total_price' => 'regex:/^\d+(\.\d{1,2})?$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()
            ], 422);
        }
        DB::table('order_product')
            ->where(['order_id' => $oId, 'product_id' => $pId])
            ->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $order->products->find($pId)
        ]);
    }
    /**
     * @param $oId
     * @param $pId
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachProductFromTheOrder($oId, $pId)
    {
        $order = Order::find($oId);
        if (!$order) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $oId . ' cannot be found.'
            ], 400);
        }
        $product = Product::find($pId);
        if (!$product) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, product with id ' . $pId . ' cannot be found.'
            ], 400);
        }
        $order->products()->detach($pId);
        return response()->json([
            'success' => true,
            'data'=>'Remove product ' . $product->name . ' from order with the id '. $oId .' completed successfully'
        ]);
    }

    /**
     * Add the relationship between an order and a product
     * @param  \Illuminate\Http\Request  $request
     * @param $oId
     * @param $pId
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignProductToTheOrder(Request $request, $oId, $pId){
        $order = Order::find($oId);
        if(!$order){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $oId . ' cannot be found.'
            ], 400);
        }
        $product = Product::find($pId);
        if (!$product) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, product with id ' . $pId . ' cannot be found.'
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'quantity' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()
            ], 422);
        }
        $quantity = $request->quantity;
        if($quantity) {
            $totalPrice = $quantity*$product->price;
                $order->products()->attach($pId, [
                    'quantity' => $quantity,
                    'products_total_price' => $totalPrice]);
        }
        else {
            $order->products()->attach($pId, [
                'products_total_price' => $product->price]);
        }
        return response()->json([
            'success' => false,
            'data' => $order->products
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
        $order = Order::find($id);
        if(!$order){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json(array(
            'success' => true,
            'data' => $order->products
        ));
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
