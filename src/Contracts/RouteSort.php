<?php

namespace App\Contracts;

interface RouteSort
{

    public function sort(array $list): array;
}