<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;


/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="API Gateway",
 *         description=""
 *     ),
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Swagger",
 *         url="http://swagger.io"
 *     ),
 *     @OA\Get(
 *        path="/",
 *        description="Home page",
 *        @OA\Response(response="default", description="Home page")
 *     )
 * )
 */
class Controller extends BaseController
{
    //
    public function notFound($url)
    {
        return response()->json([
            'status' => 404,
            'message' => $url . " tidak ditemukan.",
        ], 404);
    }
}
