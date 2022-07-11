<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsersController extends Controller
{

    /* public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    } */

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($request->post(), [
            'email' => 'required|email',
            'password'=>'required',
        ]);


        if ($validator->fails()) {
           return JsonResponseController::error($validator->errors()->first());
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return JsonResponseController::error("Invalid credentials",401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return JsonResponseController::error("Cannot created token",500);
        }

        $userdata = User::where('email', $request->email)->first();



        $data = [
            "token" => $token,
            "email" => $userdata->email,
            'id' => $userdata->id,
            "type_user" => $userdata->type_user,
            "permissions" => $userdata->userspermissions
        ];

        return  JsonResponseController::get($data);

    }


    public function validatetoken(Request $request) {


        if(auth('api')->check()){
            $data = ["tokenvalid"=>true];
            return  JsonResponseController::get($data);
        }else{

            return JsonResponseController::error("Token invalid",401);
        }


    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshtoken()
    {
        try {

           $at = (auth('api')->refresh());

           $array = [
            "token"=> $at
           ];
           return JsonResponseController::get($array);

        } catch (\Throwable $th) {

            return JsonResponseController::error($th->getMessage(),401);
        };
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
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }





    public function register (Request $request){


        $validator = Validator::make($request->post(), [
            'email' => 'required|email|unique:users,email|max:255',
            'name' => 'required|string',
            'password'=>'required',
            "type_user" => "required|numeric"
        ]);


        if ($validator->fails()) {
           return JsonResponseController::error($validator->errors()->first());
        }

        $user = new User;
        $user->email = $request->email;
        $user->name =$request->name;
        $user->password = Hash::make($request->password);
        $user->type_user = $request->type_user;

        $user->save();

        $response = User::find($user->id);

        return JsonResponseController::get($response);


    }

}
