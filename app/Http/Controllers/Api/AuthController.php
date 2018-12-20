<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use JWTAuth;
use App\User;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = request(['email', 'password']);

        if (! $token = $this->guard()->attempt($credentials)) {
            return response()->json(['error' => 'Wrong Username or Password'], 200);
        }

        return $this->respondWithToken($token);
    }

    public function loginWithId($id) {
        $user = User::find($id);
        if(! $token = $this->guard()->login($user)) {
            return response()->json([
                'success' => false,
                'message' => "Login Failed"
            ]);
        }

        return $this->respondWithToken($token);
    }


    public function loginWithDcp(Request $request) {
        $client = new Client(['http_errors' => false]);

        $result = $client->post('http://portal2.local/login', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password
            ]
        ]);

        echo $result->getBody();

    }

    /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function me()
    {
        return response([
                'success' => true,
                'user' => $this->guard()->user()
            ]);
    }

    /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
    * Refresh a token.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function refresh()
    {
        try {
            return $this->respondWithToken($this->guard()->refresh());
        } catch(TokenBlacklistedException $e) {
            return response(['error' => 'Token is blacklisted'], 403);
        } catch(TokenExpiredException $e) {
            return response(['error' => 'Token has expired and can no longer be refreshed'], 403);
        }

    }

    /**
    * Get the token array structure.
    *
    * @param  string $token
    *
    * @return \Illuminate\Http\JsonResponse
    */
    protected function respondWithToken($token)
    {
        return response([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => $this->guard()->user()
        ], 200);
    }

    public function guard()
    {
        return auth()->guard();
    }
}
