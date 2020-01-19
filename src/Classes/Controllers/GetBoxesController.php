<?php

namespace BoxCheckout\Controllers;

use BoxCheckout\Models\BoxModel;
use Slim\Http\Request;
use Slim\Http\Response;

class GetBoxesController
{
    private $boxModel;

    public function __construct(BoxModel $boxModel)
    {
        $this->boxModel = $boxModel;
    }

    /**
     * Calls a method to get all the boxes and send JSON back with the info
     *
     * @param Request $request HTTP request
     * @param Response $response HTTP response
     * @param array $args
     * @return Response returns JSON with boxes data
     */
    public function __invoke(Request $request, Response $response, array $args) : Response
    {
        $data = [
            'status' => false,
            'message' => 'No boxes found',
            'data' => []
        ];
        $statusCode = 400;

        try {
            $boxes = $this->boxModel->getAllBoxes();
        } catch (\PDOException $exception) {
            $data['message'] = $exception->getMessage();
        }

        if (!empty($boxes)) {
            $data = [
                'status' => true,
                'message' => 'Query Successful',
                'data' => $boxes
            ];
            $statusCode = 200;
        }

        return $response->withJson($data, $statusCode);
    }
}