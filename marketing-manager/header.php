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
}else{
    //header("Location: login.php");
}
//Include database
include '../config/db.php';


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dellemc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAADQoDoAwahSAOr4/wDr+/8A49KPAOO9UQCvehIA5rtUAP7/3gD0//kA4bpsAPP+/wD4+P8A+//wAP31/wD/9vkA//X/AP3/+QDbqkYA//j/AP/6/AD9/v8A//v/ANGmZwD//v8ArIsqAP/yuADgwYoA4MeBAMq5agD/4tkA//HHAP/5xAD12bYA//fiAMStYgD//uUAsH0cAOzOnwDUkBUA///xAP/99ADmuXwA/+y5AM2vaACedBQA+v+zAPjq1wDlxXwA5sV8ANzFlwDkxY4A4//7AP/00QD/9tcA//vUAK55EQDuxY4ArXsXAMukWgC1fAgAz6pIAP/hqwD//+AA/c5zAPv/8gD99P4A+P/7AP//8gD7//sA26pIAP//+wDcpVQAybhpAMOYSQDhwYwA/+/MAMGpTwDPnEwApn4YAJ6CJACshAYA9fnzAP7y8AD2/fYA9vr/APT//AD3+v8A+Pr/APb9/wD1q10A///qAPr++QD4//wA+/r/APr9/wD/+/kA//f/AMrNlgD/+v8A6N2hAP/jxACvmAwA//3/AMC1fADGoS8A2MqWAK2SMADRlUEA6KdSAKR5HAD//8cAyqNZAOzPigDwzY0A7M+cANSYbgD///QA8uCHAN6tQQCsjCgA/+7LAOfQhQD0+u8A//jgAP/65gD5/fgA+P/+AP/89QD///UA//77AP///gDHoTEAxJ9PAOj2/wDw9fMA1MBpAOz8/wDQnkwAuZk1APb5/wC5mDsA///kAPP//wD4+f8A9v//AP32/wD/9v8A//7zAP7/9gC6gA8A//n/AP/8/wDmuH4A5L5+AP///wDkv4EA3r2WAM2eMgChfw0A3I8yAP/31gD/7eUA1ppBAN22ZwDRrDgA7//3AP/83AD2/PcA4LV2AP//5QCrgh8Aro4NAP3/9wD+//cA///3ANymUwDBhwoA//HOAOPQfwCShSkA6cSIAMOAKwDu9/sA7//4APr/+AD6/fsA/9+9AP3/+ADfqjwAza5jAP//+AC9hQ4A6t+jAMiyeADIozEA2MmYALiFKQDjxYwA4rZFAO7u/ACteAMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADnWufiS1O4WFcJxbUpUokq+oY0tuHWRMecFJLTMWVIERlwHDNRMTgoKTk7KlTWOtuRuEFAO4kVVVkaaJYGnGezerNoa6KLwVFbwoXAKhTx+IwhQ0EQybjw+iXlgLyKRooC9yMbtCcQS/nRx2MDkao1GqvSOsd8A9ADwsB8WaCLE6KW0+nsladMeWHkBsdaolJyCLnwpvjXoutCuzSr+ntr4yFodTE0e3YZiMWXV1YgVlUJcJDZuDg4ODGEFWl2shGE4XQ4+DGBgYGBiPXamKg399ZioQGF9XV18YEJlmfX8YkHxIGcQ/jo4/aniwIgyYRBhFgCZGOAYGOBJzlEVngQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" />-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/dellemc.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/custom.css?v=0">
    <link href="../assets/css/nav-sections.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/serverjs.js"></script>
    <script src="../assets/js/cycle/jquery.cycle2.min.js"></script>
</head>

<body>
