<?php
/**
 * Created by PhpStorm.
 * User: vikkio88
 * Date: 28/09/16
 * Time: 14:11
 */

namespace App;



use App\Interfaces\Member;
use App\Interfaces\Title;

class Library
{
    private $titles = [];
    private $newTitles = [];

    public function getAllTitles()
    {
        return $this->titles;
    }

    /**
     * @param Title $title
     * @param Member $donor
     */
    public function donateTitle(Title $title, Member $donor)
    {
        $this->titles[] = $title;
        $this->newTitles[] = $title;

        $title->registerCopy();
        $donor->addPoints(10);
    }

    public function getNewTitles()
    {
        return $this->newTitles;
    }
}