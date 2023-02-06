<?php

class BaseRepository
{
    protected $connection;

    public function __construct()
    {
        $this->getConnection();
    }

    public function getConnection()
    {
        # Include config file
        require_once __DIR__ . "/dbconfig.php";

        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
