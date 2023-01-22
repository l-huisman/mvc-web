<?php

include_once '/app/repositories/CampaignRepository.php';

class CampaignService
{
    private $campaignRepository;

    public function __construct($connection)
    {
        $this->campaignRepository = new CampaignRepository($connection);
    }
    
    public function retrieveCampaign($campaign_ID)
    {
        return $this->campaignRepository->retrieveCampaign($campaign_ID);
    }

    public function createCampaign($user_ID, $campaignName)
    {
        $this->campaignRepository->createCampaign($user_ID, $campaignName);
    }

    public function deleteCampaign($user_ID, $campaign_ID)
    {
        $this->campaignRepository->deleteCampaign($user_ID, $campaign_ID);
    }

    public function addPlayer($user_ID, $campaign_ID)
    {
        $this->campaignRepository->addPlayer($user_ID, $campaign_ID);
    }
}
