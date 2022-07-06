<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonResponseController extends Controller
{

    public static function get($results){

        $response = [
            "response"=>true,
            "results"=>$results,
            "error"=>false,
            "message"=>""
            ];
        return response()->json($response,200);
    }

    public static function error($message){

            $response = [
                "response"=>false,
                "results"=>null,
                "error"=>true,
                "message"=>array(
                    "code"=>404,
                    "message"=>$message
                )
                ];

        return response()->json($response,404);
    }


}
