<?php

namespace BoxCheckout\Factories;

use Psr\Container\ContainerInterface;
use BoxCheckout\Models\BoxModel;

class BoxModelFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $db = $container->get('dbConnection');
        return new BoxModel($db);
    }
}
