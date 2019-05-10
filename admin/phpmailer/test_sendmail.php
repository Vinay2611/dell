<?php

include_once('class.phpmailer.php');

$db_settings['sendmail_path'];
//   $mail->Sendmail = $db_settings['sendmail_path'];

$mail             = new PHPMailer();
$body             = $mail->getFile('contents.html');
$body             = eregi_replace("[\]",'',$body);


    $gmailActionMicroData = '
      <div itemscope itemtype="http://schema.org/EmailMessage">
        <div itemprop="potentialAction" itemscope itemtype="http://schema.org/ConfirmAction">
          <meta itemprop="name" content="{{button title without quotes}}"/>
          <div itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler">
            <link itemprop="url" href="'. $matches[1].'"/>
          </div>
        </div>
        <meta itemprop="description" content="{{description of button without quotes}}"/>
      </div>';

$mail->IsSendmail(); // telling the class to use SendMail transport



$body = '<html> <head>
<script type="application/ld+json">
{
"@context": "http://schema.org",
"@type": "EmailMessage",
"action": {
"@type": "ConfirmAction",
"name": "Approve Expense",
"handler": {
"@type": "HttpActionHandler",
"url": "https://myexpenses.com/approve?expenseId=abc123"
}
},
"description": "Approval request for Johns $10.13 expense for office supplies"
}
</script>
</head> <body> <p> This a test for a Go-To action in Gmail. </p> </body></html>';


$mail->From       = "neetuprakash.poojary@shobizexperience.com";
$mail->FromName   = "First Last";

$mail->Subject    = "PHPMailer Test Subject via smtp";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body );

$mail->AddAddress("ramesh.mhaskar@shobizexperience.com", "John Doe");

$mail->AddAttachment("images/phpmailer.gif");             // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>
