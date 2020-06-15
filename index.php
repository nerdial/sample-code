<?php

//require __DIR__ . '/vendor/autoload.php';

include_once 'src/Helpers/AnalyzeRoute.php';

$routes = [
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

$analyzer = new \Helpers\AnalyzeRoute();
$sortedRoutes = $analyzer->sort($routes);

