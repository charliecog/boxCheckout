<?php

namespace BoxCheckout\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class UnsupportedRouteController
{
    /**
     * Calls various methods to add the order to the db and send JSON back with the response
     *
     * @param Request $request HTTP request
     * @param Response $response HTTP response
     * @param array $args
     * @return Response returns JSON response
     */
    public function __invoke(Request $request, Response $response, array $args) : Response
    {
        $data = [
            'status' => false,
            'message' => 'This API route is unsupported, please check the documentation',
            'data' => []
        ];
        $statusCode = 400;

        return $response->withJson($data, $statusCode);
    }
}