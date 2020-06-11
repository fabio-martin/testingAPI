<?php

namespace App\Http\Controllers;

use App\Model\Category\Category;
use App\Model\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        try {
            $data = array('products' => Product::where('active', 1)->with('category')->get());
            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

    public function show($id)
    {
        return Product::findOrFail($id);

//
//        if (!$categoria) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Sorry, categoria with id ' . $id . ' cannot be found.'
//            ], 400);
//        }

//        return $categoria;
    }

    public function create()
    {
        try {
            $data = array('categories' => Category::where('active', 1)->get());
            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCategory' => 'required',
            'product' => 'required|unique:products'
        ]);

        try {

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $data = array('product' => Product::create($request->all()));

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }


    public function edit($id)
    {
        try {
            $data = array('product' => Product::findOrFail($id), 'categories' => Category::where('active', 1)->get());
            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

     /**
      * Update product price
      * @param Request $request
      * @param $id
      * @return \Illuminate\Http\JsonResponse
      * */
    public function updateProductPrice(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'price' => 'required|regex:/^\d*(\.\d{2})?$/'
        ]);
        try {
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'data' => $validator->errors()], 422);
            }
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'data' => 'Sorry, product with id ' . $id . ' cannot be found.'
                ], 400);
            }

            $product->update($request->all());;
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        }
        catch(\Exception $e) {
            return response()->json([
                    'success' => false,
                    'data' => ['title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error']
                ],
                    $e->getCode());
        }

    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCategory' => 'required',
            'product' => 'required'
        ]);
        try {
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $product = Product::findOrFail($request->id);
            $data = array('product' => $product->update($request->all()));

            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);


        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->active = 0;

            if ($product->save())
                return response()->json(['success' => true, 'title' => 'Success', 'html' => '', 'type' => 'success', 'data' => array('product' => $product)], 200);
            else
                return response()->json(['success' => false, 'title' => 'Error', 'html' => 'Product could not be deleted', 'type' => 'success', 'data' => array('product' => $product)], 500);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }
}