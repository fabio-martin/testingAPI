<?php

namespace App\Http\Controllers;

use App\Model\Provenance\Provenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try{
            return response()->json([
                'success' => true,
                'data' => Provenance::where('active', 1)->get()
            ]);
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
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
        try {
            $validator = Validator::make($request->all(), [
                'location' => 'required|max:255|unique:provenances',
                'color' => 'max:255'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'data' => $validator->errors()], 422);
            }
            return response()->json([
                'success' => true,
                'data' => Provenance::create($request->all())
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
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
            $provenance = Provenance::find($id);
            if (!$provenance) {
                return response()->json([
                    'success' => false,
                    'data' => 'Sorry, provenance with id ' . $id . ' cannot be found.'
                ], 400);
            }
            return response()->json([
                'success' => true,
                'data' => $provenance
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
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
            $validator = Validator::make($request->all(), [
                'location' => 'max:255|unique:provenances',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'data'=> $validator->errors()], 422);
            }
            $provenance = Provenance::find($id);
            if (!$provenance) {
                return response()->json([
                    'success' => false,
                    'data' => 'Sorry, provenance with id ' . $id . ' cannot be found.'
                ], 400);
            }
            $provenance->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $provenance
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
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
        try{
            $provenance = Provenance::find($id);
            if (!$provenance) {
                return response()->json([
                    'success' => false,
                    'data' => 'Sorry, provenance with id ' . $id . ' cannot be found.'
                ], 400);
            }
            $provenance->active=0;
            if ($provenance->save()) {
                return response()->json([
                    'success' => true,
                    'data' => $provenance
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => 'Provenance could not be deleted.'
                ], 500);
            }
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }
}
