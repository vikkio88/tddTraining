<?php
namespace App;


use App\Interfaces\EmailAlert;

class Title implements \App\Interfaces\Title
{
    private $name;
    private $director;
    private $year;
    private $rentalCopies = 0;
    private $emailAlert;

    public function __construct($name, $director, $year, EmailAlert $emailAlert)
    {
        $this->name = $name;
        $this->director = $director;
        $this->year = $year;
        $this->emailAlert = $emailAlert;
    }

    public function getName()
    {
        return $this->name;
    }

    public function registerCopy()
    {
        $this->rentalCopies++;
        $this->emailAlert->send($this);
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getRentalCopies()
    {
        return $this->rentalCopies;
    }
}