<?php


use App\Interfaces\EmailAlert;
use App\Title;

class TitleTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Title
     */
    private $title;
    private $emailAlert;

    public function setUp()
    {
        $this->emailAlert = $this->getMock(EmailAlert::class);
        $this->title = new Title('Name', 'Cameron', 2001 , $this->emailAlert);
    }

    /**
     * @test
     */
    public function itShouldKnowItsName()
    {

        $this->assertEquals('Name', $this->title->getName());
    }

    /**
     * @test
     */
    public function itShouldKnowItsDirector()
    {
        $this->assertEquals('Cameron', $this->title->getDirector());
    }

    /**
     * @test
     */
    public function itShouldKnowItsReleaseYear()
    {
        $this->assertEquals(2001, $this->title->getYear());
    }

    /**
     * @test
     */
    public function itWillIncrementRentalCountWhenRegistersACopy()
    {
        $this->title->registerCopy();
        $this->assertEquals(1, $this->title->getRentalCopies());
    }

    /**
     * @test
     */
    public function itSendsAnEmailAlertWhenRegisterACopy()
    {
        $this->emailAlert->expects($this->once())->method('send')
            ->with($this->equalTo($this->title));
        $this->title->registerCopy();
    }

}