<?php

include_once '../app/models/User.php';
include_once '../app/models/Campaign.php';
include_once '../app/services/UserService.php';
include_once '../app/services/SessionService.php';
include_once '../app/services/CampaignService.php';


# Include config file
require_once "../app/dbconfig.php";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$campaignService = new CampaignService($connection);
$userService = new UserService($connection);
$sessionService = new SessionService($connection);

if (isset($_POST['create'])) {
    $campaignService->createCampaign($user->getUserId(), clean($_POST['new_campaign']));
    $_SESSION['user'] = $userService->retrieveUser($user->getUserId());
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['delete'])) {
    $campaignService->removeAllPlayersFromCampaign($user->getCampaignId());
    $campaignService->deleteCampaign($user->getUserId(), $user->getCampaignId());
    $_SESSION['user'] = $userService->retrieveUser($user->getUserId());
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['add'])) {
    $campaignService->addPlayer(clean($_POST['player_id']), $user->getCampaignId());
    $_SESSION['user'] = $userService->retrieveUser($user->getUserId());
}

if (isset($_POST['remove'])) {
    $campaignService->removePlayer(clean($_POST['player_id']));
    $_SESSION['user'] = $userService->retrieveUser($user->getUserId());
}

if (isset($_POST['choose'])) {
    if (false) {
        print_r($_POST['choose']);
        $sessionService->chooseSession($_POST['choose']);
    }
}

$campaign = null;

if ($user->getCampaignId()) {
    $campaign = $campaignService->retrieveCampaign($user->getCampaignId());
}

function clean($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>

<div class="container-lg mt-4">
    <div class="row align-items-start">
        <div class="col-md-3 pb-3 text-center text-md-start text-light">
            <div class="card my-3 h-100 bg-dark">
                <div class="card-header">
                    <h4 class="card-title d-flex justify-content-center">Campaign</h4>
                    <div class="card-body">
                        <div class="text-center d-flex flex-column justify-content-center">
                            <form id="campaignForm" method="post">
                                <?php
                                if ($campaign == null) {
                                    echo "<h6>Create a new campaign</h6>";
                                    echo "<input class='mt-1' type='text' name='new_campaign' id='new_campaign'>";
                                    echo "<button class='btn btn-primary mt-3' type='submit' name='create'>Create</button>";
                                } else {
                                    echo "<h5 class='mb-3'>Current campaign</h5>";
                                    echo "<h6>";
                                    echo $campaign->getCampaignName();
                                    echo "</h6>";
                                    echo "<button class='btn btn-danger mt-3' onclick=\"areYouSure()\" id='delete' type='button' name='delete'>Delete</button>";
                                    echo "<script src=\"/js/areyousure.js\"></script>";
                                    echo "<hr>";
                                    echo "<h6 class='text-center'>Add players to the campaign</h6>";
                                    echo "<input class='my-2 w-100' type='text' name='player_id' id='player_id'><br>";
                                    echo "<button class='btn btn-success mx-1' type='submit' name='add'>Add</button><button class='btn btn-danger' type='submit' name='remove'>Remove</button>";
                                    echo "<hr>";
                                    echo "<h6 class='text-center'>Players in the campaign</h6>";
                                    echo "<ul class='list-group'>";
                                    foreach ($campaignService->getPlayers($campaign->getCampaignId()) as $player) {
                                        echo "<li class='list-group-item bg-dark text-light'>";
                                        echo $player->getUserId() . ". : ";
                                        echo $player->getUsername();
                                        echo "</li>";
                                    }
                                    echo "</ul>";
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 pb-3 text-center text-md-start text-light">
            <div class="card my-3 h-100 bg-dark">
                <div class="card-header">
                    <h5 class="card-title d-flex justify-content-center">Session date</h5>
                    <div class="card-body">
                        <h6 class="text-center">
                            <form method="post">
                                <?php
                                echo "<ul class='list-group'>";
                                foreach ($sessionService->mostEnteredDates() as $dates) {
                                    $date = $dates['date'];
                                    $time = $dates['time'];
                                    echo "<li class='list-group-item bg-dark text-light'>";
                                    echo $date;
                                    echo " : ";
                                    echo $time;
                                    echo ":00<br>";
                                    echo "<button class='btn btn-success mt-2' type='submit' value='$date' name='choose'>Choose</button>";
                                    echo "</li>";
                                }
                                echo "</ul>";
                                ?>
                            </form>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>