<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    public function successResponse($data, $message, $code = Response::HTTP_OK)
    {
        return response()->json([
            'code' => $code,
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }


    public function errorResponse($message, $code = Response::HTTP_NOT_FOUND)
    {
        return response()->json([
            'code' => $code,
            'status' => false,
            'message' => $message,
            'data' => null
        ], $code);
    }
}
