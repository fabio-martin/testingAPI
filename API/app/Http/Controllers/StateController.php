<?php

namespace App\Http\Controllers;

use App\Model\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => State::where('active', 1)->get()
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
            'option' => 'required|max:255|unique:states',
            'color' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()], 422);
        }
        return response()->json([
            'success' => true,
            'data' => State::create($request->all())
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
        $state = State::find($id);
        if (!$state) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, state with id ' . $id . ' cannot be found.'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'data' => $state
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
        $state = State::find($id);
        if (!$state) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, state with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'option' => 'max:255|unique:states',
            'color' => 'max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data'=> $validator->errors()], 422);
        }
        $state->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $state
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
        $state = State::find($id);
        if (!$state) {
            return response()->json([
                'success' => false,
                'data' => 'Sorry, state with id ' . $id . ' cannot be found.'
            ], 400);
        }
        $state->active=0;
        if ($state->save()) {
            return response()->json([
                'success' => true,
                'data' => $state
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'State could not be deleted.'
            ], 500);
        }
    }
}
