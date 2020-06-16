<?php

namespace App\Services;

use App\Contracts\RouteSort;
use Exception;

/**
 * Class AnalyzeRoute
 * @package Helpers
 */
class AnalyzeRoute implements RouteSort
{

    /**
     * @param array $tickets
     * @return array
     * @throws Exception
     */
    public function sort(array $tickets): array
    {
        // We need to find the first route then we can find other routes by that.
        $startPoint = $this->locateStartPoint($tickets);
        $firstRoute = $tickets[$startPoint];

        unset($tickets[$startPoint]);

        // Reindex the array so we don't have to iterate over starting point
        $remainingTickets = array_values($tickets);
        return $this->sortByStartPoint($firstRoute, $remainingTickets);
    }


    /**
     * @param array $firstRoute
     * @param array $otherTickets
     * @return array
     */
    protected function sortByStartPoint(array $firstRoute, array $otherTickets): array
    {
        $sortedArray[] = $firstRoute;
        $currentDeparture = $firstRoute['Arrival'];
        while (count($otherTickets)) {
            $destinationIndex = $this->findNextItem($currentDeparture, $otherTickets);
            $sortedArray[] = $otherTickets[$destinationIndex];

            $currentDeparture = $otherTickets[$destinationIndex]['Arrival'];
            unset($otherTickets[$destinationIndex]);
            continue;
        }
        return $sortedArray;
    }

    /**
     * @param $currentDestination
     * @param $remainingTickets
     * @return int|string
     */
    protected function findNextItem($currentDestination, $remainingTickets)
    {
        $currentDestination = strtolower($currentDestination);
        foreach ($remainingTickets as $i => $item) {
            $nextDeparture = strtolower($item['Departure']);
            if ($nextDeparture === $currentDestination) {
                return $i;
            }
        }
        return null;
    }

    /**
     * @param array $tickets
     * @return int
     * @throws Exception
     */
    protected function locateStartPoint(array $tickets)
    {
        // For safety we str to lower all strings 
        // So we can make sure everything works smoothly

        for ($i = 0; $i < count($tickets); $i++) {
            $firstDeparture = true;
            $departure = strtolower($tickets[$i]['Departure']);

            for ($j = 0; $j < count($tickets); $j++) {

                if ($i === $j) {
                    // We don't need to compare 2 identical objects
                    continue;
                }
                $arrival = strtolower($tickets[$j]['Arrival']);

                if ($departure === $arrival) {
                    $firstDeparture = false;
                }
            }
            if ($firstDeparture) {
                return $i;
            }
        }
        throw new Exception('There is no starting point defined in your array
            , please make sure at least you have one starting point');
    }
}
