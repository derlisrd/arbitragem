<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{


    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            //'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();


         if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
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
        $user->password = bcrypt($request->password);
        $user->type_user = $request->type_user;

        $user->save();

        $response = User::find($user->id);

        return JsonResponseController::get($response);


    }

}
