<?php

require_once "/app/repositories/UserRepository.php";

class UserService
{
    public function retrieveUser($user_ID)
    {
        return $this->userRepository->retrieveUser($user_ID);
    }
}
