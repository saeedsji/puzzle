<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function sendResponse($response)
    {
        $response['data'] = !empty($response['data']) ? $response['data'] : null;
        $response['validation'] = !empty($response['validation']) ? $response['validation'] : [];
        $response['code'] = !empty($response['code']) ? $response['code'] : Response::HTTP_OK;
        
        if ($response['success'])
        {
            return $this->sendSucess($response['message'], $response['data'], $response['code']);
        }
        else
        {
            return $this->sendError($response['message'], $response['validation'], $response['code']);
        }
    }
    
    public function sendSucess($message, $data = null, $code = Response::HTTP_OK)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response, $code);
    }
    
    public function sendError($message,  $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }
}
