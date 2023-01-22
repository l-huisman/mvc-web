<?php

require_once "/app/repositories/UserRepository.php";

class UserService
{
    private $userRepository;

    public function __construct($connection)
    {
        $this->userRepository = new UserRepository($connection);
    }

    public function retrieveUser($user_ID)
    {
        return $this->userRepository->retrieveUser($user_ID);
    }
}
