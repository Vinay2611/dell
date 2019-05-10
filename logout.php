<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 15-12-2018
 * Time: 18:30
 */

session_start();
session_destroy();
header('location: login.php');