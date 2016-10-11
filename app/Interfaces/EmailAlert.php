<?php

namespace App\Interfaces;


interface EmailAlert
{
    public function send(Title $title);

}