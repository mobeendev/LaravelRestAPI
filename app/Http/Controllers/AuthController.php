<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Validator;
use Response;
use Auth;

class AuthController extends Controller {

    public function __construct() {
        $this->user = new User;
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email|max:255|unique:users',
                    'name' => 'required',
                    'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        return Response::json(compact('token'));
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }


        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }
        // all good so return the token
        return response()->json(['success' => true, 'data' => ['token' => $token]]);
    }

    public function user(Request $request) {

        try {
        $user = JWTAuth::parseToken()->authenticate();
//            $user = Auth::user();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json(['error' => 'token_blacklisted ddd'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json(['error' => 'token_expired dddssssss'], 401);
        }


//        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function logout() {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
                ], 200);
    }

}
