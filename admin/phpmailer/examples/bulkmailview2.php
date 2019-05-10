<?
if(!checkFromSession())
{
	header("location:../mail/index.php");
}
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

function linkExtractor($html)
{
 $linkArray = array();
 if(preg_match_all('/<a\s+.*?href=[\"\']?([^\"\' >]*)[\"\']?[^>]*>(.*?)<\/a>/i',$html,$matches,PREG_SET_ORDER))
 {
  foreach($matches as $match)  	{
 	$linkArray = array();
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
		$str1='http://www.shobizevents.com/smtptest3/lt2.php?id=500'."&l=".$match[1];
		$html =str_replace($old_link,$str1, $html);
	}
   
  }
 }
//echo $html;
return $linkArray;
} 

session_start(); 
require("mailer.php");
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

//$b = html_entity_decode($a);
//echo $a; // I'll &quot;walk&quot; the &lt;b&gt;dog&lt;/b&gt; now
//echo $b; // I'll "walk" the <b>dog</b> now
// For users prior to PHP 4.3.0 you may do this:

$query = "SELECT id,emailid,name,linkclickhere,mailstatus,linkclickhereto,topclickhere FROM bulkmail WHERE  event_name='$eventname' and event_location='$eventlocation' and mailstatus='' and username='$user' and password='$pass' LIMIT 0, 1  ";
$dbname     = "shobiziems";
$dbserver   = "localhost";
$dbuser     = "root"; 
$dbpass     = "showbiz61";  
$cn=mysql_connect($dbserver, $dbuser, $dbpass);
mysql_select_db($dbname,$cn);
$result = mysql_query($query,$cn) or die(mysql_error());
while($row = mysql_fetch_array($result))
{
$mailstatus=$row['mailstatus'];
If ($mailstatus=='')
	{
	$id= $row['id'];
	$name=$row['name'];
	$linkclickhere=$row['linkclickhere'];
	$linkclickhereto=$row['linkclickhereto'];
	$topclickhere=$row['topclickhere'];
	$mailbody2 =str_replace("[xxxx]",$name, $mailbody2);
	$mailbody2 =str_replace("[xxxx2]",$linkclickhere, $mailbody2);
	$mailbody2 =str_replace("[xxxx3]",$topclickhere, $mailbody2);
	$mailbody2 =str_replace("[xxxx4]",$linkclickhereto, $mailbody2);
	$mailto = $row['emailid'];
	$headers = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: $mailfrom\r\n";
	$headers = $headers . "Return-Path: $mailfrom\r\n";
	$headers =  $headers ."Reply-To: $mailfrom\r\n";
	$headers = $headers . "Return-Receipt-To: $mailfrom\r\n";
	$linkArray = array();
    if(preg_match_all('/<a\s+.*?href=[\"\']?([^\"\' >]*)[\"\']?[^>]*>(.*?)<\/a>/i',$mailbody2,$matches,PREG_SET_ORDER))
	 {
  foreach($matches as $match)  	{
  	$linkArray = array();
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
		$str1='http://www.shobizevents.com/smtptest3/lt2.php?id='.$id."&l=".$match[1]."&eventname=".$eventname."&eventlocation=".$eventlocation;
		$mailbody2 =str_replace($old_link,$str1, $mailbody2);
	}
   
  }
 }

	
	
	$a = htmlentities($mailbody2);
	$c = unhtmlentities($a);

  }
}

function unhtmlentities($string)
{
    // replace numeric entities
    $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
    $string = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $string);
    // replace literal entities
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}
$dbname     = "shobiziems"; 
$dbserver   = "localhost";
$dbuser     = "root"; 
$dbpass     ="showbiz61";  
$cn=mysql_connect($dbserver, $dbuser, $dbpass);
mysql_select_db($dbname,$cn);
$query2 = "SELECT count(id) as noofrec FROM bulkmail WHERE event_name='$eventname' and event_location='$eventlocation' and mailstatus='' and username='$user' and password='$pass'";
$result2 = mysql_query($query2,$cn) or die(mysql_error());
$row2 = mysql_fetch_array($result2);
$noofrec=$row2['noofrec'];
if ($noofrec==0)
{
	$error[]="No Record is for send";
}
if(!$error) 
	{
	if($_POST[submit]=="Submit")
		{
		header("location: bulkmailfinal2.php"); 
		}
}
else
	{
	$error=join($error, "<br>");
	$error="<b>Error - </b><br>".$error;
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
-->
</style>
</head>
<body>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0" class="body10" background="">
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
            <td colspan="3" align="center"><strong>Sending Bulk Mail</strong></td>
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
            <td align="center" valign="top"><a href="createedm.php" class="shobiz">Upload Invitee EDM</a></td>
            <td align="center" valign="top"><a href="createlinkdetails.php" class="shobiz">Update Link Details</a></td>
            <td align="center" valign="top"><a href="viewlinkwise.php" class="shobiz">View Linkwise Click </a></td>
            <td align="center" valign="top"><a href="bulkmail.php" class="shobiz">Send Bulk</a></td>
            <td align="center" valign="top"><a href="statusmail.php" class="shobiz">Status Mail</a></td>
            <td align="center" valign="top"><a href="downloadexcel.php" class="shobiz">Download Excel</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="bg" style="padding:20px;">
		 <?php
			if($error) 
				echo "<font size=\"2\" face=\"Arial, Helvetica, sans-serif\" color=\"red\">".$error."</font><br>";
			?>
		<table border=0 cellpadding=5 cellspacing=2 width=100% >
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
<tr>
  <td><div align="left" class="body-text-bold" >From</div></td>
  <td><?php echo $mailfrom;?></td>
</tr>
<tr>
<td width="20%"><div align="left" class="body-text-bold">To</div></td>
<td width="80%"><div align="left"><p><?php echo $mailto;?></p></div></td>
</tr>

<tr>
<td><div align="left" class="body-text-bold">Subject</div></td>
<td><div align="left" ><?php echo $mailsubject;?></div></td>
</tr>

<tr>
<td valign=top><div align="left" class="body-text-bold">Message Body</div></td>
<td><?php echo $c;?></td>
</tr>
<tr>
  <td colspan=2 align=center>&nbsp;</td>
<tr>
<td colspan=2 align=center>
<input type="submit" name="submit" id="button" value="Submit"></td>

</form>
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
