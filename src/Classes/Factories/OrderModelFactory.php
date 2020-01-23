<?php

namespace BoxCheckout\Factories;

use Psr\Container\ContainerInterface;
use BoxCheckout\Models\OrderModel;

class OrderModelFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $db = $container->get('dbConnection');
        return new OrderModel($db);
    }
}