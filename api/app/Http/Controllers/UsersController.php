<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{


    public function login(Request $input){


        $credentials = $input->only("email","password");

        /* if(!auth()->attempt($credentials)){
            abort(401,"Invalid credentials");
        }
        $token = auth()->user()->getRememberToken(); */

        $array = [
            "token"=>"ASDLKF;JA;SDLFAUISDFAJSD;FJAKSD;F"
        ];

        return JsonResponseController::get($array);
    }


    public function register (Request $request){


        $validator = Validator::make($request->post(), [
            'email' => 'required|email|unique:users,email|max:255',
            'name' => 'required|string',
            "type_user" => "required|numeric"
        ]);


        if ($validator->fails()) {
           return JsonResponseController::error($validator->errors()->first());

        }

        $user = new User;
        $user->email = $request->email;
        $user->name =$request->name;
        $user->password = bcrypt($request->password);
        $user->type_user = $request->type_user;

        $user->save();

        $response = User::find($user->id);

        return JsonResponseController::get($response);


    }

}
