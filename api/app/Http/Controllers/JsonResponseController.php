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

    public static function error($message,$status=404){

            $response = [
                "response"=>false,
                "results"=>null,
                "error"=>true,
                "message"=>array(
                    "code"=>$status,
                    "error_message"=>$message
                ),
                "status"=>$status
                ];

        return response()->json($response,$status);
    }


}
