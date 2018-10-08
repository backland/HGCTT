<?php
error_reporting(0);
$MemberNo=(isset($_REQUEST["MemberNo"])) ? $_REQUEST["MemberNo"] : "";
require "Database.php";
$sql="SELECT ID, MemberNo FROM Players WHERE MemberNo=?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt,"i", $MemberNo);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $MemberNo);
if (mysqli_stmt_fetch($stmt)) {
  echo $id;
} else {
  echo "INVALID";
}
?>
