<?php

namespace App\Api\Controllers;

use App\User;
use JWTAuth;
use GuzzleHttp\Client as Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Route;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => User::all()
        ]);
    }

    /**
     * Show specific resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => User::find($request->user_id)
        ]);
    }

    /**
     * Store new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "api_type" => 'registration',
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $payload = $request->all();
        $payload['password'] = Hash::make($request->password);
        $response = User::create($payload);

        if ($response) {
            return response()->json([
                "api_type" => 'registration',
                'status' => 'success',
                'message' => 'Resource added successfully'
            ]);
        } else {
            return response()->json([
                "api_type" => 'registration',
                'status' => 'fail',
                'message' => 'Unable to create resource'
            ]);
        }
    }

    /**
     * Login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "api_type" => 'login',
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!empty($user) && password_verify($request->password, $user->password)) {
            return response()->json([
                "api_type" => 'login',
                'status' => 'success',
                'email' => $user->email,
                'token' => $user->token,
                'refresh_token' => $user->refresh_token,
            ]);
        } else {
            return response()->json([
                "api_type" => 'login',
                'status' => 'fail',
                'message' => 'Authentication failed.'
            ]);
        }
    }

    /**
     * Update the given resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }

        $payload = $request->all();
        if (isset($payload['password']) && !empty($payload['password'])) {
            $payload['password'] = Hash::make($payload['password']);
        }
        $response = User::findOrFail($request->id)->update($payload);
        if ($response) {
            return response()->json([
                'status' => 'success',
                'message' => 'Resource updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unable to update resource'
            ]);
        }
    }

    /**
     * Delete the given resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }

        $response = User::destroy($request->id);

        if ($response) {
            return response()->json([
                'status' => 'success',
                'message' => 'Resource has been successfully deleted',
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unable to delete resource'
            ]);
        }
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => User::where($request->key, $request->value)->first()
        ]);
    }

    public function getToken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'grant_type' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "api_type" => 'token',
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $data = [
            'grant_type' => $request->grant_type,
            'client_id' =>  $request->client_id,
            'client_secret' => $request->client_secret,
            'username' => $request->username,
            'password' => $request->password,
            'scope' => '*'
        ];


        $user = User::where('email', $request->username)->first();

        $httpRequest = Request::create('/oauth/token', 'POST', $data);
        $response = app()->handle($httpRequest);
        $rData = json_decode($response->getContent());

        if (array_key_exists('access_token', $rData)) {
            if ($user != null) {
                $user->refresh_token = $rData->refresh_token;
                $user->token = $rData->access_token;
                $user->save();
                return response()->json([
                    "user_id" => $user->id,
                    "api_type" => 'token',
                    "status" => 'success',
                    "token_type" => $rData->token_type,
                    "expires_in" => $rData->expires_in,
                    "access_token" => $rData->access_token,
                    "refresh_token" => $rData->refresh_token
                ]);
            } else {
                return response()->json([
                    "api_type" => 'token',
                    "status" => 'failed',
                    "message" => 'User not found.',
                ]);
            }
        } else {
            return response()->json([
                "api_type" => 'token',
                "status" => 'failed',
                "message" => 'failed to generate token. Make sure you have entered valid client_id, client_secret, username as a email and password.',
            ]);
        }
    }

    public function getRefreshToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "api_type" => 'refresh_token',
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $user = User::find($request->user_id);

        // Refresh Access Token
        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' =>  $request->client_id,
            'client_secret' => $request->client_secret,
            'scope' => '*'
        ];

        $httpRequest = Request::create('/oauth/token', 'POST', $data);
        $response = app()->handle($httpRequest);
        $rData = json_decode($response->getContent());

        if (array_key_exists('refresh_token', $rData)) {
            $payload['token'] =  $rData->access_token;
            $payload['refresh_token'] =  $rData->refresh_token;
            $user->update($payload);
            return response()->json([
                "api_type" => 'refresh_token',
                'status' => 'success',
                "token_type" => $rData->token_type,
                "expires_in" => $rData->expires_in,
                "access_token" => $rData->access_token,
                "refresh_token" => $rData->refresh_token
            ]);
        } else {
            return response()->json([
                "api_type" => 'refresh_token',
                "status" => 'failed',
                "message" => 'Invalid token given, token refresh failed.',
            ]);
        }
    }
}
