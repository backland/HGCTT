<?php
error_reporting(0);
require "Database.php";
$Offset=(isset($_REQUEST["Offset"])) ? $_REQUEST["Offset"] : "0";
$Day=(isset($_REQUEST["Day"])) ? $_REQUEST["Day"] : "Sat";
if ($Day=="Sat"){ 
  $Day="Saturday"; 
  $DayFilter = "p.Saturday=1"; 
  $BookingFilter="date_format(a.BookingDate,'%a')='Sat'"; 
}
if ($Day=="Wed"){ 
  $Day="Wednesday"; 
  $DayFilter = "p.Wednesday=1"; 
  $BookingFilter="date_format(a.BookingDate,'%a')='Wed'"; 
}
$TimeAdjust="$Day $Offset weeks";
$BookingDate=date("Y-m-d",strtotime($TimeAdjust));
$sql="SELECT p.ID, p.Name, p.Surname, p.Given 
      FROM Players p WHERE $DayFilter
      Order By p.Surname, p.Given";
$results = mysqli_query($link,$sql);
echo mysqli_error($link);
require "Header.php"; 
require "Navigation.php"; ?>
<div class="table-responsive">
<?php
    echo "<table class='table-striped table'><tr>".
             "<th scope=col>Name</th>";
    for ($i=0; $i<12; $i++) {
      $WeekOff=$i-$Offset;
      $TimeAdjust="$Day $WeekOff weeks";
      $Week=date("d M",strtotime($TimeAdjust));
      echo "<th scope=col class='text-center'>$Week</th>";
    }
    echo "</tr>";
if ($results) {
  $rowCount=0;
  while ($row = mysqli_fetch_array($results)) {
    $rowCount=$rowCount+1;
    if ($rowCount%6==0) {
      $rowCount=0;
      echo "<tr><td>Name</td>";
      for ($i=0; $i<12; $i++) {
        $WeekOff=$i-$Offset;
        $TimeAdjust="$Day $WeekOff weeks";
        $Week=date("d M",strtotime($TimeAdjust));
        echo "<td class='text-center'>$Week</td>";
      }
      echo "</tr>";
    }
    $PlayerId=$row[0];
    $WeekOff=$i-$Offset;
    echo "<tr><td class=\"text-nowrap\">".$row[1]."</td>";
    for ($i=0; $i<12; $i++) {
      $WeekOff=$i-$Offset;
      $TimeAdjust="$Day $WeekOff weeks";
      $Week=date("Ymd",strtotime($TimeAdjust));
      $sql="SELECT 'checked' from PlayerNotAvailable where BookingDate='$Week' and PlayerId='$PlayerId'";
      $Checked="";
//      $Available="<i class=\"fal fa-check-square text-success\"></i>";
      $Available="";
      if ($f = mysqli_query($link,$sql)) {
        if (mysqli_num_rows($f)>0) {
          $Available="<i class=\"fal fa-times fa-2x text-danger\"></i>";
          $Checked="checked";
        }
      }
      echo "<td class='text-center' onclick=\"SetUnavailable(this,'$PlayerId','$Week');\">".$Available."</td>";
    }
    echo "</tr>";
  }
}
?>
</table>
<form id=PostData>
<input type=hidden id=PlayerId name=PlayerId value="XX">
<input type=hidden id=BookingDate name=BookingDate value="XXXXX">
</form>
</div>
<?php require "Footer.php"?>
<script type=text/javascript>
function SetUnavailable(el,PlayerId,BookingDate) {
//   $("#BookingDate").val(BookingDate);
//   $("#PlayerId").val(PlayerId);
//   $.post("Unavailable.php",$( "#PostData" ).serialize());
//   if (el.innerHTML=="<i class=\"fal fa-check-square text-success\"></i>") {
//   if (el.innerHTML=="") {
//      el.innerHTML="<i class=\"fal fa-times fa-2x text-danger\"></i>";
//   } else {
//     el.innerHTML="<i class=\"fal fa-check-square text-success\"></i>";
//     el.innerHTML="";
//   }
}
</script>
