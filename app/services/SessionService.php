<?php

include_once '/app/repositories/SessionRepository.php';

class SessionService
{
    private $sessionRepository;

    public function __construct($connection)
    {
        $this->sessionRepository = new SessionRepository($connection);
    }

    public function addAvailabillity($data, $user_ID)
    {
        // If the data is valid, add it to the database
        $this->sessionRepository->addAvailabillity($data, $user_ID);
    }
}
