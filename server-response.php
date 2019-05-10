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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

//Include database
include 'db.php';

//Php mail function
function send_phpmail( $toname, $to ,$fromname, $from , $subject, $body )
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'localhost';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'noreply@shobiztech.com';   // SMTP username
    $mail->Password   = 'noreply@123';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($from, $fromname);
    $mail->addAddress($to, $toname);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo($from, $fromname);
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    if (!$mail->send()) {
        return $mail->ErrorInfo;
    } else {
        return true;
    }
}

function getUserInfo( $userID ){

    global $db;
    $data = array();
    $selUser = $db->query( "SELECT * FROM `users` where `users_id` = '$userID'");
    $rowUser = $selUser->fetch_assoc();
    $firstName = $rowUser['first_name'];
    $lastName = $rowUser['last_name'];
    $emailID = $rowUser['email'];
    $status = $rowUser['status'];
    $data = array( 'first_name' => $firstName , 'last_name' => $lastName , 'email_id' => $emailID, 'status' => $status );
    return $data;

}

function getTodayHedgeRate(){
    global $db;
    $date_time = date('Y-m-d H:i:s');
    $data = array();
    $hedgeRate = $db->query( "SELECT * FROM `hedge_rate` WHERE `from_date` >= '$date_time' AND `to_date` <= '$date_time'" );
    $rowRate = $hedgeRate->fetch_assoc();
    $from_date = $rowRate['from_date'];
    $to_date = $rowRate['to_date'];
    $hedge_rate = $rowRate['hedge_rate'];
    $data = array( 'from_date' => $from_date , 'to_date' => $to_date , 'hedge_rate' => $hedge_rate, 'status' => $status );
    return $data;
}

