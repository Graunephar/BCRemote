<?php

//Make sure we also serve stativ files in developement! 
if (PHP_SAPI == 'cli-server') {
    $_SERVER['SCRIPT_NAME'] = basename(__FILE__);
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}


require('database.php');
require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();

$app->addRoutingMiddleware();

// Create Twig
//Value for cache is false if off and $_ENV['CACHE_DIR'] (<-- Note ref to name of folder) if on
$twig = Twig::create($_ENV['TEMPLATE_DIR'], ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));


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


$app->get('/', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);

    $client = new \GuzzleHttp\Client([
        "base_uri" => $_ENV['WORDPRESS'],
        'debug' => false,
        'timeout' => 10, // Response timeout
        'connect_timeout' => 10, // Connection timeout
    ]);

    $getdata = $client->get("modules");

    $connector = new DatabaseConnector();

    $body = $getdata->getBody();

    $json = json_decode($body);

    $connector->updateValue('wordpress/modules', $json);


   // print_r($json[2]->title->rendered);


    // NAME vs VAlue
    return $view->render($response, 'home.html.twig', [
        'json' => $json
    ]);

});

$app->get('/test', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);

    //print_r(PHP_SAPI);
    // NAME vs VAlue
    return $view->render($response, 'home.html.twig', [

    ]);

});


//$response->getBody()->write("hej");
//return $response;

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'profile.html.twig', [
        'name' => $args['name']
    ]);
})->setName('profile');

// Render from string
$app->get('/hi/{name}', function ($request, $response, $args) {
    $view = Twig::fromRequest($request);
    $str = $view->fetchFromString(
        '<p>Hi, my name is {{ name }}.</p>',
        [
            'name' => $args['name']
        ]
    );
    $response->getBody()->write($str);
    return $response;
});



$app->run();
