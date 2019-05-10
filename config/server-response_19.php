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

//Global variable
$users_id  = $_SESSION['users_id'];
$message = '';
$success = false;
$data = array();
$today_date = date('Y-m-d');
$today_time = date('H:i:s');
$date_time = date('Y-m-d H:i:s');

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
            $msg  = "User is already register.Please check with different email address.";
        }
    }else{
        //Escape string
        $first_name = $db->real_escape_string($first_name);
        $last_name = $db->real_escape_string($last_name);

        //insert query
        $sql = "INSERT INTO `users`( `first_name`, `last_name`, `employee_id`, `email`, `password`, `user_type`, `team_id`, `reporting_manager` ) VALUES ( '$first_name', '$last_name', '$employee_id', '$email', '$password', '$user_type', '$team_id', '$reporting_manager' )";
        $insert = $db->query( $sql );
        if( $insert ){
            $success = true;
            $msg  = "Your application is sent for approval. Your will receive email after it is approved.";
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
    $user_type = '';
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
                $_SESSION['team_id'] = $row['team_id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['reporting_manager'] = $row['reporting_manager'];
                $user_type = $_SESSION['user_type'];
                $data = array( "valid" => 1, "message" => "Logged in successfully", 'user_type' => $user_type );
            }
            else
            {
                $data = array( "valid" => 0, "message" => "Incorrect credentials" );
            }
        }
        else
        {
            $data = array( "valid" => 0, "message" => "Your account is not yet active, you will receive email after it is approved." );
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
    // generating order id
    $ddmm = date('dm');
    $year = date('y');

    //
    $sql_query = "SELECT Auto_increment FROM information_schema.tables WHERE table_name='order' AND table_schema='dell'";
    $fire_query = $db->query( $sql_query );
    $ext_query = $fire_query->fetch_assoc();
    $o_id = $ext_query['Auto_increment'];


    $order_id = $ddmm."-".$year.$o_id."-".$users_id;
    //$order_id = uniqid();

    //insert query
    $sql = "INSERT INTO `order`( `order_id`, `contest_id`, `price`, `users_id`, `url`, `url1`, `url2`, `url3`, `url4` ) VALUES ( '$order_id', '$contest_id', '$budget', '$users_id', '$url', '$url1', '$url2', '$url3', '$url4 ' )";
    $insert = $db->query( $sql );
    if( $insert ){
        $success = true;
        $msg  = "Your request is sent, you will receive email notification.";
    }else{
        $msg = "Something went wrong.Please try again later.";
    }

    $data = array( 'message' => $msg, 'success' => $success );

    echo json_encode($data);
}


//Team
if(isset($_POST['type']) && $_POST['type'] == "TeamClaim")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d H:i:s');
    // generating order id
    $ddmm = date('dm');
    $year = date('y');

    //
    $sql_query = "SELECT Auto_increment FROM information_schema.tables WHERE table_name='order' AND table_schema='dell'";
    $fire_query = $db->query( $sql_query );
    $ext_query = $fire_query->fetch_assoc();
    $o_id = $ext_query['Auto_increment'];


    $order_id = $ddmm."-".$year.$o_id."-".$users_id;

    //insert query
    $sql = "INSERT INTO `order`( `order_id`, `contest_id`, `price`, `users_id`, `order_type` ) VALUES ( '$order_id', '$contest_id', '$budget', '$users_id', '$order_type' )";
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


//Claim Request
if(isset($_POST['type']) && $_POST['type'] == "ClaimClubRequest")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d');
    // generating order id
    $ddmm = date('dm');
    $year = date('y');
    $shipping_address = $db->real_escape_string($shipping_address);
    $remarks = $db->real_escape_string($remarks);

    $contest_id = implode(',', $contest_id );

    //foreach ($contest_id as $key => $con_id){
        //
        /*$sql_query = "SELECT Auto_increment FROM information_schema.tables WHERE table_name='order' AND table_schema='dell'";
        $fire_query = $db->query( $sql_query );
        $ext_query = $fire_query->fetch_assoc();
        $o_id = $ext_query['Auto_increment'];*/

        $order_number = $ddmm."-".$year."-".$users_id;
        //$order_id = uniqid();

        //insert query
         $sql = "INSERT INTO `orders`( `order_number`, `contest_id`, `users_id`,  `order_status`, `shipping_address`, `city`, `pincode`, `remark`, `order_date`  ) VALUES ( '$order_number', '$contest_id', '$users_id', 'Pending', '$shipping_address', '$city', '$pincode', '$remarks', '$date' )";
        $insert = $db->query( $sql );
        if( $insert ){
            echo $order_id = $db->insert_id;
            if ( $product_1 != '' &&  $website_1 != '' && $url_1 != ''  ){
                echo $sql1 = "INSERT INTO `order_details`( `order_id`, `order_number`, `product`, `brand_details`, `size`, `price`, `url`, `website`, `order_status` ) VALUES ( '$order_id', '$order_number', '$product_1', '$brand_1', '$size_1', '$price_1', '$url_1', '$website_1', 'Pending')";
                $insert1 = $db->query( $sql1 );
                $success = true;
                $msg  = "Your request is sent, you will receive email notification.";
            }
            if ( $product_2 != '' &&  $website_2 != '' && $url_2 != ''  ){
                $sql2 = "INSERT INTO `order_details`( `order_id`, `order_number`, `product`, `brand_details`, `size`, `price`, `url`, `order_status`) VALUES ( '$order_id', '$order_number', '$product_2', '$brand_2', '$size_2', '$price_2', '$url_2', '$website_2', 'Pending'  )";
                $insert2 = $db->query( $sql2 );
                $success = true;
                $msg  = "Your request is sent, you will receive email notification.";
            }
            if ( $product_3 != '' &&  $website_3 != '' && $url_3 != '' ){
                $sql3 = "INSERT INTO `order_details`( `order_id`, `order_number`, `product`, `brand_details`, `size`, `price`, `url`, `order_status`) VALUES ( '$order_id', '$order_number', '$product_3', '$brand_3', '$size_3', '$price_3', '$url_3', '$website_3', 'Pending' )";
                $insert3 = $db->query( $sql3 );
                $success = true;
                $msg  = "Your request is sent, you will receive email notification.";
            }
            if ( $product_4 != '' &&  $website_4 != '' && $url_4 != '' ){
                $sql4 = "INSERT INTO `order_details`( `order_id`, `order_number`, `product`, `brand_details`, `size`, `price`, `url`, `order_status`) VALUES ( '$order_id', '$order_number', '$product_4', '$brand_4', '$size_4', '$price_4', '$url_4', '$website_4', 'Pending' )";
                $insert4 = $db->query( $sql4 );
                $success = true;
                $msg  = "Your request is sent, you will receive email notification.";
            }
            if( $product_5 != '' &&  $website_5 != '' && $url_5 != '' ){
                $sql5 = "INSERT INTO `order_details`( `order_id`, `order_number`, `product`, `brand_details`, `size`, `price`, `url`, `order_status`) VALUES ( '$order_id', '$order_number', '$product_1', '$brand_5', '$size_5', '$price_5', '$url_5', '$website_5', 'Pending' )";
                $insert5 = $db->query( $sql5 );
                $success = true;
                $msg  = "Your request is sent, you will receive email notification.";
            }
        }else{
            $msg = "Something went wrong.Please try again later.";
        }
    //}

    $data = array( 'message' => $msg, 'success' => $success );

    echo json_encode($data);
}

