<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenApi(
 *   @OA\Info(
 *     title=L5_SWAGGER_CONST_TITLE,
 *     version=L5_SWAGGER_CONST_VERSION,
 *     description=L5_SWAGGER_CONST_DESCRIPTION,
 *     @OA\Contact(name=L5_SWAGGER_CONST_CONTACT_NAME, email=L5_SWAGGER_CONST_CONTACT_EMAIL)
 *   ),
 *   @OA\Server(url=L5_SWAGGER_CONST_HOST, description="Base URL"),
 *   security={{"authBearerToken":{}}}
 * ),
 * @OA\SecurityScheme(
 *   securityScheme="authBearerToken",
 *   type="http",
 *   scheme="bearer"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, DispatchesJobs;

    public function __construct()
    {

    }

    public function getResponse($data = [], $messages = 'Success', $code = 200){
        return response()->json([
            'data' => $data,
            'status' => [
                'message' => $messages,
                'code' => $code
            ]
        ], $code);
    }

    public function getResponseRepository($data = [], $messages = 'Success', $code = 200){
        return (object) [
            'result' => $code >= 200 && $code <  300 ? true : false,
            'response' => response()->json([
                'data' => $data,
                'status' => [
                    'message' => $messages,
                    'code' => $code
                ]
            ], $code)
        ];
    }
}
