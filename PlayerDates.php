<?php
error_reporting(0);
require "Database.php";
$PlayerId=(isset($_REQUEST["PlayerId"])) ? $_REQUEST["PlayerId"] : "0";
$Offset=(isset($_REQUEST["Offset"])) ? $_REQUEST["Offset"] : "0";
  $sql="SELECT p.ID, p.Name, p.Surname, p.Given , p.Wednesday, p.Saturday
        FROM Players p WHERE ID=$PlayerId";
  $results = mysqli_query($link,$sql);
  echo mysqli_error($link);
  while ($row = mysqli_fetch_array($results)) {
    $Player=$row[1];
    $Sat=$row[5];
    $Wed=$row[4];
  }
require "Header.php"; 
require "Navigation.php"; ?>
<div class="panel">
  <div class="panel-body">
<div class="table-responsive">
<?php
    echo "<h5 style='padding:10px'>";
    if ($PlayerId=="0") {
      echo "</h5><input placeholder='Enter Membership No' name=MemberNo id=MemberNo size=30>";
      echo "<input type=button value='Show' onclick='GetPlayerId()'><br>";
    }
    echo "$Player";
    echo "<button type=button class='btn btn-danger float-right '  onclick='GoBack();'>Back</button></h5>";
    echo "<table class='table-striped table'><tr>".
             "<th scope=col style='width:20%;white-space:nowrap'>Date</th><th scope=col class='text-center'>Playing</th></tr>";
    for ($i=0; $i<26; $i++) {
      $WeekOff=$i-$Offset;
      if ($Wed==1) {
        $TimeAdjust="Wednesday $WeekOff weeks";
        $WeekDay=date("D d M Y",strtotime($TimeAdjust));
        $Week=date("Ymd",strtotime($TimeAdjust));
        $sql="SELECT 'checked' from PlayerNotAvailable where BookingDate='$Week' and PlayerId='$PlayerId'";
        $Checked="";
        $Available="";
        $Available="<i class=\"fal fa-check fa-2x text-success\"></i>";
        if ($f = mysqli_query($link,$sql)) {
          if (mysqli_num_rows($f)>0) {
            $Available="<i class=\"fal fa-times fa-2x text-danger\"></i>";
            $Checked="checked";
          }
        echo "<tr><td style='width:20%;white-space:nowrap'>$WeekDay</td>".
             "<td class='text-center' onclick=\"SetUnavailable(this,'$PlayerId','$Week');\">".$Available."</td></tr>";
        }
      }
      if ($Sat==1) {
        $TimeAdjust="Saturday $WeekOff weeks";
        $WeekDay=date("D d M Y",strtotime($TimeAdjust));
        $Week=date("Ymd",strtotime($TimeAdjust));
        $sql="SELECT 'checked' from PlayerNotAvailable where BookingDate='$Week' and PlayerId='$PlayerId'";
        $Checked="";
        $Available="";
        $Available="<i class=\"fal fa-check fa-2x text-success\"></i>";
        if ($f = mysqli_query($link,$sql)) {
          if (mysqli_num_rows($f)>0) {
            $Available="<i class=\"fal fa-times fa-2x text-danger\"></i>";
            $Checked="checked";
        }
        echo "<tr><td style='width:20%;white-space:nowrap'>$WeekDay</td>".
             "<td class='text-center' onclick=\"SetUnavailable(this,'$PlayerId','$Week');\">".$Available."</td></tr>";
        }
      }
    }
?>
</table>
<form id=PostData>
<input type=hidden id=PlayerId name=PlayerId value="XX">
<input type=hidden id=BookingDate name=BookingDate value="XXXXX">
</form>
</div>
</div>
</div>
<?php require "Footer.php"?>
<script type=text/javascript>
function SetUnavailable(el,PlayerId,BookingDate) {
   $("#BookingDate").val(BookingDate);
   $("#PlayerId").val(PlayerId);
   $.post("Unavailable.php",$( "#PostData" ).serialize());
   if (el.innerHTML=="<i class=\"fal fa-check fa-2x text-success\"></i>") {
      el.innerHTML="<i class=\"fal fa-times fa-2x text-danger\"></i>";
   } else {
     el.innerHTML="<i class=\"fal fa-check fa-2x text-success\"></i>";
   }
}
function GoBack() {
  history.back();
}
function GetPlayerId() {
   lookupURL="MemberLookup.php?MemberNo="+$("#MemberNo").val();
   $.get(lookupURL,
    function(data) {
      if (data=="INVALID") { alert("Invalid Member No. Try Again"); }
      else { location.href="PlayerDates.php?PlayerId="+data; }
    });
}
</script>
<?php
  mysqli_close($link);
?>

