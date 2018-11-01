#!/opt/bitnami/php/bin/php
<?php
require "SMSConfig.php";
$headerValue = array(
"Content-type: application/json",
"Accept: application/json",
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.messagemedia.com/v1/replies");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD,$basicAuthUserPwd);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headerValue);
$response = curl_exec($ch);
$arr = json_decode($response, true);
$reply_ids="{ \"reply_ids\":[";
$first=1;
foreach($arr['replies'] as $key => $val) {
    if ($first==1) {
      $first=0;
      $reply_ids.="\"".$val['reply_id']."\"";
    } else {
      $reply_ids.=",\"".$val['reply_id']."\"";
    }
    echo $val['reply_id']."|".
         $val['source_number']."|".
         $val['date_received']."|".
         $val['content']."\n";
}
$reply_ids.="] }";

if ($first == 1) { echo "No Replies Available\n\n"; exit(); }

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.messagemedia.com/v1/replies/confirmed");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD,$basicAuthUserPwd);
curl_setopt($ch, CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$reply_ids);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headerValue);
echo "Confirming Replies Received\n";
$response = curl_exec($ch);
var_dump($response);
?>
