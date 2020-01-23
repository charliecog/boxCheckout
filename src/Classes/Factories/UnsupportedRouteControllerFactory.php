<?php

namespace BoxCheckout\Factories;

use BoxCheckout\Controllers\UnsupportedRouteController;
use Psr\Container\ContainerInterface;

class UnsupportedRouteControllerFactory
{
    public function __invoke(ContainerInterface $container) : UnsupportedRouteController
    {
        return new UnsupportedRouteController();
    }
}