//Global variable
$users_id  = isset($_SESSION['users_id']) ? $_SESSION['users_id'] : '';
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

        $full_name = $first_name." ".$last_name;

        //insert query
        $sql = "INSERT INTO `users`( `first_name`, `last_name`, `employee_id`, `email`, `password`, `user_type`, `team_id`, `reporting_manager` ) VALUES ( '$first_name', '$last_name', '$employee_id', '$email', '$password', '$user_type', '$team_id', '$reporting_manager' )";
        $insert = $db->query( $sql );
        if( $insert ){

            //Send Mail
            $subject = "New Registration";
            $body = "Hi, $full_name" .'<br><br>'."You are successfully register for Dell incentive program";
            $send = send_phpmail( $full_name, "vinay.jaiswal@shobizexperience.com" ,"Dell", "vinaytech.jaiswal@gmail.com" , $subject , $body );
            if ($send){
                $success = true;
                $msg  = "Your application is sent for approval. Your will receive email after it is approved.";
            }

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
    $msg  = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d');
    // generating order id
    $ddmm = date('dm');
    $year = date('y');

    $remark_1 = $db->real_escape_string(isset($remark_1) ? $remark_1 : '');
    $remark_2 = $db->real_escape_string(isset($remark_2) ? $remark_2 : '');
    $remark_3 = $db->real_escape_string(isset($remark_3) ? $remark_3 : '' );
    $remark_4 = $db->real_escape_string(isset($remark_4) ? $remark_4 : '' );
    $remark_5 = $db->real_escape_string(isset($remark_5) ? $remark_5 : '' );

    $shipping_address = $db->real_escape_string($shipping_address);
    $remarks          = $db->real_escape_string($remarks);

    $contestLen = count($contest_id);
	//Count winning amount
	$contest_id = implode(',', $contest_id );

    $sql_query = "SELECT max(order_id) as maxNum FROM `orders` ";
    $fire_query = $db->query( $sql_query );
    $ext_query = $fire_query->fetch_assoc();
    $o_id = $ext_query['maxNum'] + 1;
    $order_number = $ddmm."-".$year."-".$o_id;

    //isset or not variable product 1
    $product_1 = isset($product_1) ? $product_1 : '';
    $brand_1 = isset($brand_1) ? $brand_1 : '';
    $size_1 = isset($size_1) ? $size_1 : '';
    $url_1 = isset($url_1) ? $url_1 : '';
    $price_1 = isset($price_1) ? $price_1 : '';
    $website_1 = isset($website_1) ? $website_1 : '';

    //isset or not variable product 2
    $product_2 = isset($product_2) ? $product_2 : '';
    $brand_2 = isset($brand_2) ? $brand_2 : '';
    $size_2 = isset($size_2) ? $size_2 : '';
    $url_2 = isset($url_2) ? $url_2 : '';
    $price_2 = isset($price_2) ? $price_2 : '';
    $website_2 = isset($website_2) ? $website_2 : '';

    //isset or not variable product 3
    $product_3 = isset($product_3) ? $product_3 : '';
    $brand_3 = isset($brand_3) ? $brand_3 : '';
    $size_3 = isset($size_3) ? $size_3 : '';
    $url_3 = isset($url_3) ? $url_3 : '';
    $price_3 = isset($price_3) ? $price_3 : '';
    $website_3 = isset($website_3) ? $website_3 : '';

    //isset or not variable product 4
    $product_4 = isset($product_4) ? $product_4 : '';
    $brand_4 = isset($brand_4) ? $brand_4 : '';
    $size_4 = isset($size_4) ? $size_4 : '';
    $url_4 = isset($url_4) ? $url_4 : '';
    $price_4 = isset($price_4) ? $price_4 : '';
    $website_4 = isset($website_4) ? $website_4 : '';

    //isset or not variable product 1
    $product_5 = isset($product_5) ? $product_5 : '';
    $brand_5 = isset($brand_5) ? $brand_5 : '';
    $size_5 = isset($size_5) ? $size_5 : '';
    $url_5 = isset($url_5) ? $url_5 : '';
    $price_5 = isset($price_5) ? $price_5 : '';
    $website_5 = isset($website_5) ? $website_5 : '';

    //insert query
    $sql = "INSERT INTO `orders`( `order_number`, `contest_id`, `users_id`,  `order_status`, `shipping_address`, `city`, `pincode`, `remark`, `order_date`  ) VALUES ( '$order_number', '$contest_id', '$users_id', 'Pending', '$shipping_address', '$city', '$pincode', '$remarks', '$date' )";
    $insert = $db->query( $sql );
    if($insert) {
	    $order_id = $db->insert_id;
		//Pending
        $rewardSql = $db->query("SELECT reward_status FROM `winner` WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
        $rewardRow = $rewardSql->fetch_array();
        $orderTotal = $price_1 + $price_2 + $price_3 + $price_4 + $price_5;

        if($rewardRow['reward_status'] == 'Pending') {
            $amountSql = $db->query("SELECT sum(reward_amount) as winAmount FROM `winner` WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
            $amountRow = $amountSql->fetch_array();
	  
            if($amountRow['winAmount'] == $orderTotal) {
            // update status to reddem
                $updSql = $db->query("UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
            } elseif ( $amountRow['winAmount'] < $orderTotal ){
                $updSql = $db->query("UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
            } else{
            // update status to claimed and divide amount in balance
                $amountBalance = $amountRow['winAmount'] - $orderTotal;
                $updBalance = $amountBalance / $contestLen;
                $updSql = $db->query("UPDATE winner SET  balance_amount='".$updBalance."',reward_status='Claimed' WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
                if($updSql){
	                $success = true;
	                $msg  = "Your order is placed, remaining balance is updated.";
                }
            }
        }
	
        if($rewardRow['reward_status'] == 'Claimed') {
            $balSql = $db->query("SELECT sum(balance_amount) as balance_amount FROM `winner` WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
            $balRow = $balSql->fetch_array();
            if($balRow['balance_amount'] == $orderTotal) {
	            $updSql = $db->query("UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
            } else {
                $amountBalance = $balRow['balance_amount'] - $orderTotal;
                $updBalance2 = $amountBalance / $contestLen;
                $updSql = $db->query("UPDATE winner SET  balance_amount='".$updBalance2."',reward_status='Claimed' WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
	        }
        }

        if ( $product_1 != '' ||  $website_1 != '' || $url_1 != ''  ) {
                
            $sql1 = "INSERT INTO `order_details`( `order_id`, `product`, `brand_details`, `size`, `price`, `url`, `remark`, `website`, `order_status` ) VALUES ( '$order_id', '$product_1', '$brand_1', '$size_1', '$price_1', '$url_1', '$remark_1', '$website_1', 'Pending')";
            $insert1 = $db->query( $sql1 );
            $success = true;
            $msg  = "Your request is sent, you will receive email notification.";
        }
           
        if($product_2 != '' ||  $website_2 != '' || $url_2 != '' ) {
            $sql2 = "INSERT INTO `order_details`( `order_id`, `product`, `brand_details`, `size`, `price`, `url`, `remark`, `website`, `order_status`) VALUES ( '$order_id', '$product_2', '$brand_2', '$size_2', '$price_2', '$url_2', '$remark_2', '$website_2', 'Pending'  )";
            $insert2 = $db->query( $sql2 );
            $success = true;
            $msg  = "Your request is sent, you will receive email notification.";
        }

        if ( $product_3 != '' ||  $website_3 != '' || $url_3 != '' ) {
            $sql3 = "INSERT INTO `order_details`( `order_id`, `product`, `brand_details`, `size`, `price`, `url`, `remark`, `website`, `order_status`) VALUES ( '$order_id', '$product_3', '$brand_3', '$size_3', '$price_3', '$url_3', '$remark_3', '$website_3', 'Pending' )";
            $insert3 = $db->query( $sql3 );
            $success = true;
            $msg  = "Your request is sent, you will receive email notification.";
        }

        if ( $product_4 != '' ||  $website_4 != '' || $url_4 != '' ) {
            $sql4 = "INSERT INTO `order_details`( `order_id`, `product`, `brand_details`, `size`, `price`, `url`, `remark`, `website`, `order_status`) VALUES ( '$order_id','$product_4', '$brand_4', '$size_4', '$price_4', '$url_4', '$remark_4', '$website_4', 'Pending' )";
            $insert4 = $db->query( $sql4 );
            $success = true;
            $msg  = "Your request is sent, you will receive email notification.";
        }

        if( $product_5 != '' ||  $website_5 != '' || $url_5 != '' ) {
            $sql5 = "INSERT INTO `order_details`( `order_id`, `product`, `brand_details`, `size`, `price`, `url`, `remark`, `website`, `order_status`) VALUES ( '$order_id','$product_5', '$brand_5', '$size_5', '$price_5', '$url_5', '$remark_5', '$website_5', 'Pending' )";
            $insert5 = $db->query( $sql5 );
            $success = true;
            $msg  = "Your request is sent, you will receive email notification.";
        }

        //Send Mail
        $user_data = getUserInfo($users_id);
        $email = $user_data['email_id'];
        $full_name = $user_data['first_name'];
        $subject = "New Order placed";
        $body = "Hi, $full_name" .'<br><br>'."You are successfully placed order for Dell incentive program";
        $send = send_phpmail( $full_name, "vinay.jaiswal@shobizexperience.com" ,"Dell", "vinaytech.jaiswal@gmail.com" , $subject , $body );
        if ( $send ){
            $success = true;
            $msg  = "Your application is sent for approval. Your will receive email after it is approved.";
        }
			
    } else {
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

    $file_name  = '';
    $file_name1 = '';
    $file_name2 = '';
    $file_name3 = '';
    $file_name4 = '';
    $contest_id = implode(',', $contest_id );
    $location   = $db->real_escape_string( $location );
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

    $order_number = "TM-".$ddmm."-".$year."-".$users_id;

    //insert query
    $sql = "INSERT INTO `team_request`( `order_number`, `team_id`, `users_id`, `contest_id`, `order_type`, `start_date`, `end_date`, `venue`, `amount`, `kind_of_activity`, `document`, `hr_approval`, `geo_head_approval`, `upload_pi`, `upload_invoice`, `status` ) VALUES ( '$order_number', '$team_id', '$users_id', '$contest_id','$order_type', '$start_date', '$end_date', '$location', '$amount', '$kind_of_activity', '$file_name', '$file_name1', '$file_name2', '$file_name3', '$file_name4', 'Pending' )";
    //$sql = "INSERT INTO `team_request`( `order_number`, `team_id`, `users_id`, `contest_id`, `order_type`, `start_date`, `end_date`, `venue`, `amount`, `document`, `hr_approval`, `geo_head_approval`, `upload_pi`, `upload_invoice`, `status` ) VALUES ( '$order_number', '$team_id', '$users_id', '$contest_id','$order_type', '$start_date', '$end_date', '$location', '$amount', '$file_name', '$file_name1', '$file_name2', '$file_name3', '$file_name4', 'Pending' )";
    $insert = $db->query( $sql );
    if( $insert ){

        //Update winner status
        $updSql = $db->query("UPDATE winner SET  reward_status='Claimed' WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
        //Send Mail
        $user_data = getUserInfo($users_id);
        $email = $user_data['email_id'];
        $full_name = $user_data['first_name'];
        $subject = "New Order placed";
        $body = "Hi, $full_name" .'<br><br>'."You are successfully placed order for Dell incentive program";
        $send = send_phpmail( $full_name, "vinay.jaiswal@shobizexperience.com" ,"Dell", "vinaytech.jaiswal@gmail.com" , $subject , $body );
        if ( $send ){
            $success = true;
            $msg  = "Your application is sent for approval. Your will receive email after it is approved.";
        }

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
        $select = "SELECT th.id,th.team_id,th.users_id,u.users_id,u.first_name,u.last_name FROM `team_head` AS th JOIN `users` AS u ON th.team_id = u.team_id WHERE th.team_id = '$team_id' AND th.users_id = u.users_id AND u.status='Active' ";
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

//Team
if(isset($_POST['type']) && $_POST['type'] == "ReplaceComment")
{
    $msg = '';
    $success = false;
    $data = array();
    extract($_POST);
    $date = date('Y-m-d H:i:s');
    $comment = $db->real_escape_string($comment);
    //insert query
    $sql = "UPDATE `order_details` SET `comment` = '$comment', `order_status` = 'Replacement Request'  WHERE `od_id`= '$od_id'";
    $insert = $db->query( $sql );
    if( $insert ){
        $success = true;
        $msg  = "Replace request sent successfully.";
    }else{
        $msg = "Something went wrong.Please try again later.";
    }

    $data = array( 'msg' => $msg, 'success' => $success  );

    echo json_encode($data);
}

//
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

    //Total amount
    $selAmount = $db->query( "SELECT SUM(reward_amount) AS total_amount  FROM `winner` WHERE `users_id` = '$users_id' AND  `dateTime` BETWEEN '$from_date' AND '$to_date' ");
    $extAmount = $selAmount->fetch_assoc();
    if(!empty($extAmount['total_amount'] )){
        $Amount = $extAmount['total_amount'];
    }else {
        $Amount = '0';
    }

    //Amount utility
    $query_sql = "SELECT 
c.contest_id,c.contest_name,c.start_date,c.end_date,c.status,
c.budget,w.reward_amount,
w.reward_status,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date 
FROM `contest` AS c 
JOIN purchase_order AS po ON c.po_id = po.po_id 
JOIN winner AS w ON c.contest_id = w.contest_id 
JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id 
WHERE c.status = 'Ongoing' 
AND system_status = 'Active' 
AND w.users_id = '$users_id' 
AND w.dateTime 
BETWEEN '$from_date' AND '$to_date' GROUP BY c.contest_id";
    $selUtility = $db->query( $query_sql );
    $amount_utility = 0;
    while ($extUtility = $selUtility->fetch_assoc()){

        $innQUery = $db->query("SELECT o.order_date,o.order_id,SUM(od.price) as amount,od.price,o.users_id FROM `orders` AS o JOIN order_details AS od ON o.order_id=od.order_id  WHERE `users_id` = '$users_id' AND o.contest_id = '".$extUtility['contest_id']."'");
        $extQuery = $innQUery->fetch_assoc();
        $amount_utility += $extQuery['amount'];
        //$extUtility['amount'];
    }

    /*if(!empty($extUtility['amount'] )){
        $Utility = $extUtility['amount'];
    }else {
        $Utility = '0';
    }*/

    //Balance Amount
    $Balance = $Amount - $amount_utility;

    $data = array( 'utility' => $amount_utility, 'balance' => $Balance, 'amount' =>  $Amount );

    echo json_encode($data);
}

if(isset($_POST['type']) && $_POST['type'] == "ChangeQuarter2")
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
	

$userSql = $db->query("SELECT po_id,po_number,po_value,tax,date_format(date_of_po,'%d %M %y') as date_of_po,agency_fee,pm_fee,balance_amount,individual_amount,team_amount,status FROM purchase_order where `date_of_po` BETWEEN '$from_date' AND '$to_date' order  by date_of_po desc");  
		$content = "";

		$content = '<table id="contestTable" class="display dataTable"><thead> <tr >
            <th >Sr.</th>
            <th>PO No. </th>
            <th>Po Amount</th>
            <th>Invoice Amount with tax</th>
            <th>Without agency fee & GST</th>
            <th>Contest Individual</th>
            <th>Contest Team</th>
            <th>Allocated Amount-Individual</th>
            <th>Allocated Amount-Team</th>
            <th>Actual claims process individual</th>
            <th>Actual claims process Team</th>
            <th>Balance from Actual Claims individual</th>
            <th>Balance from Actual Claims Team</th>
            <th>WIP Claims Team</th>
            <th>WIP Claims Team</th>
            <th>Pending claims Individual</th>
            <th>Pending claims Team</th>
            <th>Total</th>
        </tr>';
		$a=1;
		$ind_cnt =0;
		$ind_amt =0;
		$team_cnt =0;
		$team_amt =0;
		while($row = $userSql->fetch_array()) 
		{ 
		  $tot_amt=$row['po_value']+$row['tax'];
		$poSql = $db->query("
SELECT w.type as contest_type,w.reward_status as status,w.contest_id,c.po_id,sum(w.reward_amount) as reward_amount,sum(w.balance_amount) as reward_bal_amount,count(w.winner_id) as winnercnt FROM `winner` as w,contest as c where w.contest_id=c. contest_id and c.po_id='".$row['po_id']."' group by  w.type,w.reward_status");  
    		$ind_cnt =0;
    		$team_cnt =0;
		  while($row2 = $poSql->fetch_array()) 
		  {
		  if ($row2['contest_type']=='Individual')
		  {
			$ind_cnt = $ind_cnt+$row2['winnercnt'];
			$ind_reward_bal_amount=$ind_reward_bal_amount+$row2['reward_bal_amount'];
			if ($row2['status']=='Claimed')
			{
		    $ind_amt =$ind_amt+$row2['reward_amount'];
			}
			if ($row2['status']=='Pending')
			{
		    $ind_pendamt =$ind_pendamt+$row2['reward_amount'];
			}
		  }
		  if ($row2['contest_type']=='Team')
		  {
			$team_cnt = $team_cnt+$row2['winnercnt'];
			$team_reward_bal_amount=$team_reward_bal_amount+$row2['reward_bal_amount'];
			if ($row2['status']=='Claimed')
			{
		    $team_amt =$team_amt+$row2['reward_amount'];
			}
			if ($row2['status']=='Pending')
		    $team_pendamt =$team_pendamt+$row2['reward_amount'];
			}
		  }
		  $content .= '<tr><td align="center">'.$a.'</td><td><a href="show_contest.php?po_no='.$row['po_number'].'&qry_type=PO">'.$row['po_number'].'</a></td><td>'.$row['po_value'].'</a></td><td>'.$tot_amt.'</td><td>'.$row['balance_amount'].'</td><td><a href="show_contest.php?po_no='.$row['po_number'].'&qry_type=POIND&con_type=Individual">'.$ind_cnt.'</a></td><td>
<a href="show_contest.php?po_no='.$row['po_number'].'&qry_type=POTEM&con_type=Team">'.$team_cnt.'</a></td><td align="left">'.$row['individual_amount'].'</td><td align="left">'.$row['team_amount'].'</td><td>'.$ind_amt.'</td><td>'.$team_amt.'</td><td>'.$ind_reward_bal_amount.'</td><td>'.$team_reward_bal_amount.'</td><td>'.$ind_pendamt.'</td><td>'.$team_pendamt.'</td><td>'.$team_pendamt.'</td><td>'.$team_pendamt.'</td>><td>'.$team_pendamt.'</td>';
		$content .='</tr>';
		$a++;
		}
		$content .='</thead>
    <tbody>
    </tbody></table>';
  	echo json_encode($content);
	}


$db->close();