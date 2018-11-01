#!/opt/bitnami/php/bin/php
<?php
require "SMSConfig.php";
$mobileNo="+61412515818";
$headerValue = array(
"Content-type: application/json",
"Accept: application/json",
);
$bodyValue = '{ "messages":[ {
  "content":"This is a test message. ",
  "destination_number":"'.$mobileNo.'"
} ] }';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.messagemedia.com/v1/messages");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD,$basicAuthUserPwd);
curl_setopt($ch, CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$bodyValue);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headerValue);
$response = curl_exec($ch);
echo " SMS sent on $mobileNo\n";
?>
