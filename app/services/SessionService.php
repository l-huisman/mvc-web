<?php

include_once '/app/repositories/SessionRepository.php';

class SessionService
{
    private $sessionRepository;

    public function __construct($connection)
    {
        $this->sessionRepository = new SessionRepository($connection);
    }

    public function addAvailabillity($campaignId)
    {
        $this->sessionRepository->addAvailabillity($campaignId);
    }
}