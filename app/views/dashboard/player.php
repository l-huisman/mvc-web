<?php

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
$sessionService = new SessionService($connection);
$userService = new UserService($connection);

if (isset($_POST['leave'])) {
    $campaignService->removePlayer($user->getUserId());
    $_SESSION['user'] = $userService->retrieveUser($user->getUserId());
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['selected-data'])) {
    $selectedData = $_POST['selected-data'];
    $sessionService->addAvailabillity($selectedData, $user->getUserId());
}

$campaign = $session = null;

if ($user->getCampaignId()) {
    $campaign = $campaignService->retrieveCampaign($user->getCampaignId());
}

?>
<div class="container-lg mt-4">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-3 pb-3 text-center text-md-start text-light">
            <div class="card d-flex justify-content-center my-3 h-100 bg-dark">
                <div class="card-header">
                    <h5 class="card-title d-flex justify-content-center">Campaign</h5>
                    <div class="card-body">
                        <div class="text-center d-flex flex-column justify-content-center">
                            <form id="campaignForm" method="post">
                                <h6>
                                    <?php
                                    if ($campaign == null) {
                                        echo "To be determined...";
                                    } else {
                                        echo $campaign->getCampaignName();
                                    }
                                    ?>
                                </h6>
                                <button class='btn btn-danger mt-3 w-100' id="leave" type='button' onclick="areYouSure()" name='leave' <?php if ($campaign == null) { /* enable and disable */
                                                                                                                                        } ?>>Leave</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-3 h-100 bg-dark">
                <div class="card-header">
                    <h5 class="card-title d-flex justify-content-center">Session date</h5>
                    <div class="card-body">
                        <h6 class="text-center">
                            <?php 
                                if ($session == null) {
                                    echo "To be determined...";
                                } else {
                                    echo $session->getSessionDate();
                                }
                            ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-center text-md-start text-light">
            <div class="card h-100 bg-dark">
                <div class="card-body">
                    <div class="text-center d-flex flex-column justify-content-center">
                        <form id="availability-form" method="post">
                            <table id="calendar"></table>
                            <button type="button" id="submit-availabillity" onclick="processAvailabillity()" class="btn align-self-end mt-3 btn-primary" name="submit-availabillity">Submit Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/calendar.js"></script>
<script src="/js/areyousure.js"></script>
<script>
    // create a lister for the submit button
    var submitButton = document.getElementById("submit-availabillity");
    submitButton.addEventListener("click", processAvailabillity);

    function processAvailabillity() {
        // Get the form element
        var form = document.getElementById("availability-form");

        // Get the selected timeblocks
        var selectedTimeblocks = [];
        var rows = calendar.rows;
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].cells;
            for (var j = 1; j < cells.length; j++) {
                if (cells[j].style.backgroundColor === "lightblue") {
                    var date = currentWeek[j - 1].toJSON().slice(0, 10);
                    var time = parseInt(cells[0].innerHTML.slice(0, 2));
                    selectedTimeblocks.push([date, time]);
                }
            }
        }

        // Iterate through the selected timeblocks array
        for (let i = 0; i < selectedTimeblocks.length; i++) {
            let date = selectedTimeblocks[i][0];
            let time = selectedTimeblocks[i][1];
            let input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "selected-data[" + i + "][date]");
            input.setAttribute("value", date);
            form.appendChild(input);
            let input2 = document.createElement("input");
            input2.setAttribute("type", "hidden");
            input2.setAttribute("name", "selected-data[" + i + "][time]");
            input2.setAttribute("value", time);
            form.appendChild(input2);
        }
        form.submit();
    }
</script>