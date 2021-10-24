#!/opt/bitnami/php/bin/php
<?php
require "SMSConfig.php";
require "Database.php";
$date = new DateTime();
$date = $date->format("y:m:d h:i:s");
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
      $headerValue = array(
        "Content-type: application/json",
        "Accept: application/json",
      );
      $bodyValue = '{ "messages":[ {
                      "content":"HGC Golf Bookings in 15 Minutes Check Your Group at \n\n https://hgctt.com/wed.php \n\n(DO NOT REPLY)",
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
      echo " SMS sent on $mobileNo";
    }
  }
}
?>



