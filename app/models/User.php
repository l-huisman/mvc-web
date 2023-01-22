<?php
class User
{
    private $userid;
    private $username;
    private $email;
    private $password;
    private $type;
    private $campaign_ID;

    public function __construct($userid, $username, $email, $password, $type, $campaign_ID)
    {
        $this->userid = $userid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
        $this->campaign_ID = $campaign_ID;
    }

    public function getUserId()
    {
        return $this->userid;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCampaignId()
    {
        return $this->campaign_ID;
    }
}
