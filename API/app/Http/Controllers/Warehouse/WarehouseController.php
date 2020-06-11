<?php

namespace App\Http\Controllers;

use App\Warehouse\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            return  response()->json([
                'success' => true,
                'data' => Warehouse::where('active', 1)->get()
            ]);
        }
        catch (\Exception $e) {
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $location = $request->location;
        try {
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    Rule::unique('warehouses')->where(function ($query) use($name,$location) {
                        return $query->where('name', $name)->where('location', $location);
                    })
                ],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'data'=> $validator->errors()]);
//                'data'=> $validator->errors()], 422);
            }
            return response()->json([
                'success' => true,
                'data' => Warehouse::create($request->all())
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                    'success' => false,
                    'data' => ['title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error']
                ],
                $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
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
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => ['title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error']
            ],
                $e->getCode());
        }
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
        try {
            $warehouse = Warehouse::find($id);
            if (!$warehouse) {
                return response()->json([
                    'success' => false,
                    'data' => 'Sorry, warehouse with id ' . $id . ' cannot be found.'
                ], 400);
            }
            $name = $request->name;
            $location = $request->location;
            $validator = Validator::make($request->all(), [
                'name' => [
                        'required',
                        Rule::unique('warehouses')->where(function ($query) use($name,$location) {
                            return $query->where('name', $name)->where('location', $location);
                        })->ignore($id)
                    ],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'data'=> $validator->errors()]);
            }
            $warehouse->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $warehouse
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => ['title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error']
            ],
                $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
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
        catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }
}
