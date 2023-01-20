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
        $stmt = $this->connection->prepare("SELECT * FROM User WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new User($result['User_ID'], $result['username'], $result['email'], $result['password'], $result['type']);
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
        $stmt = $this->connection->prepare("UPDATE User SET username = :username, email = :email, password = :password, usertype = :usertype, availability = :availability WHERE User_ID = :User_ID");
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':usertype', $user->getType());
        $stmt->bindValue(':User_ID', $user->getUserid());
        return $stmt->execute();
    }


    private function insert(User $user)
    {
        $stmt = $this->connection->prepare("INSERT INTO User (username, email, password, usertype, availability) VALUES (:username, :email, :password, :usertype, :availability)");
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':usertype', $user->getType());
        $stmt->execute();
        $user->setUserid($this->connection->lastInsertId());
        return $user->getUserid();
    }
}
