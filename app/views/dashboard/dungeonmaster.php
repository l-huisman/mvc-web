<?php

include_once '../app/models/User.php';
include_once '../app/models/Campaign.php';
include_once '../app/services/UserService.php';
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

if (isset($_POST['create'])) {
    $campaignService->createCampaign($user->getUserId(), clean($_POST['new_campaign']));
    $_SESSION['user'] = $userService->retrieveUser($user->getUserId());
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['delete'])) {
    $campaignService->deleteCampaign($user->getUserId(), $user->getCampaignId());
    $_SESSION['user'] = $userService->retrieveUser($user->getUserId());
    echo "<meta http-equiv='refresh' content='0'>";
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
                            <form method="post">
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
                                    echo "<button class='btn btn-primary mt-3' type='submit' name='delete'>Delete</button>";
                                    echo "<hr>";
                                    echo "<h6 class='text-center'>Add players to the campaign</h6>";
                                    echo "<input class='my-2' type='text' name='new_player' id='new_player'><br>";
                                    echo "<button class='btn btn-primary' type='submit' name='add'>Add</button>";
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-3 h-100 bg-dark">
                <div class="card-header">
                    <h5 class="card-title d-flex justify-content-center">Session date</h5>
                    <div class="card-body">
                        <!-- Standard = "To be determined...", Otherwise checks the database for a session date -->
                        <h6 class="text-center">
                            <?php echo "To be determined..."; ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 pb-3 text-center text-md-start text-light">
            <div class="card h-100 bg-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div style="height:200px;width:200px"><canvas id="payingCustomerChart" width="200" height="200" style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/piechart.js"></script>