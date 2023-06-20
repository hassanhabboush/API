<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($data, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'code' => $code,
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response,$code);
    }

    public function errorResponse($message, $code = 403,$date=[])
    {
        $response = [
            'success' => false,
            'code' => $code,
            
            'message' => $message
        ];
        if(!empty($date)){
            $response['data ']=$date;
            
        }

        return response()->json($response,$code);
    }
}