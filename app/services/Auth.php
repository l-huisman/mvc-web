<?php
class Auth
{
    private $userRepository;
    private $session;

    public function __construct(UserRepository $userRepository, Session $session)
    {
        $this->userRepository = $userRepository;
        $this->session = $session;
    }

    public function login($email, $password)
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user && !password_verify($password, $user->getPassword())) {
            throw new Exception("Invalid email or password");
            return;
        }
        $this->session->set("user", $user);
    }

    public function logout()
    {
        $this->session->stop();
    }

    public function isLoggedIn()
    {
        return $this->session->get("user") === true;
    }

    private function setSession()
    {
        if (isset($_SESSION['user'])) {
            // User is logged in, do something
        } else {
            // User is not logged in, redirect to login page
        }
        
    }
}
