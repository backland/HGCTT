<?php
error_reporting(0);
require "Database.php";
$Offset=(isset($_REQUEST["Offset"])) ? $_REQUEST["Offset"] : "1";
$Day=(isset($_REQUEST["Day"])) ? $_REQUEST["Day"] : "Sat";
if ($Day=="Sat"){ 
  $Day="Saturday"; 
  $DayFilter = "p.Saturday=1"; 
  $BookingFilter="date_format(b.BookingDate,'%a')='Sat'"; 
}
if ($Day=="Wed"){ 
  $Day="Wednesday"; 
  $DayFilter = "p.Wednesday=1"; 
  $BookingFilter="date_format(b.BookingDate,'%a')='Wed'"; 
}
$dummies=0;
$TimeAdjust="$Day +$Offset weeks";
$BookingDate=date("Y-m-d",strtotime($TimeAdjust));
$NiceBookingDate=date("d M Y",strtotime($TimeAdjust));
$LastOffset=$Offset-1;
$TimeAdjust="$Day +$LastOffset weeks";
$LastBookingDate=date("Y-m-d",strtotime($TimeAdjust));
$TimeAdjust="$Day -2 weeks";
$RecentBookingLimit=date("Y-m-d",strtotime($TimeAdjust));
require "Header.php";
require "Navigation.php";
echo '<div class="alert alert-success" role="alert">';
echo "Booking Date : $Day $NiceBookingDate </div>";
$groupsize=4;
$sql="DELETE FROM Bookings Where BookingDate='$BookingDate';";
$result = mysqli_query($link,$sql);


$sql="SELECT p.id id, (select count(*) from Bookings b where $BookingFilter and b.PlayerID1=p.id) Total,
                      (select count(*) from Bookings b 
                                       where $BookingFilter 
                                       and BookingDate>$RecentBookingLimit
                                       and b.PlayerID1=p.id) LastWeeks
      FROM Players p
      where $DayFilter
      and  p.id not in (SELECT PlayerID from PlayerNotAvailable where BookingDate='$BookingDate')
      Order By LastWeeks, Total";
$results = mysqli_query($link,$sql);
if ($results) {
  while ($row = mysqli_fetch_array($results)) {
    $players[] = $row[0];
  }
}
$groups=ceil(count($players)/$groupsize);
$extras=count($players)%$groupsize;
for ($g=0; $g<$groups; $g++) {
  $bookingId[]=$players[$g];
}
$sql="SELECT p.id id,p.name name
      FROM Players p
      where $DayFilter
      and p.id not in (SELECT PlayerID from PlayerNotAvailable where BookingDate='$BookingDate')
      and p.id not in (".implode(',',$bookingId).") 
      Order By rand()";
$result = mysqli_query($link,$sql);
unset($players);
$players=array();
if ($result) {
  while ($row = mysqli_fetch_array($result)) {
    $players[] = $row[0];
  }
}

$groupId=array();
if ($extras>0) {
  $dummies=$groupsize-$extras;
}
$p=0;
echo "<table class='table-striped table table-sm'><tr><th scope=col>#</th>";
echo "<th scope=col>Booking</td>";
for ($i=2;$i=<$groupsize;$i++) {
  echo "<th class='text-center' scope=col>$i</td>";

}
echo "</tr>";
for ($g=0; $g<$groups; $g++) {
  $GroupNumber=$g+1;
  echo "<tr>";
  echo "<td>$GroupNumber</td>";
  $pg=$groupsize;
  if ($dummies>0) {
    $dummies=$dummies-1;
    $pg=$pg-1;
  }
  unset($groupId);
  $groupId=array();
  $insert="INSERT INTO Bookings (BookingDate,GroupNo,PlayerID1,PlayerID2,PlayerID3,PlayerID4)
           VALUES ('$BookingDate','$GroupNumber'";
  $groupId[]=$bookingId[$g];
  $insert.=",'".$bookingId[$g]."'";
  for ($i=1;$i<$pg;$i++) {
    if ($p >= count($players)) continue;
    $groupId[]=$players[$p];
    $p++;
    $insert.=",'".$players[$p]."'";
  }
  for ($i=$pg;$i<$groupsize;$i++) {
    $insert.=",'0'";
  }
  $insert.=");";
  $result = mysqli_query($link,$insert);    /* Create Booking Record for Week */
  $sql="select p.id, p.name, (select count(*) from Bookings b 
                              where $BookingFilter and b.PlayerID1=p.id 
                              and b.BookingDate<>'$BookingDate') BookCount
        from Players p where id in (".implode(',',$groupId).") 
        ORDER BY FIELD(p.id,".implode(',',$groupId).")";
  $result = mysqli_query($link,$sql);
  if ($result) {
    $cols=0;
    while ($row = mysqli_fetch_array($result)) {
      echo "<td>".$row[1]."(".$row[2].")</td>";
      $cols=$cols+1;
    }
    for ($i=$cols;$i<$groupsize;$i++) {
      echo "<td>&nbsp;</td>";
    }
    echo "</tr>";
  } else {
    echo mysqli_error($link);
  }
}
echo "</table>";
require "Footer.php";
mysqli_close($link);
?>
