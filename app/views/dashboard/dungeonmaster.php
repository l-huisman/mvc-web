<div class="container-lg mt-4">
    <div class="row align-items-start">
        <div class="col-md-3 pb-3 text-center text-md-start text-light">
            <div class="card h-100 bg-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div style="height:200px;width:200px"><canvas id="payingCustomerChart" width="200" height="200" style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 text-center text-md-start text-light">
            <div class="card h-100 bg-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <form id="availability-form" action="submit-availability.php" method="post">
                            <table id="calendar">
                            </table>
                            <button type="submit" class="btn align-self-end mt-3 btn-primary">Submit Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>