<?php

namespace BoxCheckout\Controllers;

use BoxCheckout\Models\OrderModel;
use Slim\Http\Request;
use Slim\Http\Response;

class addOrderController
{
    private $orderModel;

    public function __construct(OrderModel $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    /**
     * Calls various methods to add the order to the db and send JSON back with the response
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
            'message' => 'order not added to the db',
            'data' => []
        ];
        $statusCode = 400;

        $newOrderData = $request->getParsedBody();

        $address = $this->orderModel->createAddressEntity(...$newOrderData['address']);
        $user = $this->orderModel->createUserEntity(...$newOrderData['user']);

        


        try {
//            $insertedAddressId = $this->orderModel->getAllBoxes();






        } catch (\PDOException $exception) {
            $data['message'] = $exception->getMessage();
        }

        if (!empty($boxes)) {
            $data = [
                'status' => true,
                'message' => 'Boxes retrieved',
                'data' => $boxes
            ];
            $statusCode = 200;
        }

        return $response->withJson($data, $statusCode);
    }
}