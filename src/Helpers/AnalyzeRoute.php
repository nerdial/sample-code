<?php

namespace Helpers;

class AnalyzeRoute
{
    public function sort(array $routes)
    {
        foreach ($routes as $route){
            
            var_dump($route['Arrival']);
            var_dump($route['Departure']);
        }
    }
}