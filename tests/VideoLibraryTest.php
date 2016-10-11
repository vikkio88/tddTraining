<?php

use App\Library;
use App\Interfaces\Title;
use App\Interfaces\Member;

class VideoLibraryTest extends PHPUnit_Framework_TestCase
{
    private $title;
    private $donor;

    public function setUp()
    {
        $this->title = $this->getMock(Title::class);
        $this->donor = $this->getMock(Member::class);
    }

    /**
     * @test
     */
    public function donatedTitlesAreAddedToTheLibrary()
    {
        $library = $this->donateTitle();
        $this->assertContains($this->title, $library->getAllTitles());
    }

    /**
     * @test
     */
    public function donatedTitlesAreAddedToTheLibraryNewTitles()
    {
        $library = $this->donateTitle();
        $this->assertContains($this->title, $library->getNewTitles());
    }

    /**
     * @test
     */
    public function theTitleRegistersARentalCopy()
    {
        $this->title->expects($this->once())->method('registerCopy');
        $this->donateTitle();
    }

    /**
     * @test
     */
    public function pointsAreAwardedWhenDonatingATitle()
    {
        $this->donor->expects($this->once())->method('addPoints')
            ->with($this->equalTo(10));

        $this->donateTitle();
    }

    private function donateTitle()
    {
        $library = new Library();
        $library->donateTitle($this->title, $this->donor);
        return $library;
    }
}
