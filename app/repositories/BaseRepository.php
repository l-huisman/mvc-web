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
        require_once "/app/dbconfig.php";

        try {
            $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }
}
