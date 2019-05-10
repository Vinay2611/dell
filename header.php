<?php


if(!isset($_SESSION))
{
    session_start();
}
if (isset($_SESSION['users_id']) && !empty($_SESSION['users_id'])){
    $users_id  = $_SESSION['users_id'];
    $user_type  = $_SESSION['user_type'];
    $team_id  = $_SESSION['team_id'];
    $first_name  = $_SESSION['first_name'];
    $last_name  = $_SESSION['last_name'];
    $reporting_manager  = $_SESSION['reporting_manager'];

    //Include database
    include 'config/db.php';

}else{
    header("Location: login.php");
}


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dellemc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/dellemc.css">
    <link rel="stylesheet" href="assets/css/style.css?v=1.0">
    <link rel="stylesheet" href="assets/css/custom.css?v=1.0">
    <link href="assets/css/nav-sections.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/js/datepicker/jquery-ui.css">

    <script src="assets/js/jquery-2.2.3.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/jquery.mycart.js"></script>
    <script src="assets/js/functions.js?v=1.0"></script>
    <script src="assets/js/serverjs.js?v=1.0"></script>
    <script src="assets/js/claim.js?v=1.0"></script>
    <script src="assets/js/cycle/jquery.cycle2.min.js"></script>
    <script src="assets/js/datepicker/jquery-ui.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
</head>

<body>
