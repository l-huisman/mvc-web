<?php
class Home extends Controller
{
    function index() {
        // load the index template from the views folder
        include "../app/views/home/index.php";
    }
}