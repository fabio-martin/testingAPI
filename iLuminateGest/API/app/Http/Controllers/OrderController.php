<?php

namespace App\Http\Controllers;

use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function originOfAnOrder($id){
        $order = Order::find($id);
        if(!$order){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $order->provenance
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Order::where('active',1)->get()
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
        $order = Order::find($id);
        if(!$order){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $order
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
            'client_id' => 'numeric',
            'provenance_id' => 'numeric',
            'date' => 'date|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()
            ], 422);
        }
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $order->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $order
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
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $order->active = 0;
        if ($order->save()) {
            return response()->json([
                'success' => true,
                'data' => $order
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'Order could not be deleted.'
            ], 500);
        }
    }
}
