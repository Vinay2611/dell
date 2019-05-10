<?php
/**
 * Created by Vinay Jaiswal.
 * User: Dell
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
            $send = send_phpmail( $full_name, "vinay.jaiswal@shobizexperience.com" ,"Dell", "vinay.jaiswal@shobizexperience.com" , $subject , $body );
            if ($send){
                $success = true;
                $msg  = "Your application is sent for approval. Your will receive email once it is approved.";
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



//Team lead list
if (isset($_POST['type']) && $_POST['type'] == "Team_List"){
    $team_id = $_POST['team_id'];
    $manager = array();
    if (!empty($team_id)){
        //$select = "SELECT th.id,th.team_id,u.users_id,u.first_name,u.last_name FROM `team_head` AS th JOIN `users` AS u ON th.team_id = u.team_id WHERE th.team_id = '$team_id' GROUP BY u.users_id";
        //$select = "SELECT th.id,th.team_id,th.users_id,u.users_id,u.first_name,u.last_name FROM `team_head` AS th JOIN `users` AS u ON th.team_id = u.team_id WHERE th.team_id = '$team_id' AND th.users_id = u.users_id AND u.status='Active' ";
        $select = "SELECT th.id,th.team_id,th.users_id,u.users_id,u.first_name,u.last_name FROM `team_head` AS th JOIN `users` AS u ON th.users_id = u.users_id WHERE th.team_id = '$team_id' AND u.status='Active' ";
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
                //Send Mail
                $subject = "Password Reset";
                $body = "<h2> New Password: $random_string</h2>";
                $mail = send_phpmail( '', "$email" ,"Dell", "vinay.jaiswal@shobizexperience.com" , $subject , $body );
                //$mail = send_mail( "$email" , "" , "Password Reset", "$body" );
                if ($mail){
                    $update = "UPDATE `users` SET `password`='$random_string' WHERE `email`='$email'";
                    $query_up = $db->query($update);
                    if ($query_up){
                        $success = true;
                        $message = "Password reset successfully";
                        $data = array( "valid" => 1, "message" => "We have sent a new password on your email id, please check your emails." );
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
    //echo "SELECT SUM(reward_amount) AS total_amount  FROM `winner` WHERE `users_id` = '$users_id' AND  `dateTime` BETWEEN '$from_date' AND '$to_date' ";
    //echo "SELECT SUM(reward_amount) FROM `winner` as w,contest as c,purchase_order as po,hedge_rate as h WHERE c.contest_id = w.contest_id AND c.po_id = po.po_id AND  po.hedge_id = h.hedge_id AND h.hedge_id='$hedge_id' AND w.users_id = '$users_id'";
    $selAmount = $db->query( "SELECT SUM(reward_amount) AS total_amount  FROM `winner` as w,contest as c,purchase_order as po,hedge_rate as h WHERE c.contest_id = w.contest_id AND c.po_id = po.po_id AND  po.hedge_id = h.hedge_id AND h.hedge_id='$hedge_id' AND w.users_id = '$users_id'");
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
AND hr.hedge_id = '$hedge_id' GROUP BY c.contest_id";
    $selUtility = $db->query( $query_sql );
    $amount_utility = 0;
    while ($extUtility = $selUtility->fetch_assoc()){

        //echo "SELECT o.order_date,o.order_id,SUM(od.price) as amount,od.price,o.users_id FROM `orders` AS o JOIN order_details AS od ON o.order_id=od.order_id  WHERE `users_id` = '$users_id' AND o.contest_id IN (".$extUtility['contest_id'].")";
        $innQUery = $db->query("SELECT o.order_date,o.order_id,SUM(od.price) as amount,od.price,o.users_id FROM `orders` AS o JOIN order_details AS od ON o.order_id=od.order_id  WHERE `users_id` = '$users_id' AND o.contest_id IN (".$extUtility['contest_id'].")");
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