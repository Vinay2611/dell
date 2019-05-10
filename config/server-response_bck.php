<?php
/**
 * Created by Vinay Jaiswal.
 * User: Toyota
 * Date: 26-02-2019
 */

//Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Include database
include 'db.php';

//Users registration
if(isset($_POST['type']) && $_POST['type'] == "Registration")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d H:i:s');

    //Validate users
    $check_user = "SELECT * FROM `users` WHERE `email` = '$email'";
    $sel_user = $db->query( $check_user );
    if($sel_user->num_rows > 0){
        if( $sel_user ){
            $msg  = "Users is already submitted.Please check different email address.";
        }
    }else{
        //insert query
        $sql = "INSERT INTO `users`( `first_name`, `last_name`, `employee_id`, `email`, `password`, `user_type`, `team_id` ) VALUES ( '$first_name', '', '$employee_id', '$email', '$password', '', '$team_id' )";
        $insert = $db->query( $sql );
        if( $insert ){
            $success = true;
            $msg  = "Users added successfully.";
        }else{
            $msg = "Something went wrong.Please try again later.";
        }
    }

    $data = array( 'msg' => $msg, 'success' => $success  );

    echo json_encode($data);
}

//Login
if(isset($_POST['type']) && $_POST['type'] == "Login")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d H:i:s');

    //Validate users
    $check_user = "SELECT * FROM `users` WHERE `email` = '$email'";
    $query = $db->query( $check_user );
    $num_row = $query->num_rows;
    if( $num_row > 0)
    {
        $row = $query->fetch_assoc();
        //$row = mysqli_fetch_array($query);
        if($row['status'] == 'Active')
        {
            if ($password ==  $row['password'])
            {
                $_SESSION['users_id'] = $row['users_id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_type'] = $row['user_type'];
                $data = array( "valid" => 1, "message" => "Logged in successfully" );
            }
            else
            {
                $data = array( "valid" => 0, "message" => "Incorrect credentials" );
            }
        }
        else
        {
            $data = array( "valid" => 0, "message" => "Account not active contact administrator" );
        }
    }
    else
    {
        $data = array( "valid" => 0, "message" => "Users not register with us" );
    }


    echo json_encode($data);
}

//Dell
if(isset($_POST['type']) && $_POST['type'] == "Claim")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d H:i:s');

    //insert query
    $sql = "INSERT INTO `order`(  `contest_id`, `price`, `users_id`, `url` ) VALUES ( '$contest_id', '$budget', '$users_id', '$url' )";
    $insert = $db->query( $sql );
    if( $insert ){
        $success = true;
        $msg  = "Order placed successfully.";
    }else{
        $msg = "Something went wrong.Please try again later.";
    }

    $data = array( 'msg' => $msg, 'success' => $success  );

    echo json_encode($data);
}


$db->close();