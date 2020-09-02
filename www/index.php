<?php

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


require __DIR__ . '/../vendor/autoload.php';
require 'vendor/autoload.php';


define('WP_CONTENT_URL' , 'http://bcappdata.graunephar.lol');



$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) use ($app) {

    print_r("run in 2\n");




    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => WP_CONTENT_URL,
        // You can set any number of default request options.
        'timeout'  => 2.0,
    ]);

    $app->foo = "hej";

    $promise = $client->requestAsync('GET', '/wp-json/wp/v2/modules');

    $promise->then(function ($response) use ($app) {


    });


    $response->getBody()->write("Hello");
    return $response;
});

$app->get('/debug', function (Request $request, Response $response, $args) use ($app) {

    var_dump($app->foo);

});

$app->run();
