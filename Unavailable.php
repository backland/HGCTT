<?php
error_reporting(0);
$BookingDate=(isset($_REQUEST["BookingDate"])) ? $_REQUEST["BookingDate"] : "";
$PlayerId=(isset($_REQUEST["PlayerId"])) ? $_REQUEST["PlayerId"] : "";
require "Database.php";
$sql="SELECT 1 FROM PlayerNotAvailable WHERE PlayerID= ? and BookingDate =?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, 'is', $PlayerId,$BookingDate);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $record);
if (mysqli_stmt_fetch($stmt)) { 
  mysqli_stmt_free_result($stmt);
  $sql="DELETE FROM PlayerNotAvailable WHERE PlayerID= ? and BookingDate =?";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, 'is', $PlayerId,$BookingDate);
  mysqli_stmt_execute($stmt);
  echo mysqli_error($link);
} else {
  mysqli_stmt_free_result($stmt);
  $sql="INSERT INTO PlayerNotAvailable (PlayerID, BookingDate) VALUES (?,?)";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, 'is', $PlayerId,$BookingDate);
  mysqli_stmt_execute($stmt);
  echo mysqli_error($link);
}
?>
