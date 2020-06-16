<?php
require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;

$strategy = new League\Route\Strategy\JsonStrategy(new \Laminas\Diactoros\ResponseFactory());
$router = (new League\Route\Router)->setStrategy($strategy);
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$tickets = [
    array(
        "Departure" => "Esfehan",//2
        "Arrival" => "Shiraz",
        "Transportation" => "Plane",
        "TransportationNumber" => "SK22",
        "Seat" => "7B",
        "Gate" => "22"
    ),
    array(
        "Departure" => "Hamedan", // 4
        "Arrival" => "Mashhad",
        "Transportation" => "Train",
        "TransportationNumber" => "78A",
        "Seat" => "45B"
    ),
    array(
        "Departure" => "Tehran",//1
        "Arrival" => "Esfehan",
        "Transportation" => "Plane",
        "TransportationNumber" => "SK455",
        "Seat" => "3A",
        "Gate" => "45B",
        "Baggage" => "334"
    ),
    array(
        "Departure" => "Mashhad",//5
        "Arrival" => "Hormozgan",
        "Transportation" => "Plane",
        "TransportationNumber" => "SK456",
        "Seat" => "3A",
        "Gate" => "45B",
        "Baggage" => "334"
    ),
    array(
        "Departure" => "Shiraz", // 3
        "Arrival" => "Hamedan",
        "Transportation" => "Bus"
    ),
];


// map a route
$router->map('GET', '/sort', function (ServerRequestInterface $request) use ($tickets) : array {

    $analyzer = new \App\Services\AnalyzeRoute();
    return $analyzer->sort($tickets);

});

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);


