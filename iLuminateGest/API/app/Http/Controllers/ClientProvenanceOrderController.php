<?php

namespace App\Http\Controllers;

use App\Model\Client;
use App\Model\Order;
use App\Model\Provenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientProvenanceOrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $cId
     * @param  int  $pId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(Request $request, $cId, $pId)
    {
        $client = Client::find($cId);
        if (!$client) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, client with id ' . $cId . ' cannot be found.'
            ], 400);
        }
        $provenance = Provenance::find($pId);
        if(!$provenance){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, provenance with id ' . $pId . ' cannot be found.'
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'date'=> 'date|date_format:Y-m-d'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()
            ], 422);
        }
        $order = new Order;
        $order->client_id = intVal($cId);
        $order->provenance_id = intVal($pId);
        $order->description = $request->description;
        $order->date = $request->date;
        if ($order->save()) {
            return response()->json([
                'success' => true,
                'data' => $order
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'Order could not be created in DB.'
            ], 500);
        }
    }
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
}
