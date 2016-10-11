<?php

namespace App;


class Availability
{
    private $flightsService;
    private $villaService;

    /**
     * Availability constructor.
     * @param $flightsService
     * @param $villaService
     */
    public function __construct(FlightService $flightsService, VillaService $villaService)
    {
        $this->flightsService = $flightsService;
        $this->villaService = $villaService;
    }

    public function get($week, $year)
    {
        if (!$this->flightsService->isAvailable($week, $year)) {
            return [];
        }

        return $this->villaService->getVillas($week, $year);
    }
}