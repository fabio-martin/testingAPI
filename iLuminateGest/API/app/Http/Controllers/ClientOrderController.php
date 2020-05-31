<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, client with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $client->orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
//    public function store(Request $request, $id)
//    {
//        $client = Client::find($id);
//        if (!$client) {
//            return response()->json([
//                'success' => false,
//                'data' => 'Sorry, client with id ' . $id . ' cannot be found.'
//            ], 400);
//        }
//        $validator = Validator::make($request->all(), [
//            'date'=> 'date|date_format:Y-m-d'
//        ]);
//        if ($validator->fails()) {
//            return response()->json([
//                'success' => false,
//                'data'=> $validator->errors()
//            ], 422);
//        }
//        $order = new Order;
//        $order->client_id = intVal($id);
//        $order->description = $request->description;
//        $order->date = $request->date;
//        if ($order->save()) {
//            return response()->json([
//                'success' => true,
//                'data' => $order
//            ]);
//        } else {
//            return response()->json([
//                'success' => false,
//                'data' => 'Order could not be created in DB.'
//            ], 500);
//        }
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
