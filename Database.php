<?php
date_default_timezone_set('Australia/Sydney');
$hostname="localhost";
$username="root";
$password="XiwxeqkLhS0E";
$dbname="golfbooking";
$link = mysqli_connect($hostname,$username, $password,$dbname);
if (!$link) {
    $Err=mysqli_connect_error();
    echo "Unable to connect to database! Please try again later.  Error:$Err";
    exit();
}
?>
