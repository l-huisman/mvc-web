<?php
require_once "/app/models/User.php";
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
        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new Exception("Invalid email or password");
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

    public function register($username, $email, $password, $type) {
        $hashedPassword = $this->hashPassword($password);
        $user = new User(0, $username, $email, $hashedPassword, $type);
        $this->userRepository->insertUser($user);
    }


    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

}
