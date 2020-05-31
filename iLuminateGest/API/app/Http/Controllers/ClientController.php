<?php

namespace App\Http\Controllers;

use App\Model\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClientProvenance($id){
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, client with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $client->orders->map(function ($values){
                return $values->provenance->toArray();
            })
//            'data' => $client->orders->first()->provenance
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return  response()->json([
            'success' => true,
            'data' => Client::where('active', 1)->get()
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
            'name' => 'required|max:255|unique:clients',
            'nif' => 'digits:9|unique:clients',
            'email' => 'regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()], 422);
        }
        return response()->json([
            'success' => true,
            'data' => Client::create($request->all())
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
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, client with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $client
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
            'name' => 'required|max:255|unique:clients',
            'nif' => 'digits:9|unique:clients',
            'email' => 'regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()], 422);
        }
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, client with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $client->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $client
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
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, client with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $client->active=0;
        if ($client->save()) {
            return response()->json([
                'success' => true,
                'data' => $client
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'Client could not be deleted.'
            ], 500);
        }
    }
}
