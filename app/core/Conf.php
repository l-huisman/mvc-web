<?php
$displayErrors = isset($_GET['displayErrors']) ? $_GET['displayErrors'] : '0'; 

if ( $displayErrors == '1' ) {
    ini_set('display_errors', '1'); 
} else {
    ini_set('display_errors', '0'); 
}
?>