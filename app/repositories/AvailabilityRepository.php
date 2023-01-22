<?php

class AvailabilityRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
}