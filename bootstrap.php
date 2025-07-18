<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require './vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/src/View');

$twig = new Environment($loader, [
    'cache' => false,
]);

return $twig;
