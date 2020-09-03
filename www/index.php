<?php


use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


require('database.php');
require __DIR__ . '/../vendor/autoload.php';


define('WP_CONTENT_URL' , 'http://bcappdata.graunephar.lol');


$app = AppFactory::create();

$app->addRoutingMiddleware();

/**
 * Add Error Handling Middleware
 *
 * @param bool $displayErrorDetails -> Should be set to false in production
 * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool $logErrorDetails -> Display error details in error log
 * which can be replaced by a callable of your choice.

 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);


$app->get('/', function (Request $request, Response $response, $args)  {


    $client = new \GuzzleHttp\Client(["base_uri" => "http://bcappdata.graunephar.lol/wp-json/wp/v2/modules"]);
    $getdata = $client->get("modules");

    $connector = new DatabaseConnector();

    $body = $getdata->getBody();

    $json = json_decode($body);

   $connector->updateValue('wordpress/modules', $json);

    //http://bcappdata.graunephar.lol/wp-json/wp/v2/modules

    $response->getBody()->write("hej");
    return $response;
});


$app->run();
