<?php

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

if (isset($_POST['leave'])) {
    $campaignService->removePlayer($user->getUserId());
    $_SESSION['user'] = $userService->retrieveUser($user->getUserId());
    echo "<meta http-equiv='refresh' content='0'>";
}

$campaign = null;

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
                                <button class='btn btn-danger mt-3 w-100' id="leave" type='button' onclick="areYouSure()" name='leave' <?php if ($campaign == null) { echo "disabled"; } ?>>Leave</button>
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
                            <?php echo "To be determined..."; ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-center text-md-start text-light">
            <div class="card h-100 bg-dark">
                <div class="card-body">
                    <div class="text-center d-flex flex-column justify-content-center">
                        <form id="availability-form" action="submit-availability.php" method="post">
                            <table id="calendar"></table>
                            <button type="submit" class="btn align-self-end mt-3 btn-primary">Submit Availability</button>
                            <div id="selected-data"></div>
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
    // Get the form element
    var form = document.getElementById("availability-form");

    // Add a submit event listener to the form
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // prevent the form from submitting
        // Get the selected timeblocks
        var selectedTimeblocks = [];
        var rows = calendar.rows;
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].cells;
            for (var j = 1; j < cells.length; j++) {
                if (cells[j].style.backgroundColor === "lightblue") {
                    var date = currentWeek[j - 1].toJSON().slice(0, 10);
                    selectedTimeblocks.push({
                        date: date,
                        time: cells[0].innerHTML
                    });
                }
            }
        }


        // Convert the selected timeblocks to a JSON object
        var data = JSON.stringify({
            timeblocks: selectedTimeblocks
        });

        // Get the selected-data div
        var selectedData = document.getElementById("selected-data");
        // update it's innerHTML
        selectedData.innerHTML = data;
        // Send a POST request to the server with the selected data
        fetch("submit-availability.php", {
                method: "POST",
                body: data,
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.text())
            .then(result => {
                console.log(result);
            })
            .catch(error => {
                console.error("Error:", error);
            });
    });
</script>