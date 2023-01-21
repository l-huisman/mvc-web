<?php
class Login extends Controller
{
    function index() {

        // load login template from the views folder
        $this->login();
    }

    function login() {

        // load the index template from the views folder
        include "../app/views/login/index.php";
    }

    function register() {

        // load the index template from the views folder
        include "../app/views/login/register.php";
    }

    function home(){
        // load the index template from the views folder
        include "../app/views/home/index.php";
    }
}