//Claim Request
if(isset($_POST['type']) && $_POST['type'] == "ClaimClubTeamRequest")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d H:i:s');
    // generating order id
    $ddmm = date('dm');
    $year = date('y');

    $file_name = '';
    $file_name1 = '';
    $file_name2 = '';
    $file_name3 = '';
    $file_name4 = '';
    $contest_id = implode(',', $contest_id );
    $location = $db->real_escape_string( $location );
    $kind_of_activity = $db->real_escape_string( $kind_of_activity );

    //Document image
    if(isset($_FILES['document']) && !empty($_FILES['document']['name'])){

        $errors = array();
        $file_name = $_FILES['document']['name'];
        $file_size = $_FILES['document']['size'];
        $file_tmp = $_FILES['document']['tmp_name'];
        $file_type = $_FILES['document']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        //$file_ext = strtolower(end(explode('.',$_FILES['uploads']['name'])));
        $expensions = array("jpeg","jpg","png","JPEG","pdf","doc","docs","docx");
        //var_dump($file_ext);


        if(in_array($file_ext,$expensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 5242880) { //25MB = 26214400  // 2MB = 2097152 // 1MB = 1,048,576 bytes 5MB = 5242880
            $errors[]='File size must be exactly 5 MB';
        }

        if(empty($errors)==true) {
            $file_name = rand_str(10).".".$file_ext;
            move_uploaded_file($file_tmp,"../uploads/".$file_name);

        }else{
            $msg = "Something went wrong.Please try again later";
        }
    }

    if(isset($_FILES['hr_approval']) && !empty($_FILES['hr_approval']['name'])){

        $errors = array();
        $file_name1 = $_FILES['hr_approval']['name'];
        $file_size1 = $_FILES['hr_approval']['size'];
        $file_tmp1 = $_FILES['hr_approval']['tmp_name'];
        $file_type1 = $_FILES['hr_approval']['type'];
        $file_ext1 = strtolower(pathinfo($file_name1, PATHINFO_EXTENSION));
        //$file_ext = strtolower(end(explode('.',$_FILES['uploads']['name'])));
        $expensions1 = array("jpeg","jpg","png","JPEG","pdf","doc","docs","docx");
        //var_dump($file_ext);


        if(in_array($file_ext1,$expensions1)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size1 > 5242880) { //25MB = 26214400  // 2MB = 2097152 // 1MB = 1,048,576 bytes 5MB = 5242880
            $errors[]='File size must be exactly 5 MB';
        }

        if(empty($errors)==true) {
            $file_name1 = rand_str(10).".".$file_ext1;
            move_uploaded_file($file_tmp,"../uploads/".$file_name1);

        }else{
            $msg = "Something went wrong.Please try again later";
        }
    }

    if(isset($_FILES['geo_head_approval']) && !empty($_FILES['geo_head_approval']['name'])){

        $errors = array();
        $file_name2 = $_FILES['geo_head_approval']['name'];
        $file_size2 = $_FILES['geo_head_approval']['size'];
        $file_tmp2 = $_FILES['geo_head_approval']['tmp_name'];
        $file_type2 = $_FILES['geo_head_approval']['type'];
        $file_ext2 = strtolower(pathinfo($file_name2, PATHINFO_EXTENSION));
        $expensions2 = array("jpeg","jpg","png","JPEG","pdf","doc","docs","docx");
        //var_dump($file_ext);


        if(in_array($file_ext2,$expensions2)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size2 > 5242880) { //25MB = 26214400  // 2MB = 2097152 // 1MB = 1,048,576 bytes 5MB = 5242880
            $errors[]='File size must be exactly 5 MB';
        }

        if(empty($errors)==true) {
            $file_name2 = rand_str(10).".".$file_ext2;
            move_uploaded_file($file_tmp,"../uploads/".$file_name2);

        }else{
            $msg = "Something went wrong.Please try again later";
        }
    }

    if(isset($_FILES['upload_pi']) && !empty($_FILES['upload_pi']['name'])){

        $errors = array();
        $file_name3 = $_FILES['upload_pi']['name'];
        $file_size3 = $_FILES['upload_pi']['size'];
        $file_tmp3 = $_FILES['upload_pi']['tmp_name'];
        $file_type3 = $_FILES['upload_pi']['type'];
        $file_ext3 = strtolower(pathinfo($file_name3, PATHINFO_EXTENSION));
        //$file_ext = strtolower(end(explode('.',$_FILES['uploads']['name'])));
        $expensions3 = array("jpeg","jpg","png","JPEG","pdf","doc","docs","docx");
        //var_dump($file_ext);


        if(in_array($file_ext3,$expensions3)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size3 > 5242880) { //25MB = 26214400  // 2MB = 2097152 // 1MB = 1,048,576 bytes 5MB = 5242880
            $errors[]='File size must be exactly 5 MB';
        }

        if(empty($errors)==true) {
            $file_name3 = rand_str(10).".".$file_ext3;
            move_uploaded_file($file_tmp,"../uploads/".$file_name3);

        }else{
            $msg = "Something went wrong.Please try again later";
        }
    }

    if(isset($_FILES['upload_invoice']) && !empty($_FILES['upload_invoice']['name'])){

        $errors = array();
        $file_name4 = $_FILES['upload_invoice']['name'];
        $file_size4 = $_FILES['upload_invoice']['size'];
        $file_tmp4 = $_FILES['upload_invoice']['tmp_name'];
        $file_type4 = $_FILES['upload_invoice']['type'];
        $file_ext4 = strtolower(pathinfo($file_name4, PATHINFO_EXTENSION));
        //$file_ext = strtolower(end(explode('.',$_FILES['uploads']['name'])));
        $expensions4 = array("jpeg","jpg","png","JPEG","pdf","doc","docs","docx");
        //var_dump($file_ext);


        if(in_array($file_ext4,$expensions4)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size4 > 5242880) { //25MB = 26214400  // 2MB = 2097152 // 1MB = 1,048,576 bytes 5MB = 5242880
            $errors[]='File size must be exactly 5 MB';
        }

        if(empty($errors)==true) {
            $file_name4 = rand_str(10).".".$file_ext4;
            move_uploaded_file($file_tmp,"../uploads/".$file_name4);

        }else{
            $msg = "Something went wrong.Please try again later";
        }
    }

    $o_id = $contest_type; //$ext_query['Auto_increment'];

    $order_number = $ddmm."-".$year."-".$users_id;

    //insert query
    $sql = "INSERT INTO `team_request`( `order_number`, `team_id`, `users_id`, `contest_id`, `order_type`, `start_date`, `end_date`, `venue`, `amount`, `kind_of_activity`, `document`, `hr_approval`, `geo_head_approval`, `upload_pi`, `upload_invoice`, `status` ) VALUES ( '$order_number', '$team_id', '$users_id', '$contest_id','$order_type', '$start_date', '$end_date', '$location', '$amount', '$kind_of_activity', '$file_name', '$file_name1', '$file_name2', '$file_name3', '$file_name4', 'Pending' )";
    $insert = $db->query( $sql );
    if( $insert ){
        $success = true;
        $msg  = "Your request is sent, you will receive email notification.";
    }else{
        $msg = "Something went wrong.Please try again later.";
    }

    $data = array( 'message' => $msg, 'success' => $success, 'ism' => 'ISM' );

    echo json_encode($data);
}

