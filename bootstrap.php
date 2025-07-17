<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require './vendor/autoload.php';

// Pasta onde ficarão os arquivos .twig
$loader = new FilesystemLoader(__DIR__ . '/src/View');

$twig = new Environment($loader, [
    'cache' => false, // ou use __DIR__.'/cache' em produção
]);

return $twig;
