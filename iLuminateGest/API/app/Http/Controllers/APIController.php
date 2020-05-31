<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

//use Tymon\JWTAuth\Facades\JWTAuth;

class APIController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationFormRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);

    }

    public function getAuthenticatedUser()
    {
        $user = null;
        try {
            if (!$user == JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'success' => false,
                    'data' => 'User not found'
                ], 404); 
            }
        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'data' => 'Token Expired'
            ], $e->getStatusCode());
        }
        catch (TokenInvalidException $e) {
            return response()->json([
                'success' => false,
                'data' => 'Token Invalid'
            ], $e->getStatusCode());
        }
        catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'data' => 'Token Absent'
            ], $e->getStatusCode());
        }
    }
}


//
//
//In the above controller class, we firstly added all the required classes. Then we have defined a public property $loginAfterSignUp which we will use in our register() method.
//
//First, function we added is the login(). In this function, we firstly get the subset data from the form request only containing email and password. By using the JWTAuth::attempt($input) method, we determine if the authentication is successful and save the response in the $token variable. If the response is false, then we are sending the error message back in JSON format. If the authentication return true then we send the success response along with the $token.
//
//Next, we added the logout() method which invalidate the token. Firstly, we get the token from the form request and validate it, then call the JWTAuth::invalidate() method by passing the token from a form request. If the response is true we return the success message. If any exception occurs then we are sending an error message back.
//
//In the final, register() method we get the data from the form request and create a new instance of the User model and save it. Then we check if the our public property $loginAfterSignup is set we call the login() method to authenticate the user and send the success response back.