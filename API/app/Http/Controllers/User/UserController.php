<?php

namespace App\Http\Controllers;

use App\Model\Category\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
            $data = array('users' => User::where('active', 1)->with('role')->get());
            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

    public function show($id)
    {
        return User::findOrFail($id);

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
            $data = array('roles' => $roles=Role::all());
            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
//            'password' => 'required|password',
            'role' => 'required',
        ]);

        try {

            if ($validator->fails())
                return response()->json($validator->errors(), 422);

            $user=User::create($request->all());
            $user->syncRoles($request->role);
            $data = array('user' => $user);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Erro!', 'html' => $e->getMessage(), 'type' => 'error'], 500);
        }
    }


    public function edit($id)
    {
        try {
            $data = array('user' => User::where('active', 1)->where('id',$id)->with('role')->get(), 'roles' => $roles=Role::all());
            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);
        try {
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::findOrFail($request->id);
            $user->syncRoles($request->role);
            $data = array('user' => $user->update($request->all()));

            return response()->json(['success' => true, 'title' => 'sucess', 'html' => null, 'type' => 'success', 'data' => $data], 200);


        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->active = 0;

            if ($user->save())
                return response()->json(['success' => true, 'title' => 'Success', 'html' => '', 'type' => 'success', 'data' => array('user' => $user)], 200);
            else
                return response()->json(['success' => false, 'title' => 'Error', 'html' => 'User could not be deleted', 'type' => 'success', 'data' => array('user' => $user)], 500);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'title' => 'Error', 'html' => $e->getMessage(), 'type' => 'error'], $e->getCode());
        }
    }
}