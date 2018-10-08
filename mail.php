<?php
$from = "HGC Table Tappers <bitnami@hgctt.com>";
$replyto = "Brian Ackland <brian.ackland@me.com>";
$mail_subject="HGC Table Tapper Golf Bookings";
$mail_headers =  "MIME-Version: 1.0".PHP_EOL;
$mail_headers .= "Content-type:text/html;charset=UTF-8".PHP_EOL;
$mail_headers .= "From: ".($from).PHP_EOL;
$mail_headers .= "Reply-To: ".($replyto).PHP_EOL;
$mail_headers .= "Return-Path: ".($from).PHP_EOL;
$mail_headers .= "X-Priority: 3".PHP_EOL;
$mail_headers .= "X-Mailer: PHP".phpversion().PHP_EOL;
$mail_headers .= "CC:backland@csc.com".PHP_EOL;
$mail_message = "<html><head>
<title>HTML Title</title></head>
<body>
<table width=90% align=center style='text-align:left;background-color:#fff'>
<tr><td>Test
        Test
        Test
        Narative on this week golf.
        Narative on this week golf.
</td></tr>
<tr><td><br>
</td></tr>
</table>
<table width=90% align=center style='text-align:left;background-color:#fff'>
<tr><td>Booking</td><td>Group</td></tr>
<tr><td nowrap><b>Kevin OHeir</b></td><td>Kevin OHeir<br> Ian<br> Brian<br> Eddie</td></tr>
<tr><td nowrap><b>Kevin OHeir</b></td><td>Kevin OHeir<br> Ian<br> Brian<br> Eddie</td></tr>
<tr><td nowrap><b>Kevin OHeir</b></td><td>Kevin OHeir<br> Ian<br> Brian<br> Eddie</td></tr>
<tr><td nowrap><b>Kevin OHeir</b></td><td>Kevin OHeir<br> Ian<br> Brian<br> Eddie</td></tr>
</table>";
mail("brian.ackland@me.com",
     $mail_subject,
     $mail_message,
     $mail_headers);
echo "Mail Sent<br>";
?>
