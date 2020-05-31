<?php

namespace App\Http\Controllers;

use App\Model\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return  response()->json([
            'success' => true,
            'data' => Warehouse::where('active', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:warehouses',
            'location' => 'max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()], 422);
        }
        return response()->json([
            'success' => true,
            'data' => Warehouse::create($request->all())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, warehouse with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $warehouse
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
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, warehouse with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'max:255s',
            'location' => 'max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()], 422);
        }
        $warehouse->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $warehouse
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
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, warehouse with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $warehouse->active=0;
        if ($warehouse->save()) {
            return response()->json([
                'success' => true,
                'data' => $warehouse
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'Warehouse could not be deleted.'
            ], 500);
        }
    }
}
