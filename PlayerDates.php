<?php
error_reporting(0);
require "Database.php";
$PlayerId=(isset($_REQUEST["PlayerId"])) ? $_REQUEST["PlayerId"] : "0";
$Sendmail=(isset($_REQUEST["Sendmail"])) ? $_REQUEST["Sendmail"] : "0";
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
    echo "<h5 style='padding:10px'>Playing Dates for ";
    if ($PlayerId=="0") {
      echo "</h5><input placeholder='Enter Membership No' name=MemberNo id=MemberNo size=30>";
      echo "<input type=button value='Show' onclick='GetPlayerId()'><br>";
    }
    echo "$Player</h5>";
    echo "<table class='table-striped table'><tr>".
             "<th scope=col style='width:20%;white-space:nowrap'>Date</th><th scope=col>Playing</th></tr>";
    for ($i=0; $i<26; $i++) {
      $WeekOff=$i-$Offset;
//      $TimeAdjustS="Saturday $WeekOff weeks";
//      $TimeAdjustW="Wednesday $WeekOff weeks";
//      if (strtotime($TimeAdjustW)>strtotime($TimeAdjustS)) {
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
             "<td onclick=\"SetUnavailable(this,'$PlayerId','$Week');\">".$Available."</td></tr>";
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
             "<td onclick=\"SetUnavailable(this,'$PlayerId','$Week');\">".$Available."</td></tr>";
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
  if ($Sendmail=="1") {
    $sql="SELECT p.Email Email ,p.name name, p.id FROM Players p
          order by p.surname";
    $result = mysqli_query($link,$sql);
    $CopyTo = "";
    $CopyToRows = "";
    if ($result) {
      while ($row = mysqli_fetch_array($result)) {
        $CopyTo .= $row[1]."<".$row[0].">,";
        $CopyToRows .= "<tr><td style='white-space:nowrap;padding:2px'>".
                           "<a href=http://teamsheet.net/golf/PlayerDates.php?PlayerId=".$row[2].">".
                           "<img src=http://teamsheet.net/golf/calendar.png></a></td>".
                       "<td style='white-space:nowrap'>".$row[1]."</td>".
                       "<td style='white-space:nowrap'>".$row[0]."</td></tr>";
      }
    }
    $from = "HGC Table Tappers <noreply@teamsheet.net>";
    $mail_subject="HGC Table Tapper Bookings for $NiceBookingDate";
    $mail_headers =  "MIME-Version: 1.0" . "\r\n";
    $mail_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $mail_headers .= "From: ".($from)."\r\n";
    $mail_headers .= "Reply-To: ".($from)."\r\n";
    $mail_headers .= "Return-Path: ".($from)."\r\n";
    $mail_headers .= "X-Priority: 3\r\n";
    $mail_headers .= "X-Mailer: PHP". phpversion() ."\r\n";
    $mail_headers .= "CC:brian.ackland@me.com; \r\n";
    $mail_message = "<html><head><title>HTML Title</title></head><body>
    <table width=100% align=center style='text-align:left;background-color:#fff'>
    <tr><td>
    <H1>HGC Table Tapper</H1>
    Test Test Test
    </td></tr>
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Bookings Open at 2PM on Wednesday<br></td></tr>
    <tr><td>Groups for (date)</td></tr>
    <tr><td>&nbsp;<br></td></tr>
    </table>
    <table style='width:100%;text-align:left;background-color:#fff'>
    <tr><td colspan=3 style='text-align:center'>&nbsp;</td></tr>
    <tr><td colspan=3 style='text-align:center'>&nbsp;</td></tr>
    <tr><td colspan=3 style='text-align:left;padding-left:10px'>
    HGC Table Tapper Player List
    </td></tr>
    $CopyToRows
    </table>";

    mail("brian.ackland@me.com",
       $mail_subject,
       $mail_message,
       $mail_headers);
    echo "<script type=text/javascript>alert(\"Mail Sent\");</script>";
  }
  mysqli_close($link);
?>

