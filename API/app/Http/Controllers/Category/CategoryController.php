<?php

namespace App\Http\Controllers;

use App\Model\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use Tymon\JWTAuth\JWTAuth;
use JWTAuth;


class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $user;


    public function __construct()
    {
//        $this->middleware('auth');
//        $this->user = JWTAuth::parseToken()->authenticate();

    }

    public function index()
    {
        return Category::where('active', 1)->get();
    }

    public function show($id)
    {
        return Category::findOrFail($id);

//
//        if (!$categoria) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Sorry, categoria with id ' . $id . ' cannot be found.'
//            ], 400);
//        }

//        return $categoria;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'categoria' => 'required|email|unique:users',
//            'name' => 'required|string|max:50',
//            'id' => 'required',
            'category' => 'required|unique:categories'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);

//            return $validator->messages();
//            Session::flash('error', $validator->messages()->first());
//            return redirect()->back()->withInput();
        }


        return response()->json([
            'success' => true,
            'category' => Category::create($request->all())
        ]);
//        return Category::create($request->all());
    }

    public function edit(Category $category)
    {
//        return Category::findOrFail($id);
        return $category;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::findOrFail($request->id);
        $category->update($request->all());
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->active=0;
//        $categoria->save();
//        $categoria->delete();
//        return 204;

        if ($category->save()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category could not be deleted.'
            ], 500);
        }
    }

}