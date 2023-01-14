<?php
class Login extends Controller
{
    function index() {

        // load the index template from the views folder
        include "../app/views/login/index.php";
    }

    function home(){
        // load the index template from the views folder
        include "../app/views/home/index.php";
    }
}