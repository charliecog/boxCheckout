<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/api/boxes', 'GetBoxesController');
    //  Respond to other routes on same url to make API more RESTful
    $app->post('/api/boxes', 'UnsupportedRouteController');
    $app->put('/api/boxes', 'UnsupportedRouteController');
    $app->delete('/api/boxes', 'UnsupportedRouteController');

    $app->post('/api/order', 'AddOrderController');
    //  Respond to other routes on same url to make API more RESTful
    $app->get('/api/order', 'UnsupportedRouteController');
    $app->put('/api/order', 'UnsupportedRouteController');
    $app->delete('/api/order', 'UnsupportedRouteController');
};
