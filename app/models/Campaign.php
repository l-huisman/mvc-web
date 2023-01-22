<?php

class Campaign
{
    private $campaignid;
    private $campaignname;

    public function __construct($campaignid, $campaignname)
    {
        $this->campaignid = $campaignid;
        $this->campaignname = $campaignname;
    }

    public function getCampaignId()
    {
        return $this->campaignid;
    }

    public function getCampaignName()
    {
        return $this->campaignname;
    }

    public function setCampaignName($campaignname)
    {
        $this->campaignname = $campaignname;
    }

}