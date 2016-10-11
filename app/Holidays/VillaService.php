<?php
/**
 * Created by PhpStorm.
 * User: vikkio88
 * Date: 28/09/16
 * Time: 11:03
 */

namespace App;


interface VillaService
{
    public function getVillas($week, $year);
}