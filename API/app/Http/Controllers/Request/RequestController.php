<?php

namespace App\Http\Controllers;

use App\Model\Category\Category;
use App\Model\Product\Product;
use App\Model\Provenance\Provenance;

use App\Model\RequestClient\RequestClient;
use App\Model\RequestClient\RequestClientStateRel;
use App\Model\RequestClient\RequestProduct;
use App\Model\RequestClient\RequestProductState;
use App\Model\RequestClient\RequestProductStateRel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class RequestController extends Controller
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

    }

    public function show($id)
    {

    }

    public function create()
    {
        try {
            $data = array(
                'categories' => Category::where('active', 1)->get()->map(function ($category) {
                    $category->totalProducts = $category->totalProducts();
                    return $category;
                }),
                'products' => Product::where('active', 1)->with('category')->get(),
                'provenance' => Provenance::where('active', 1)->get()
            );
            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

    public function store(Request $request)
    {


//        $validator = Validator::make($request->all(), [
////            'idCategory' => 'required',
//            'products' => 'required'
//        ]);

//        echo $request->products;
//        $data = $request->json()->all();


        //echo $request->products;

        try {
//            if ($validator->fails()) {
//                return response()->json($validator->errors(), 422);
//            }

            $requestClient = RequestClient::create(['idProvenance' => $request->provenance['id']]);
            RequestClientStateRel::create(['idRequest' => $requestClient->id, 'idState' => 1]);
            if (is_array($request->products) && sizeof($request->products) > 0) {
                foreach ($request->products as $p) {
                    $requestProduct = RequestProduct::create(['idRequest' => $requestClient->id, 'idProduct' => $p['id']]);
                    RequestProductStateRel::create(['idProduct' => $requestProduct->id, 'idState' => 1]);
                }
            }


            $data = array('request' => $requestClient);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);


        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], 500);
        }
    }
//
//
//    public function edit($id)
//    {
//        try {
//            $data = array('request' => Request::findOrFail($id), 'categories' => Category::where('active', 1)->get());
//            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
//        } catch (\Exception $e) {
//            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
//        }
    // }

    public function update(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'idCategory' => 'required',
//            'request' => 'required'
//        ]);
//        try {
//            if ($validator->fails()) {
//                return response()->json($validator->errors(), 422);
//            }
//
//            $request = Request::findOrFail($request->id);
//            $data = array('request' => $request->update($request->all()));
//
//            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
//
//
//        } catch (\Exception $e) {
//            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
//        }
    }

    public function destroy($id)
    {
//        try {
//            $request = Request::findOrFail($id);
//            $request->active = 0;
//
//            if ($request->save())
//                return response()->json(['success' => true, 'title' => 'Success', 'html' => '', 'type' => 'success', 'data' => array('request' => $request)], 200);
//            else
//                return response()->json(['success' => false, 'title' => 'Error', 'html' => 'Request could not be deleted', 'type' => 'success', 'data' => array('request' => $request)], 500);
//
//        } catch (\Exception $e) {
//            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
//        }
    }
}