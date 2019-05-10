<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='vinayj' || $_SERVER['HTTP_HOST']== "192.168.1.173" || $_SERVER['HTTP_HOST']== "192.168.0.225" ||	$_SERVER['HTTP_HOST']=="127.0.0.1" || $_SERVER['HTTP_HOST']=="192.168.1.1"  || $_SERVER['HTTP_HOST']=="[::1]") {
    //Localhost
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "dell_new";
} else {
    //Server
    $servername = "localhost";
    $username = "shobizie_dell";
    $password = "bI@tXz$3";
    $database = "shobizie_dell";
}


// Create connection
$db = new mysqli( $servername, $username, $password, $database );

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

define("email", "isip@shobiziems.com");


include_once 'functions.php';
/*include_once 'data.php';*/

date_default_timezone_set('Asia/Kolkata');

?>