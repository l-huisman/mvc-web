<?php

include_once '/app/repositories/SessionRepository.php';

class SessionService
{
    public function addAvailabillity($data, $user_ID)
    {
        // If the data is valid, add it to the database
        $this->sessionRepository->addAvailabillity($data, $user_ID);
    }

    public function chooseSession($data)
    {
        // If the data is valid, add it to the database
        $date = $data['date'];
        $time = $data['time'];
        $this->sessionRepository->chooseSession($date, $time);
    }

    public function mostEnteredDates()
    {
        return $this->sessionRepository->mostEnteredDates();
    }
}
