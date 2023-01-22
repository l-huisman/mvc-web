<?php

class Session
{
    private $date;
    private $time;

    public function __construct($date, $time)
    {
        $this->date = $date;
        $this->time = $time;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }
    
}