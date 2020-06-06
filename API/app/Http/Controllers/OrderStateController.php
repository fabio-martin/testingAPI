<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderStateController extends Controller
{
     /**
     * Add the relationship between an order and a state
     * @param $oId
     * @param $sId
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignStateToTheOrder($oId, $sId){
        $order = Order::find($oId);
        if(!$order){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $oId . ' can not be found.'
            ], 400);
        }
        $state = State::find([$sId]);
        if(!$state){
            return response()->json([
                'success' => false,
                'data' => 'Sorry, state with id ' . $sId . 'can not be found.'
            ]);
        }
//        DB::table('order_state')->where('order_id', $oId)->update(['active' => 0]);
//        $order->states()->attach($sId);
        $order->states()->sync([$sId]);
        return response()->json([
            'success' => true,
            'data' => $order->states
        ]);
    }

    /**
     * Removes the relationship between an order and a state
     * @param $oId
     * @param $sId
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachStateFromTheOrder($oId, $sId)
    {
        $order = Order::find($oId);
        if (!$order) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, order with id ' . $oId . ' can not be found.'
            ], 400);
        }
        $state = State::find($sId);
        if (!$state) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, state with id ' . $sId . 'can not be found.'
            ]);
        }
        $order->states()->detach([$sId]);
        return response()->json([
            'success' => true,
            'data'=>'Detaching the order with the id ' . $oId . ' of the state with the id '. $sId .' completed successfully'
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
            'data' => $order->states
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
