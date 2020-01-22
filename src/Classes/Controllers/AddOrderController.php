<?php

namespace BoxCheckout\Controllers;

use BoxCheckout\Models\OrderModel;
use Slim\Http\Request;
use Slim\Http\Response;

class AddOrderController
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
     * @return Response returns JSON response
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

        if(
            !isset($newOrderData['address']) ||
            !isset($newOrderData['user']) ||
            !isset($newOrderData['products']) ||
            !isset($newOrderData['totalPrice']) ||
            !isset($newOrderData['discount']) ||
            !isset($newOrderData['totalChargedPrice']) ||
            !isset($newOrderData['paymentId'])

        ){
            return $response->withJson($data, $statusCode);
        }

        if(isset($newOrderData['address'])){
            $address = $this->orderModel->createAddressEntity(...$newOrderData['address']);
        }
        $user = $this->orderModel->createUserEntity(...$newOrderData['user']);

        $orderData = [
            'userId'=> null,
            'deliveryId'=> null,
            'paymentId'=> $newOrderData['paymentId'],
            'totalPrice'=> $newOrderData['totalPrice'],
            'discountApplied'=> $newOrderData['discount'],
            'totalChargedPrice'=> $newOrderData['totalChargedPrice']
        ];

        try {

            $this->orderModel->getDb()->beginTransaction();

            $insertedAddressId = $this->orderModel->addAddress($address);

            $insertedUserId = $this->orderModel->addUser($user);

            $orderData['deliveryId'] = $insertedAddressId;
            $orderData['userId'] = $insertedUserId;

            $order = $this->orderModel->createOrderEntity(...$orderData);
            $orderId = $this->orderModel->addOrder($order);

            $orderDetailsArray = $this->orderModel->createOrderDetailsArray($newOrderData['products'], $orderId);
            $this->orderModel->addOrderDetails($orderDetailsArray);

            $orderComplete = $this->orderModel->getDb()->commit();

        } catch (\PDOException $exception) {
            $data['message'] = $exception->getMessage();
        } catch (\Exception $exception) {
            $data['message'] = $exception->getMessage();
        }

        if (!empty($orderComplete)) {
            $data = [
                'status' => true,
                'message' => 'Order created',
                'data' => []
            ];
            $statusCode = 200;
        }

        return $response->withJson($data, $statusCode);
    }
}
