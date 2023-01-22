<?php

include_once '/app/repositories/BaseRepository.php';

class CampaignRepository
{

    private $connection;
    
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function retrieveCampaign($campaign_ID)
    {
        $sql = "SELECT * FROM Campaign WHERE Campaign_ID = :Campaign_ID";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':Campaign_ID', $campaign_ID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Campaign($result['Campaign_ID'], $result['name']);
    }

    public function createCampaign($user_ID, $campaignName)
    {
        $sql = "INSERT INTO `Campaign` (name) VALUES (:name)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $campaignName);
        $stmt->execute();
        $campaign_ID = $this->connection->lastInsertId();
        $this->addPlayer($user_ID, $campaign_ID);
    }

    public function deleteCampaign($user_ID, $campaign_ID)
    {
        $this->deletePlayerFromCampaign($user_ID);
        $sql = "DELETE FROM Campaign WHERE Campaign_ID = :Campaign_ID";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':Campaign_ID', $campaign_ID);
        $stmt->execute();
    }

    # Add a Campaign_ID to the user table in the database to link the user to a campaign they will be found by User_ID
    public function addPlayer($user_ID, $campaign_ID)
    {
        $sql = "UPDATE User SET Campaign_ID = :Campaign_ID WHERE User_ID = :User_ID";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':Campaign_ID', $campaign_ID);
        $stmt->bindParam(':User_ID', $user_ID);
        $stmt->execute();
    }

    public function deletePlayerFromCampaign($user_ID)
    {
        $sql = "UPDATE User SET Campaign_ID = NULL WHERE User_ID = :User_ID";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':User_ID', $user_ID);
        $stmt->execute();
    }
}