<?php 
require_once('../../config/db.php');
include_once('../phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$postData = $_POST;


   
 if($postData['action'] == 'order') {
	 //echo "UPDATE order_details SET status='".$postData['status']."' WHERE od_id='".$postData['od_id']."'";
    $updQuery = $db->query("UPDATE order_details SET order_status='".$postData['status']."' WHERE od_id='".$postData['od_id']."'");
	if($updQuery) { 
	$ordQuery = $db->query("SELECT order_id FROM order_details WHERE od_id='".$postData['od_id']."'");
	$orderRow = $ordQuery->fetch_array();
	$odQuery = $db->query("SELECT u.email,concat(u.first_name,' ',u.last_name) as full_name,o.order_id,o.users_id,o.order_number,o.shipping_address,o.city,o.pincode,o.order_date,od.product,od.brand_details,od.size,od.website,od.price,od.url,od.comment FROM orders as o JOIN order_details as od,users as u WHERE o.order_id = od.order_id AND od.order_id = '".$orderRow['order_id']."' GROUP by order_id");
	$orderRow = $odQuery->fetch_array();
	
	if($postData['status'] != 'Pending') {
     $body = '';
	 $body .='<html><head><title>'.$orderRow['full_name'].' :  Your order  :  '.$postData['status'].'</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="font-family:Arial, sans-serif, font-size:14px;">
    <table width="1000" height="153" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
        <tr>
            <td width="900" height="38" style="border:0px solid #006; padding:25px 0; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;">Dear <strong>'.$row['first_name'].'</strong>,</td>
        </tr>
        <tr>
            <td width="900" height="20" style="border:0px solid #006; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; font-weight:700;">Thank you for your order</td>
        </tr>
        <tr>
            <td width="900" height="20" style="border:0px solid #006; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; font-weight:800; padding:15px 0;">Order Number: 1904-19-1</td>
        </tr>
        <tr>
            <td style="font-family:Arial, Helvetica, sans-serif;">
            	<table width="100%" border="0">
                  <tbody>
                    <tr>
                      <td><h3 style="padding:5px 0; margin:0;">Delivery Address</h3></td>
                     </tr>
                     <tr>
                      <td><div style="display:inline-block; width:30%; line-height:1.5; margin:0;">'.$postData['shipping_address'].'</div></td>
                    </tr>
                  </tbody>
                </table>
            </td>
        <tr>
        	<td>
            	<table width="100%" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; margin:15px 0; line-height:1.5;">
                  <tbody>
                    <tr>
                      <td><p style="color:#0074c1;font-weight:bold;">Order Details</p></td>
                    </tr>
                    <tr>
                      <td><p>Order #403-9476115-8453104 </p></td>
                    </tr>
                    <tr>
                    <td style="height: 50px;">
                      <table width="100%" border="1">
                        <tbody>
                          <tr>
                            <td width="15%">Product</td>
                            <td width="21%">Brand Details</td>
                            <td width="10%">Size</td>
                            <td width="13%">Website</td>
                            <td width="9%">Price</td>
                            <td width="32%">URL</td>
                          </tr>';
        $body .= '<tr><td width="15%">'.$orderRow['product'].'</td>
                            <td width="21%">'.$orderRow['brand_details'].'</td>
                            <td width="10%">'.$orderRow['size'].'</td>
                            <td width="13%">'.$orderRow['website'].'</td>
                            <td width="9%">'.$orderRow['price'].'</td>
                            <td width="32%">'.$orderRow['url'].'</td>
                          </tr>
                        </tbody>
                      </table></td>
                    </tr>';
      $body .=   '<tr><td style="line-height:1.5;font-family:Arial, Helvetica, sans-serif;"><p>Agency will not be able to address delivery related queries. The ecommerce portals have their own process and timelines for deliveries.</p>
                      <p>Please do not expect agency to track the product deliveries.</p>                      
                      <ul style="line-height:1.5;">
                      	<li style="padd:1.5; padding:5px 0;">For any delivery related queries, please reach out to the respective ecommerce Portal directly with the respective Order ID.<br>
                        <ul style="line-height:1.5; padding-top:5px;">
                              	<li style="padding:5px 0;">Amazon : 1800 3000 9009</li>
                                <li style="padding:5px 0;">Flipkart : 1800 208 9898</li>
                                <li style="padding:5px 0;">Myntra : 1800-419-3500</li>
							  </ul>
                        </li>
                        <li style="padd:1.5; padding:5px 0;">For any Return / Exchange / Replacement, please inform us within the next business day after receiving the order.</li>
                        <li style="padd:1.5; padding:5px 0;">Agency working hours is between 10:00 am to 6:00 pm from Monday to Friday.</li>
                        <li style="padd:1.5; padding:5px 0;">We will not be able to address email correspondences or calls or SMS on Saturday, Sunday or P ublic holidays. Kindly reach out to us on the subsequent working day.</li>
                        </ul></td></tr></tbody></table></td></tr><tr><td><p>Regards <br>Support Team</p>
            </td>
        </tr>
    </table>
</body>
</html>';
			$mail->From = "isip@shobiziems.com";
			$mail->FromName   = "Incentive sales program";
			$mail->Subject    = "Order ".$postData['status'];
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->MsgHTML($body);
			$mail->AddAddress($row['email'], $row['first_name']);
		

	
	}
	$response = array('success' => true,'message'=>'Order status updated as '.$postData['status']);	
	} else {
	  $response = array('success' => false,'message'=>'Unable to change status.');	
	}
    print_r(json_encode($response));
 } 
?>