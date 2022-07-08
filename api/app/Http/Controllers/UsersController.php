<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            "permission" => $userdata->userspermissions
        ];

        return  JsonResponseController::get($data);

    }



    /* public function login(Request $request){


        $validator = Validator::make($request->post(), [
            'email' => 'required|email',
            'password'=>'required',
        ]);


        if ($validator->fails()) {
           return JsonResponseController::error($validator->errors()->first());
        }

        $user = User::where('email', $request->email)->first();

        $credentials = $request->only(["email","password"]);
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return JsonResponseController::error("Invalid credentials",401);
        }


        if (! $token = auth()->attempt($credentials)) {
            return JsonResponseController::error("Invalid credentials",401);
        }

        return $this->respondWithToken($token);

        //return JsonResponseController::get($user);
    } */

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
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
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
