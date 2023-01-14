<?php

class UserRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function findByEmail($email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function save(User $user)
    {
        if ($user->getUserid()) {
            return $this->update($user);
        }
        return $this->insert($user);
    }

    private function update(User $user)
    {
        $stmt = $this->connection->prepare("UPDATE user SET username = :username, email = :email, password = :password, usertype = :usertype, availability = :availability WHERE userid = :userid");
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':usertype', $user->getType());
        $stmt->bindValue(':availability', $user->getAvailability());
        $stmt->bindValue(':userid', $user->getUserid());
        return $stmt->execute();
    }


    private function insert(User $user)
    {
        $stmt = $this->connection->prepare("INSERT INTO user (username, email, password, usertype, availability) VALUES (:username, :email, :password, :usertype, :availability)");
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':usertype', $user->getType());
        $stmt->bindValue(':availability', $user->getAvailability());
        $stmt->execute();
        $user->setUserid($this->connection->lastInsertId());
        return $user->getUserid();
    }
}