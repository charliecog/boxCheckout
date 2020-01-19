<?php

namespace BoxCheckout\Factories;

use Psr\Container\ContainerInterface;
use BoxCheckout\Controllers\GetBoxesController;

class GetBoxesControllerFactory
{
    public function __invoke(ContainerInterface $container) : GetBoxesController
    {
        $boxModel = $container->get('BoxModel');
        return new GetBoxesController($boxModel);
    }
}