//Team lead list
if (isset($_POST['type']) && $_POST['type'] == "Team_List"){
    $team_id = $_POST['team_id'];
    $manager = array();
    if (!empty($team_id)){
        //$select = "SELECT th.id,th.team_id,u.users_id,u.first_name,u.last_name FROM `team_head` AS th JOIN `users` AS u ON th.team_id = u.team_id WHERE th.team_id = '$team_id' GROUP BY u.users_id";
        $select = "SELECT th.id,th.team_id,th.users_id,u.users_id,u.first_name,u.last_name FROM `team_head` AS th JOIN `users` AS u ON th.team_id = u.team_id WHERE th.team_id = '$team_id' AND th.users_id = u.users_id";
        $query = $db->query( $select );
        if ($query->num_rows > 0){
            while ($row = $query->fetch_assoc()){
                $manager[] = array( 'id' => $row['users_id'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'] );
                $success = true;
                $message = "Reporting list found successfully";
            }
        }
    }
    $data = array( 'msg' => $message, 'success' => $success, 'manager' => $manager );
    echo json_encode( $data );
}


//Login
if(isset($_POST['type']) && $_POST['type'] == "ResetPassword")
{
    $email = $_POST['email'];
    $random_string = '';
    $body = '';
    //Validate users
    $check_user = "SELECT * FROM `users` WHERE `email` = '$email'";
    $query = $db->query( $check_user );
    $num_row = $query->num_rows;
    if( $num_row > 0)
    {
        $row = $query->fetch_assoc();
        if($row['status'] == 'Active')
        {
                $random_string = generateRandomString(6);
                $body = "<h2> New Password: $random_string</h2>";
                $mail = send_mail( "$email" , "" , "Password Reset", "$body" );
                if ($mail){
                    $update = "UPDATE `users` SET `password`='$random_string' WHERE `email`='$email'";
                    $query_up = $db->query($update);
                    if ($query_up){
                        $success = true;
                        $message = "Password reset successfully";
                        $data = array( "valid" => 1, "message" => "Password reset.Please check mail." );
                    }
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


//Team
if(isset($_POST['type']) && $_POST['type'] == "RefundComment")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d H:i:s');
    $comment = $db->real_escape_string($comment);
    //insert query
    $sql = "UPDATE `order_details` SET `comment` = '$comment', `order_status` = 'Return Request'  WHERE `od_id`= '$od_id'";
    $insert = $db->query( $sql );
    if( $insert ){
        $success = true;
        $msg  = "Return request sent successfully.";
    }else{
        $msg = "Something went wrong.Please try again later.";
    }

    $data = array( 'msg' => $msg, 'success' => $success  );

    echo json_encode($data);
}

//
if(isset($_POST['type']) && $_POST['type'] == "ChangeQuarter")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $rewardAmount = 0;
    $balanceAmount = 0;


    //Extract Date
    $hedgeRate = $db->query( "SELECT * FROM `hedge_rate` WHERE `hedge_id` = '$hedge_id'" );
    $rowRate = $hedgeRate->fetch_assoc();
    $from_date = $rowRate['from_date'];
    $to_date = $rowRate['to_date'];


    //Balance amount
    //echo "SELECT SUM(balance_amount) AS balance  FROM `winner` WHERE `users_id` = '$users_id' AND  `dateTime` BETWEEN '$from_date' AND '$to_date' ";
    $selAmount = $db->query( "SELECT SUM(balance_amount) AS balance  FROM `winner` WHERE `users_id` = '$users_id' AND  `dateTime` BETWEEN '$from_date' AND '$to_date' ");
    $extAmount = $selAmount->fetch_assoc();
    if(!empty($extAmount['balance'] )){
        $Amount = $extAmount['balance'];
    }else {
        $Amount = '0';
    }


    //Amount utility
    //echo "SELECT o.order_date,o.order_id,SUM(od.price) as amount,o.users_id FROM `orders` AS o JOIN order_details AS od ON o.order_id=od.order_id  WHERE `users_id` = '$users_id' AND  `order_date` BETWEEN '$from_date' AND '$to_date'";
    $selUtility = $db->query( "SELECT o.order_date,o.order_id,SUM(od.price) as amount,o.users_id FROM `orders` AS o JOIN order_details AS od ON o.order_id=od.order_id  WHERE `users_id` = '$users_id' AND  `order_date` BETWEEN '$from_date' AND '$to_date'");
    $extUtility = $selUtility->fetch_assoc();
    $extUtility['amount'];
    if(!empty($extUtility['amount'] )){
        $Utility = $extUtility['amount'];
    }else {
        $Utility = '0';
    }

    $data = array( 'utility' => $Utility, 'balance' => $Amount  );

    echo json_encode($data);
}


$db->close();