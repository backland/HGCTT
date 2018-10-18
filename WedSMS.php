#!/opt/bitnami/php/bin/php
<?php
require "SMSConfig.php";
require "Database.php";
require_once "vendor/autoload.php";
use MessageMediaMessagesLib\MessageMediaMessagesClient;
use MessageMediaMessagesLib\APIHelper;
$date = new DateTime();
$date = $date->format("y:m:d h:i:s");
$client = new MessageMediaMessagesLib\MessageMediaMessagesClient($authUserName, $authPassword, $useHmacAuthentication);
$Today=date("D d M Y");
$TimeAdjust="Wednesday +1 weeks";
$BookingDate=date("Y-m-d",strtotime($TimeAdjust));
$sql="select a.GroupNo, concat(p.given,' ',p.surname) Player, p.Mobile 
      from Bookings a join Players p on p.id=a.PlayerID1
      where a.BookingDate = '$BookingDate'";
$result = mysqli_query($link,$sql);
if ($result) {
  while ($row = mysqli_fetch_array($result)) {
    $Player=$row[1];
    $mobileNo=$row[2];
    echo "\n$date - Booking Player $Player ";
    if (!empty($mobileNo)) {
$mobileNo="+61412515818";
      $messages = $client->getMessages();
      $bodyValue = '{
             "messages":[
                {
                   "content":"Golf Bookings in 15 Minutes Check : https://hgctt.com/",
                   "destination_number":"'.$mobileNo.'"
                }
             ]
           }';
      $body = MessageMediaMessagesLib\APIHelper::deserialize($bodyValue);
      $msgResult = $messages->createSendMessages($body);
      echo " SMS on $mobileNo";
    }
  }
}
?>



