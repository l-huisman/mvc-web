<?php

include_once '/app/repositories/CampaignRepository.php';

class CampaignService
{
    private $campaignRepository;

    public function __construct()
    {
        $this->campaignRepository = new CampaignRepository();
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

    public function removePlayer($user_ID)
    {
        $this->campaignRepository->deletePlayerFromCampaign($user_ID);
    }

    public function getPlayers($campaign_ID)
    {
        return $this->campaignRepository->getPlayers($campaign_ID);
    }

    public function removeAllPlayersFromCampaign($campaign_ID)
    {
        $this->campaignRepository->removeAllPlayersFromCampaign($campaign_ID);
    }
}
