<?php

use App\Database\Database;
use DI\ContainerBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;
require './vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/src/View');
        return new Environment($loader, [
            'cache' => false,
        ]);
    },
]);

$containerBuilder->addDefinitions([
    Connection::class => function () {
        return Database::getConnection(); 
    },
]);


$container = $containerBuilder->build();

return $container;
