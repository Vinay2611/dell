<?php
if(!checkFromSession())
{
	header("location:../mail/index.php");
}
$event_desc=$_SESSION["event_desc"];
$event_location=$_SESSION["event_location"];

function checkFromSession()
{
	session_start();
	$username=$_SESSION["session_user"];
	$password=$_SESSION["session_pwd"];
	$noofemailid=$_SESSION["session_noofemailid"];

	if (!$username) 
		return false;	
	else
		return true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Shobiz Bulkmail  For Invitee</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style12 {font-family: Arial, Helvetica, sans-serif ;font-size: 16px; font-weight: bold;}
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style121 {font-family: Arial, Helvetica, sans-serif}
.style2 {font-size: 16px}
-->
</style>
</head>
<body>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><table width="940" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #000;">
      <tr>
        <td><img src="images/header.gif" width="940" height="174" /></td>
      </tr>
      <tr>
        <td height="40" bgcolor="#952C5C"><table width="100%" border="0" cellpadding="2" cellspacing="0" class="headerw">
          <tr>
            <td align="right">Event Name</td>
            <td width="1%" align="center">:</td>
            <td width="50%" align="left"><?php echo $event_desc ?></td>
          </tr>
          <tr>
            <td align="right">Event Location</td>
            <td align="center"> :</td>
            <td align="left"><?php echo $event_location ?></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="center"><strong>Sending Mail -Screen </strong></td>
            </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="104" align="center"><a href="index.php"><img src="images/01.gif" width="59" height="59" border="0" /></a></td>
            <td width="104" align="center"><a href="logout.php"><img src="images/02.gif" border="0" /></a></td>
            <td width="104" align="center"><a href="csv2sql.php"><img src="images/03.gif" width="59" height="59" border="0" /></a></td>
            <td width="104" align="center"><a href="createedm.php"><img src="images/04.gif" width="59" height="59" border="0" /></a></td>
            <td width="104" align="center"><a href="createlinkdetails.php"><img src="images/05.gif" width="59" height="59" border="0" /></a></td>
            <td width="104" align="center"><a href="viewlinkwise.php"><img src="images/06.gif" width="59" height="59" border="0" /></a></td>
            <td width="104" align="center"><a href="bulkmail.php"><img src="images/07.gif" width="59" height="59" border="0" /></a></td>
            <td width="104" align="center"><a href="statusmail.php"><img src="images/09.gif" width="59" height="59" border="0" /></a></td>
            <td width="104" align="center"><a href="downloadexcel.php"><img src="images/08.gif" width="59" height="59" border="0" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="top"><a href="index.php" class="shobiz">Home</a></td>
            <td align="center" valign="top"><a href="logout.php" class="shobiz">Logout</a></td>
            <td align="center" valign="top"><a href="csv2sql.php" class="shobiz">Upload Data</a></td>
            <td align="center" valign="top"><a href="createedm.php" class="shobiz">Upload Invite  EDM</a></td>
            <td align="center" valign="top"><a href="createlinkdetails.php" class="shobiz">Update Link Details</a></td>
            <td align="center" valign="top"><a href="viewlinkwise.php" class="shobiz">View Linkwise Click </a></td>
            <td align="center" valign="top"><a href="bulkmail.php" class="shobiz">Send Bulk</a></td>
            <td align="center" valign="top"><a href="statusmail.php" class="shobiz">Status Mail</a></td>
            <td align="center" valign="top"><a href="downloadexcel.php" class="shobiz">Download Excel</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="bg" style="padding:20px;"><table border=0 cellpadding=5 cellspacing=2 width=90% align=center>
  	   <tr>
            <td  class="style6">
			<?php
$dbname     = "shobiziems"; 
$dbserver   = "localhost";
$dbuser     = "root"; 
$dbpass     ="showbiz61";  
$cn=mysql_connect($dbserver, $dbuser, $dbpass);
mysql_select_db($dbname,$cn);
//require("mailer.php");
require("class.phpmailer.php");

$cn2=mysql_connect($dbserver, $dbuser, $dbpass);
mysql_select_db($dbname,$cn2);
$user=$_SESSION["session_user"];
$pass=$_SESSION["session_pwd"];
include "dbc.php";
$result = mysql_query("SELECT id,details FROM bulkedit2 WHERE event_desc='$event_desc' and event_location='$event_location'");
$check2 = mysql_num_rows($result);
if($check2>0)
{
	while ($row3 = mysql_fetch_array($result)) 
		{ 
		$details=$row3['details'];
		}
}
$mailbody=stripslashes($details); 
$mailbody2=stripslashes($details); 
$mailbody3=stripslashes($details); 
$mailsubject=stripslashes($_SESSION['mailsubject']); 
$mailfrom=stripslashes($_SESSION['mailfrom']); 
$mailfromname=stripslashes($_SESSION['mailfromname']); 
$eventname=$_SESSION["event_desc"];
$eventlocation=$_SESSION["event_location"];
$query = "SELECT id,emailid,name,linkclickhere,linkclickhereto,topclickhere,mailstatus FROM bulkmail WHERE event_name='$eventname' and event_location='$eventlocation' and mailstatus='' and username='$user' and password='$pass'";
	$cn=mysql_connect($dbserver, $dbuser, $dbpass);
 	mysql_select_db($dbname,$cn);
	$result = mysql_query($query,$cn) or die(mysql_error());
	$i= 0;
	while($row = mysql_fetch_array($result))
		{
		$mailstatus=$row['mailstatus'];
		If ($mailstatus=='')
			{
//			set_time_limit(0);
//		    sleep(2) ;
			$id=$row['id'];
			$name=$row['name'];
			$linkclickhere=$row['linkclickhere'];
			$linkclickhereto=$row['linkclickhereto'];
			$topclickhere=$row['topclickhere'];
			$mailbody =str_replace("[xxxx]",$name, $mailbody);
			$mailbody =str_replace("[xxxx2]",$linkclickhere, $mailbody);
			$mailbody =str_replace("[xxxx3]",$topclickhere, $mailbody);
			$mailbody =str_replace("[xxxx4]",$linkclickhereto, $mailbody);
			$mailbody =str_replace("</body>","<img src='http://www.shobizevents.com/smtptest3/lt3.php?id=".$id." width='1' height='1' border='0' /></body>", $mailbody);
//			$mailbody = linkExtractor($mailbody);
//			echo $mailbody;
			$linkArray = array();
			 if(preg_match_all('/<a\s+.*?href=[\"\']?([^\"\' >]*)[\"\']?[^>]*>(.*?)<\/a>/i',$mailbody,$matches,PREG_SET_ORDER))
			 {
			  foreach($matches as $match)  	{
			   array_push($linkArray,array($match[1],$match[2]));
			   if (substr($match[1],0,4)=="http") 
				  {		
			  		$old_link=$match[1];
				    $match[1] = str_replace('?', '--Q-', $match[1]);
					$match[1] = str_replace('&amp;', '--A-', $match[1]);
					$match[1] = str_replace('&', '--A-', $match[1]);
					$match[1] = str_replace('=', '--E-', $match[1]);
					$match[1] = str_replace('http://', '-http--', $match[1]);
					$match[1] = str_replace('https://', '-https--', $match[1]);
//					$str1='http://www.shobizevents.com/smtptest3/lt2.php?id='.$id."&l=".$match[1];
					$str1='http://www.shobizevents.com/smtptest3/lt2.php?id='.$id."&l=".$match[1]."&eventname=".$eventname."&eventlocation=".$eventlocation;
					
					$mailbody =str_replace($old_link,$str1, $mailbody);
					}
				 }
			 }
			$mailto = $row['emailid'];
			//$mail->Timeout = 20;
			//$mail = new PHPMailer();
			//$mail->IsSendmail(); // telling the class to use SendMail transport
			//$mail->AddAddress($mailto);
			//$mail->From=$mailfrom;
			//$mail->FromName=$mailfromname;
			//$mail->Subject=$mailsubject;
			//$mail->IsHTML(true);
			//$mail->AddReplyTo($mailfrom);
			//$mail->Body =$mailbody;
			//$mail->AltBody="";
			$mail      = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host  = "mail.shobiziems.com"; // SMTP server
			$mail->AddAddress($mailto);
			$mail->From=$mailfrom;
			$mail->FromName=$mailfromname;
			$mail->Subject=$mailsubject;
			$mail->IsHTML(true);
			$mail->AddReplyTo($mailfrom);
			$mail->Body =$mailbody;
			$mail->AltBody="";
			if($mail->Send())
			{
			    $i= $i +1;
				$status = 1;
				$mail->ClearAddresses();
				$mail->ClearReplyTos();
				ob_end_flush();
				echo "<br /> $i ) Email Info: $mailto , $name<br />Waiting 1 seconds...<br />";
				flush();
				sleep(1);
			}
			else
			{
				$status = 2;
				$problemid .= $mailto;
			}
			$name2=$row['name'];
			$linkclickhere2=$row['linkclickhere'];
			$linkclickhereto2=$row['linkclickhereto'];
			$topclickhere2=$row['topclickhere'];
			$id2=$row['id'];
			$name='[xxxx]';
			$mailbody =str_replace($name2,$name, $mailbody);
			$linkclickhere='[xxxx2]';
			$topclickhere='[xxxx3]';
			$linkclickhereto='[xxxx4]';
			$id2=$row['id'];
			$name='[xxxx]';
			$mailbody =str_replace($linkclickhere2,$linkclickhere, $mailbody);
			$mailbody =str_replace($linkclickhereto2,$linkclickhereto, $mailbody);
			$mailbody =str_replace($topclickhere2,$topclickhere, $mailbody);
			$mailbody =$mailbody3;
		   } //end of If (mailstatus=='SEND')
		}  //end of while($row = mysql_fetch_array($result))
		 $qry = "update bulkmail set mailstatus='SEND' WHERE  event_name='$eventname' and event_location='$eventlocation' and mailstatus!='Bounce' and mailstatus!='Read' and mailstatus!='open' and mailstatus!='CLICKED' and username='$user' and password='$pass' ";
		 $cn2=mysql_connect($dbserver, $dbuser, $dbpass);
		 mysql_select_db($dbname,$cn2);
		 $result = mysql_query($qry,$cn2) or die(mysql_error());
		 mysql_close($cn);
		 mysql_close($cn2);

?>
</td>
<tr>
<td align=center><a href="bulkmail.php" onclick="location.href( '>http://www.site.com');"> Click here </a></td>
</table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">All information copyrights &copy; 2009 - 2010</td>
    <td align="right">Powered By: <a href="http://www.shobizevents.com" target="_blank">Shobiz Experience Pvt Ltd.</a></td>
  </tr>
</table>
</body>
</html>



