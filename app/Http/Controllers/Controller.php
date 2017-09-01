<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function createdResponse($data)
    {
        $response = [
        'code' => Res::HTTP_CREATED,
        'status' => 'success',
        'data' => $data
        ];
        return response()->json($response, $response['code']);
    }
    
    protected function showResponse($data)
    {
        $response = [
        'code' => Res::HTTP_OK,
        'status' => 'success',
        'data' => $data
        ];
        return response()->json($response, $response['code']);
    }
    
    protected function listResponse($data)
    {
        $response = [
        'code' => Res::HTTP_OK,
        'status' => 'success',
        'data' => $data
        ];

        return response()->json($response, $response['code']);
    }
    
    protected function notFoundResponse()
    {
        $response = [
        'code' => Res::HTTP_NOT_FOUND,
        'status' => 'error',
        'data' => 'Resource Not Found',
        'message' => 'Not Found'
        ];
        return response()->json($response, $response['code']);
    }
    
    protected function deletedResponse()
    {
        $response = [
        'code' => 200, //204,
        'status' => 'success',
        'data' => [],
        'message' => 'Resource deleted'
        ];
        return response()->json($response, $response['code']);
    }
    
    protected function clientErrorResponse($data)
    {
        $response = [
        'code' => Res::HTTP_UNPROCESSABLE_ENTITY,
        'status' => 'error',
        'data' => $data,
        'message' => 'Unprocessable entity'
        ];
        return response()->json($response, $response['code']);
    }

    public function InternalErrorResponse($message)
    {
        $response = [

            'status' => 'error',
            'code' => Res::HTTP_INTERNAL_SERVER_ERROR,
            'data' => $message,
            'message' => 'InternalError'

        ];
        return response()->json($response, $response['code']);
    }

    public function UnauthorizedResponse($message)
    {
        $response = [
            'status' => 'error',
            'code' => Res::HTTP_UNAUTHORIZED,
            'data' => $message,
            'message' => 'Unauthorize',
        ];
        return response()->json($response, $response['code']);
    }
}
