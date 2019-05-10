<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 20-03-2019
 * Time: 17:11
 */
 
 if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']== "192.168.1.173" ||	$_SERVER['HTTP_HOST']=="127.0.0.1" || $_SERVER['HTTP_HOST']=="192.168.1.1"  || $_SERVER['HTTP_HOST']=="[::1]") {
	header('Location: http://localhost/dell/login.php');
 }else{
	header('Location: http://www.shobiztech.com/dell/login.php');
 }


//header(location: );