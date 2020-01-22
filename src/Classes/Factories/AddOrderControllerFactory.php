<?php

namespace BoxCheckout\Factories;

use Psr\Container\ContainerInterface;
use BoxCheckout\Controllers\AddOrderController;

class AddOrderControllerFactory
{
    public function __invoke(ContainerInterface $container) : AddOrderController
    {
        $orderModel = $container->get('OrderModel');
        return new AddOrderController($orderModel);
    }
}