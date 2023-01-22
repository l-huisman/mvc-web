<?php

class UserRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function retrieveUser($user_ID)
    {
        $stmt = $this->connection->prepare("SELECT * FROM User WHERE User_ID = :user_ID");
        $stmt->bindParam(':user_ID', $user_ID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return null;
        }
        return new User($result['User_ID'], $result['username'], $result['email'], $result['password'], $result['type'], $result['Campaign_ID']);
    }

    public function findByEmail($email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM User WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return null;
        }
        return new User($result['User_ID'], $result['username'], $result['email'], $result['password'], $result['type'], $result['Campaign_ID']);
    }

    public function save(User $user)
    {
        if ($user->getUserid()) {
            return $this->update($user);
        }
        return $this->insertUser($user);
    }

    private function update(User $user)
    {
        $stmt = $this->connection->prepare("UPDATE User SET username = :username, email = :email, password = :password, usertype = :usertype WHERE User_ID = :User_ID");
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':type', $user->getType());
        $stmt->bindValue(':User_ID', $user->getUserid());
        return $stmt->execute();
    }

    public function insertUser(User $user) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO User (username, email, password, type, Campaign_ID) VALUES (:username, :email, :password, :type , :Campaign_ID)");
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':type', $user->getType());
            $stmt->bindValue(':Campaign_ID', null);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}
