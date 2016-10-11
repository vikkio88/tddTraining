<?php

use App\Availability;
use App\VillaService;
use App\FlightService;

class AvailabilityTests extends PHPUnit_Framework_TestCase
{
    const WEEK = 26;
    const YEAR = 2016;

    private function getAvailability($flightReturn, $villaReturn)
    {
        $flightsService = new FlightStub($flightReturn);
        $villaService = new VillaStub($villaReturn);

        return new Availability($flightsService, $villaService);
    }

    public function testVillasAreReturnedWhenVillasAndFlightsAreBothAvailable()
    {
        $availability = $this->getAvailability(true, ['Villa 1', 'Villa 2']);

        $result = $availability->get(self::WEEK, self::YEAR);
        $this->assertEquals(['Villa 1', 'Villa 2'], $result);
    }

    public function testVillasAreNotReturnedWhenVillasAreAvailableButFlightsAreNot()
    {
        $availability = $this->getAvailability(false, ['Villa 1', 'Villa 2']);

        $result = $availability->get(self::WEEK, self::YEAR);
        $this->assertEmpty($result);
    }

    public function testVillasAreNotReturnedWhenVillasAreNotAvailableButFlightsAre()
    {
        $availability = $this->getAvailability(true, []);

        $result = $availability->get(self::WEEK, self::YEAR);
        $this->assertEmpty($result);
    }
}

class VillaStub implements VillaService
{
    private $villas = [];

    public function __construct($villas)
    {
        $this->villas = $villas;
    }

    public function getVillas($week, $year)
    {
        return $this->villas;
    }
}

class FlightStub implements FlightService
{
    private $available;

    public function __construct($available)
    {
        $this->available = $available;
    }

    public function isAvailable($week, $year)
    {
        return $this->available;
    }
}
