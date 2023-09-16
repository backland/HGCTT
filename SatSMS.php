#!/opt/bitnami/php/bin/php
<?php
require "SMSConfig.php";
require "Database.php";
$date = new DateTime();
$date = $date->format("y:m:d h:i:s");
$Today=date("D d M Y");
$TimeAdjust="Saturday +1 weeks";
$BookingDate=date("Y-m-d",strtotime($TimeAdjust));
$sql="select a.GroupNo,
      (select concat(given,' ',surname) from Players where id=PlayerID1) Player1,
      (select Mobile from Players where id=PlayerID1) Mobile,
      (select concat(given,' ',surname) from Players where id=PlayerID2) Player2,
      (select concat(given,' ',surname) from Players where id=PlayerID3) Player3,
      (select concat(given,' ',surname) from Players where id=PlayerID4) Player4
      from Bookings a
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
                      "content":"HGC Golf Bookings Open in 10 Minutes.\n\nYour Group: \n'.
                      $row[1].'\n'.
                      $row[3].'\n'.
                      $row[4].'\n'.
                      $row[5].'\n\n'.
                      '\n\nhttps://hgctt.com/sat.php",
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



