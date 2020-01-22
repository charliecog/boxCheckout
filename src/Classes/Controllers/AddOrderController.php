<?php

namespace BoxCheckout\Controllers;

use BoxCheckout\Models\OrderModel;
use Slim\Http\Request;
use Slim\Http\Response;
use function Sodium\add;

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

        if($this->orderModel->checkAllKeysPresent($newOrderData)){
            return $response->withJson($data, $statusCode);
        }

        $addressData = $newOrderData['address'];

        $address = $this->orderModel->createAddressEntity(
            $addressData['firstLine'],
            $addressData['secondLine'],
            $addressData['town'],
            $addressData['postcode'],
            $addressData['county'],
            $addressData['country']);


        $userData = $newOrderData['user'];

        $user = $this->orderModel->createUserEntity(
            $userData['title'],
            $userData['firstName'],
            $userData['lastName'],
            $userData['email'],
            $userData['phone'],
            $userData['businessName'],
            $userData['secondaryPhone']);

        $orderData = [
            'userId'=> null,
            'deliveryId'=> null,
            'paymentId'=> $newOrderData['paymentId'],
            'totalPrice'=> $newOrderData['totalPrice'],
            'discountApplied'=> $newOrderData['discount'],
            'totalPriceCharged'=> $newOrderData['totalPriceCharged']
        ];

        try {

            $this->orderModel->getDb()->beginTransaction();

            $insertedAddressId = $this->orderModel->addAddress($address);

            $insertedUserId = $this->orderModel->addUser($user);

            $orderData['deliveryId'] = $insertedAddressId;
            $orderData['userId'] = $insertedUserId;

            $order = $this->orderModel->createOrderEntity(
                $orderData['userId'],
                $orderData['deliveryId'],
                $orderData['paymentId'],
                $orderData['totalPrice'],
                $orderData['discountApplied'],
                $orderData['totalPriceCharged']);
            $orderId = $this->orderModel->addOrder($order);

            $orderDetailsArray = $this->orderModel->createOrderDetailsArray($newOrderData['products'], $orderId);
            $orderComplete = $this->orderModel->addOrderDetails($orderDetailsArray);

            $this->orderModel->getDb()->commit();
            $data['data']['orderId'] = $orderId;

        } catch (\PDOException $PDOException) {
            $data['message'] = $PDOException->getMessage();
        } catch (\Exception $exception){
            $data['message'] = $exception->getMessage();
        }

        if (!empty($orderComplete)) {
            $data['status'] = true;
            $data['message'] = 'Order created';
            $statusCode = 200;
        }

        return $response->withJson($data, $statusCode);
    }
}
