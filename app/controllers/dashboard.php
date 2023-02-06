<?php
class Dashboard extends Controller
{
    function index() {
        // load the index template from the views folder
        include "../app/views/dashboard/index.php";

    }

}