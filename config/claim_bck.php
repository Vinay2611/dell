<?php
/**
 * Created by Vinay Jaiswal.
 * Client: Dell
 * Date: 02-05-2019
 * Time: 15:35
 */


//Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Load PHPMailer
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

//Get user data
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

//Get today hedge rate
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



//Claim Request
if(isset($_POST['type']) && $_POST['type'] == "ClaimClubRequest")
{
    extract($_POST);
    // generating order id
    $ddmm = date('dm');
    $year = date('y');

    //Escape string
    $remark_1 = $db->real_escape_string(isset($remark_1) ? $remark_1 : '');
    $remark_2 = $db->real_escape_string(isset($remark_2) ? $remark_2 : '');
    $remark_3 = $db->real_escape_string(isset($remark_3) ? $remark_3 : '');
    $remark_4 = $db->real_escape_string(isset($remark_4) ? $remark_4 : '');
    $remark_5 = $db->real_escape_string(isset($remark_5) ? $remark_5 : '');
    $shipping_address = $db->real_escape_string($shipping_address);
    $remarks          = $db->real_escape_string($remarks);
    $city             = $db->real_escape_string($city);

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
    $sql = "INSERT INTO `orders`( `order_number`, `contest_id`, `users_id`,  `order_status`, `shipping_address`, `city`, `pincode`, `remark`, `order_date`  ) VALUES ( '$order_number', '$contest_id', '$users_id', 'Pending', '$shipping_address', '$city', '$pincode', '$remarks', '$today_date' )";
    $insert = $db->query( $sql );
    if($insert) {
        $order_id = $db->insert_id;
        $orderTotal = $price_1 + $price_2 + $price_3 + $price_4 + $price_5;
        //Pending
        //echo "SELECT reward_status FROM `winner` WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")";
        $rewardSql = $db->query("SELECT reward_status FROM `winner` WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")  ORDER BY reward_status DESC");

        $i = 0;$j = 0;
        while ($rewardRow = $rewardSql->fetch_array()) {
            //$rewardRow = $rewardSql->fetch_array();

            if ($i == 0) {
                if ($rewardRow['reward_status'] == 'Pending') {
                    //echo "SELECT sum(reward_amount) as winAmount FROM `winner` WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")";
                    $amountSql = $db->query("SELECT sum(reward_amount) as winAmount FROM `winner` WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")");
                    $amountRow = $amountSql->fetch_array();

                    if ($amountRow['winAmount'] == $orderTotal) {  // Winning amount and claiming amount
                        // update status to reddem
                        //echo "UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")";
                        $updSql = $db->query("UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")");
                    }/* elseif ($amountRow['winAmount'] < $orderTotal) {  // Winning amount is less and claiming amount is more
                        //echo "UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")";
                        $updSql = $db->query("UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")");
                    }*/ else { //Claiming amount is less
                        // update status to claimed and divide amount in balance
                        $amountBalance = $amountRow['winAmount'] - $orderTotal;
                        //$updBalance = $amountBalance / $contestLen;
                        //echo "SELECT DISTINCT(reward_amount),winner_id FROM winner WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ") order by convert(`reward_amount`, decimal) desc limit 0,1";
                        $selMax = $db->query("SELECT DISTINCT(reward_amount),winner_id FROM winner WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ") order by convert(`reward_amount`, decimal) desc limit 0,1");
                        //$selMax = $db->query("SELECT max(reward_amount) as maxAmount,winner_id FROM `winner` WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")");
                        $getMax = $selMax->fetch_array();
                        $winner_id = $getMax['winner_id'];
                        //echo "UPDATE winner SET reward_status='Partially Claimed',balance_amount='" . $amountBalance . "' WHERE winner_id='" . $winner_id . "' ";
                        $updSqlMax = $db->query("UPDATE winner SET reward_status='Partially Claimed',balance_amount='" . $amountBalance . "' WHERE winner_id='" . $winner_id . "' ");

                        if ($updSqlMax) {
                            //echo "UPDATE winner SET reward_status='Redeemed',balance_amount='0' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ") AND winner_id != '" . $winner_id . "'";
                            $updSql = $db->query("UPDATE winner SET reward_status='Redeemed',balance_amount='0' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ") AND winner_id != '" . $winner_id . "'");
                            if ($updSql) {
                                $success = true;
                                $msg = "Your order is placed, remaining balance is updated.";
                            }
                        }

                    }
                }
                $i++;
            }

            if ($j == 0) {
                if ($rewardRow['reward_status'] == 'Partially Claimed') {
                    //echo "SELECT sum(balance_amount) as balance_amount FROM `winner` WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")";
                    $balSql = $db->query("SELECT sum(balance_amount) as balance_amount FROM `winner` WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")");
                    $balRow = $balSql->fetch_array();

                    if ($balRow['balance_amount'] == $orderTotal) {
                        //echo "UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")";
                        $updSql = $db->query("UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")");
                    } /*elseif ($balRow['balance_amount'] < $orderTotal) {
                        //echo "UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")";
                        $updSql = $db->query("UPDATE winner SET balance_amount='0',reward_status='Redeemed' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")");
                    }*/ else {
                        $amountBalance2 = $budget_allowed - $orderTotal;
                        //$amountBalance2 = $balRow['balance_amount'] - $orderTotal;
                        //$updBalance2 = $amountBalance / $contestLen;
                        //echo "SELECT DISTINCT(balance_amount),winner_id FROM winner WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ") order by convert(`balance_amount`, decimal) desc limit 0,1";
                        $selMax = $db->query("SELECT DISTINCT(balance_amount),winner_id FROM winner WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ") order by convert(`balance_amount`, decimal) desc limit 0,1");
                        //$selMax = $db->query("SELECT max(reward_amount) as maxAmount,winner_id FROM `winner` WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ")");
                        $getMax = $selMax->fetch_array();
                        $winner_id1 = $getMax['winner_id'];
                        //echo "UPDATE winner SET reward_status='Partially Claimed',balance_amount='" . $amountBalance2 . "' WHERE winner_id='" . $winner_id1 . "' ";
                        $updSqlMax1 = $db->query("UPDATE winner SET reward_status='Partially Claimed',balance_amount='" . $amountBalance2 . "' WHERE winner_id='" . $winner_id1 . "' ");
                        if ($updSqlMax1) {
                            //echo "UPDATE winner SET reward_status='Redeemed',balance_amount='0' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ") AND winner_id != '" . $winner_id1 . "'";
                            $updSql = $db->query("UPDATE winner SET reward_status='Redeemed',balance_amount='0' WHERE users_id='" . $users_id . "' AND contest_id IN(" . $contest_id . ") AND winner_id != '" . $winner_id1 . "'");
                            if ($updSql) {
                                $success = true;
                                $msg = "Your order is placed, remaining balance is updated.";
                            }
                        }


                    }
                }
                $j++;
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
        //$send = send_phpmail( $full_name, "vinay.jaiswal@shobizexperience.com" ,"Dell", "vinaytech.jaiswal@gmail.com" , $subject , $body );
        //if ( $send ){
        $success = true;
        $msg  = "Your application is sent for approval. Your will receive email after it is approved.";
        //}

    } else {
        $msg = "Something went wrong.Please try again later.";
    }

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
    $sql = "INSERT INTO `team_request`( `order_number`, `team_id`, `users_id`, `contest_id`, `order_type`, `start_date`, `end_date`, `venue`,  `kind_of_activity`, `document`, `hr_approval`, `geo_head_approval`, `upload_pi`, `upload_invoice`, `status` ) VALUES ( '$order_number', '$team_id', '$users_id', '$contest_id','$order_type', '$start_date', '$end_date', '$location',  '$kind_of_activity', '$file_name', '$file_name1', '$file_name2', '$file_name3', '$file_name4', 'Pending' )";
    //$sql = "INSERT INTO `team_request`( `order_number`, `team_id`, `users_id`, `contest_id`, `order_type`, `start_date`, `end_date`, `venue`, `amount`, `document`, `hr_approval`, `geo_head_approval`, `upload_pi`, `upload_invoice`, `status` ) VALUES ( '$order_number', '$team_id', '$users_id', '$contest_id','$order_type', '$start_date', '$end_date', '$location', '$amount', '$file_name', '$file_name1', '$file_name2', '$file_name3', '$file_name4', 'Pending' )";
    $insert = $db->query( $sql );
    if( $insert ){

        //Update winner status
        $updSql = $db->query("UPDATE winner SET  reward_status='Redeemed' WHERE users_id='".$users_id."' AND contest_id IN(".$contest_id.")");
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

