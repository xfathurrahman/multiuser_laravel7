<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    public static function roleHome()
    {
        if (Auth::user()->role===1) {
            $admin='admin';
        }
        if (Auth::user()->role===2) {
            $admin='clients';
        }
        if (Auth::user()->role===3) {
            $admin='user';
        }
        return $admin;
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
        'success' => true,
        'statusCode'=>200,
        'data'    => $result,
        'message' => $message,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
        'success' => false,
        'statusCode'=> $code,
        'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
