<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    // db connection
    $container['dbConnection'] = function ($c) {
        $settings = $c->get('settings')['db'];
        $db = new PDO($settings['host'] . $settings['dbName'], $settings['userName'], $settings['password']);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return $db;
    };

    $container['BoxModel'] = new \BoxCheckout\Factories\BoxModelFactory();
    $container['OrderModel'] = new \BoxCheckout\Factories\OrderModelFactory();

    $container['GetBoxesController'] = new \BoxCheckout\Factories\GetBoxesControllerFactory();
    $container['AddOrderController'] = new \BoxCheckout\Factories\AddOrderControllerFactory();
    $container['UnsupportedRouteController'] = new \BoxCheckout\Factories\UnsupportedRouteControllerFactory();

};
