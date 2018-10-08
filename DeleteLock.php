<?php
//  error_reporting(0);
  require "Database.php";
  $LoadError="";
  $Password=(isset($_REQUEST["Password"])) ? $_REQUEST["Password"] : "";
  $DeleteLock=(isset($_REQUEST["DeleteLock"])) ? $_REQUEST["DeleteLock"] : "0";
  $Offset=(isset($_REQUEST["Offset"])) ? substr($_REQUEST["Offset"],4) : "1";
  $Day=(isset($_REQUEST["Offset"])) ? substr($_REQUEST["Offset"],0,3) : "Sat";
  $DayShort=$Day;
  if ($Day=="Sat"){ 
    $BookDay="Friday";
    $BookOffset=$Offset-2;
    $Day="Saturday"; 
    $DayFilter = "p.Saturday=1"; 
    $BookingFilter="date_format(b.BookingDate,'%a')='Sat'"; 
    $BookingFilter1="date_format(b1.BookingDate,'%a')='Sat'"; 
    $BookingFilter2="date_format(b2.BookingDate,'%a')='Sat'"; 
    $BookingFilter3="date_format(b3.BookingDate,'%a')='Sat'"; 
    $BookingFilter4="date_format(b4.BookingDate,'%a')='Sat'"; 
  }
  if ($Day=="Wed"){ 
    $BookDay="Tuesday";
    $BookOffset=$Offset-2;
    $Day="Wednesday"; 
    $DayFilter = "p.Wednesday=1"; 
    $BookingFilter="date_format(b.BookingDate,'%a')='Wed'"; 
    $BookingFilter1="date_format(b1.BookingDate,'%a')='Wed'"; 
    $BookingFilter2="date_format(b2.BookingDate,'%a')='Wed'"; 
    $BookingFilter3="date_format(b3.BookingDate,'%a')='Wed'"; 
    $BookingFilter4="date_format(b4.BookingDate,'%a')='Wed'"; 
  }
  $dummies=0;
  $Today=date("D d M Y");
  $TimeAdjust="$Day +$Offset weeks";
  $BookingDate=date("Y-m-d",strtotime($TimeAdjust));
  $NiceBookingDate=date("D d M Y",strtotime($TimeAdjust));
  $TimeAdjust="$BookingDate $BookDay -2 weeks";
  $BookOnDate=date("D d M Y",strtotime($TimeAdjust));
  $LastOffset=$Offset-1;
  $TimeAdjust="$Day +$LastOffset weeks";
  $LastBookingDate=date("Y-m-d",strtotime($TimeAdjust));
  $TimeAdjust="$Day -2 weeks";
  $RecentBookingLimit=date("Y-m-d",strtotime($TimeAdjust));
  $Taunt[]="Your password is invalid.";
  $Taunt[]="Go and play with you balls. Wrong Password.";
  $Taunt[]="No You Can't. You putt like a girl.";
  $Taunt[]="Keep your head down. Thats not the password.";
  $Taunt[]="Thats wrong, Bugger Off,";
  $Taunt[]="Try Again";
  if ($Password!="delete-it"&&($DeleteLock==1)) {
    $RandomTaunt=$Taunt[rand(0,5)];
    $LoadError="alert(\"$RandomTaunt\");";
    $DeleteLock=0;
  }
  if ($DeleteLock==1) {
    $sql="SELECT BookingDate from BookingLock where BookingDate='$BookingDate'";
    $result = mysqli_query($link,$sql);    /* Check Booking Record for Week */
    if ($result) {
      if(mysqli_num_rows($result) > 0){
        $sql="DELETE from BookingLock where BookingDate='$BookingDate'";
        $result = mysqli_query($link,$sql);    /* DELETE Booking Record for Week */
        $LoadError="alert(\"Booking Date Deleted\");";
      } else {
        $LoadError="alert(\"Booking Date not Locked\");";
      }
    }
  }
  require "Header.php";
  require "Navigation.php";
  echo "<form action=DeleteLock.php method=post>";
  echo "<input type=hidden name=DeleteLock value=0>";
  echo "<input type=hidden name=Sendmail value=0>";
  echo "<input type=hidden name=Day value='$DayShort'>";
  echo "<div class=\"alert alert-success\" role=\"alert\">";
  echo "<h3>Delete Booking Lock</h3>";
  echo "Book On : ".$BookOnDate."<br>";
  echo "Booking Date :  ";
  echo "<select name=Offset onchange='this.form.submit();'>";
  for ($i=-5;$i<7;$i++) {
    $TimeAdjust="Wednesday +$i weeks";
    $iDate=date("D d M Y",strtotime($TimeAdjust));
    if ($iDate==$NiceBookingDate) {
      echo "<option selected value='Wed $i'>$iDate</option>";
    } else {
      echo "<option value='Wed $i'>$iDate</option>";
    }
    $TimeAdjust="Saturday +$i weeks";
    $iDate=date("D d M Y",strtotime($TimeAdjust));
    if ($iDate==$NiceBookingDate) {
      echo "<option selected value='Sat $i'>$iDate</option>";
    } else {
      echo "<option value='Sat $i'>$iDate</option>";
    }


  }
  echo "</select>";
  echo "</div>";
  echo "</form>";
  echo "<table class='table-striped table table-sm'><tr><th scope=col>#</th>";
  echo "<th scope=col>Booking</td>";
  echo "<th scope=col>2</td>";
  echo "<th scope=col>3</td>";
  echo "<th scope=col>4</td></tr>";
  $sql="select a.GroupNo,
        (select name from Players where id=PlayerID1) Player1,
        (select count(*) from Bookings b1
         where $BookingFilter1 and b1.PlayerID1=a.PlayerID1 and b1.BookingDate<'$BookingDate') BookCount1,
        (select name from Players where id=PlayerID2) Player2,
        (select count(*) from Bookings b2
         where $BookingFilter2 and b2.PlayerID1=a.PlayerID2 and b2.BookingDate<'$BookingDate') BookCount2,
        (select name from Players where id=PlayerID3) Player3,
        (select count(*) from Bookings b3
         where $BookingFilter3 and b3.PlayerID1=a.PlayerID3 and b3.BookingDate<'$BookingDate') BookCount3,
        (select name from Players where id=PlayerID4) Player4,
        (select count(*) from Bookings b4
         where $BookingFilter4 and b4.PlayerID1=a.PlayerID4 and b4.BookingDate<'$BookingDate') BookCount4
        from Bookings a
        where a.BookingDate = '$BookingDate'
        ORDER BY a.GroupNo";
  $result = mysqli_query($link,$sql);
  if ($result) {
    $cols=0;
    $MailTable="";
    while ($row = mysqli_fetch_array($result)) {
      $p1="&nbsp;"; $p2="&nbsp;"; $p3="&nbsp;"; $p4="&nbsp;";
      if (!empty($row[1])) $p1=htmlspecialchars($row[1])."(".$row[2].")";
      if (!empty($row[3])) $p2=htmlspecialchars($row[3])."(".$row[4].")";
      if (!empty($row[5])) $p3=htmlspecialchars($row[5])."(".$row[6].")";
      if (!empty($row[7])) $p4=htmlspecialchars($row[7])."(".$row[8].")";
      echo "<tr>";
      echo "<td>".$row[0]."</td>";
      echo "<td class='text-nowrap'>".$p1."</td>";
      echo "<td class='text-nowrap'>".$p2."</td>";
      echo "<td class='text-nowrap'>".$p3."</td>";
      echo "<td class='text-nowrap'>".$p4."</td>";
      echo "</tr>";
      if (!empty($row[1])) $p1=htmlspecialchars($row[1]);
      if (!empty($row[3])) $p2=htmlspecialchars($row[3]);
      if (!empty($row[5])) $p3=htmlspecialchars($row[5]);
      if (!empty($row[7])) $p4=htmlspecialchars($row[7]);
      $MailTable.="<tr><td>".$row[0]."</td>".PHP_EOL.
                  "<td style='font-weight:bold;width:24%;white-space:nowrap'>".$p1."</td>".PHP_EOL.
                  "<td style='width:24%;white-space:nowrap'>".$p2."</td>".PHP_EOL.
                  "<td style='width:24%;white-space:nowrap'>".$p3."</td>".PHP_EOL.
                  "<td style='width:24%;white-space:nowrap'>".$p4."</td></tr>".PHP_EOL;
 
    }
  } else {
    echo mysqli_error($link);
  }
  echo "</table>";
?>
<form id=MailForm action="DeleteLock.php" Method=Post>
<input type=hidden id=frmDeleteLock name=DeleteLock value="0">
<input type=hidden id=frmSendmail name=Sendmail value="1">
<input type=hidden name=Offset value="<?php echo $DayShort.' '.$Offset;?>">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Message</h5>
    <input type=password class="form-control" placeholder="Enter Password" id=frmPassword name=Password value="">
    <button type=button class='btn btn-success ' style='width:120px' onclick="fDeleteLock();">Delete Lock</button>
  </div>
</div>
</form>
<script type-text/javascript>
function fDeleteLock() {
  document.getElementById("frmDeleteLock").value="1";
  el=document.getElementById("MailForm")
  el.submit()
}
<?php echo $LoadError;?>
</script>
<?php require "Footer.php";
  mysqli_close($link);
?>
