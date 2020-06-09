<?php
  error_reporting(0);
  require "Database.php";
  function yesNo($n){ return $n == 1 ? 'Yes' : ' '; }
  $LoadError="";
  $sql="select KeyValue from config where KeyName='GroupSize'";
  $results = mysqli_query($link,$sql);
  $KeyValue = mysqli_fetch_assoc(mysqli_query($link, "select KeyValue from config where KeyName='GroupSize'"));
  $DefaultGroupSize = $KeyValue['KeyValue'];
  $Password=(isset($_REQUEST["Password"]))   ? $_REQUEST["Password"] : "";
  $Narrative=(isset($_REQUEST["Narrative"])) ? $_REQUEST["Narrative"] : "";
  $Sendmail=(isset($_REQUEST["Sendmail"]))   ? $_REQUEST["Sendmail"] : "0";
  $Generate=(isset($_REQUEST["Generate"]))   ? $_REQUEST["Generate"] : "0";
  $GroupSize=(isset($_REQUEST["GroupSize"])) ? $_REQUEST["GroupSize"] : $DefaultGroupSize;
  $sql="update config set KeyValue='$GroupSize' where KeyName='GroupSize'";
if (mysqli_query($link, $sql)) {
    $SQLError= "";
} else {
    $SQLError= $sql."<br>Error updating record: " . mysqli_error($link)."<br>";
}

  $Offset=(isset($_REQUEST["Offset"])) ? $_REQUEST["Offset"] : "1";
  $ColumnWidth="48%";
  if ($GroupSize>2) $ColumnWidth="32%";
  if ($GroupSize>3) $ColumnWidth="24%";
  $Day=(isset($_REQUEST["Day"])) ? $_REQUEST["Day"] : "Sat";
  $showCalculation="";
  $DayShort=$Day;
  if ($Day=="Sat"){ 
    $BookTime="8PM";
    $BookDay="Friday";
    $BookOffset=$Offset-2;
    $Day="Saturday"; 
    $DayFilter = "p.Saturday=1"; 
    $BookingFilter="date_format(b.BookingDate,'%a')='Sat'"; 
  }
  if ($Day=="Wed"){ 
    $BookTime="8PM";
    $BookDay="Tuesday";
    $BookOffset=$Offset-2;
    $Day="Wednesday"; 
    $DayFilter = "p.Wednesday=1"; 
    $BookingFilter="date_format(b.BookingDate,'%a')='Wed'"; 
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
  if ($Password!="piss-off"&&($Sendmail==1||$Generate==1)) {
    $RandomTaunt=$Taunt[rand(0,5)];
    $LoadError="alert(\"$RandomTaunt\");";
    $Generate=0;
    $Sendmail=0;
  }
  if ($Generate==1) {
    if ($BookingDate<date("Y-m-d")) {
      $LoadError="alert(\"Booking Date in Past Generation Not Allowed\");";
      $Generate=0;
    } else {
      $sql="SELECT BookingDate from BookingLock where BookingDate='$BookingDate'";
      $result = mysqli_query($link,$sql);    /* Create Booking Record for Week */
      if ($result) {
        if(mysqli_num_rows($result) > 0){
          $LoadError="alert(\"Booking Date Locked Generation Not Allowed\");";
          $Generate=0;
        }
      }
    }
  }
  require "Header.php";
  require "Navigation.php";
  echo "<form action=Bookings.php method=post>";
  echo "<input type=hidden name=Generate value=0>";
  echo "<input type=hidden name=Sendmail value=0>";
  echo "<input type=hidden name=Day value='$DayShort'>";
  echo "<div class=\"alert alert-success\" role=\"alert\">";
  echo "<h3>Generate $Day Groups</h3>";
  echo "Book On : ".$BookOnDate."<br>";
  echo "Group Size :  ";
  echo "<select name=GroupSize onchange='this.form.submit();'>";
  if ($GroupSize==2) { echo "<option selected value=2>2</option>";
              } else { echo "<option value=2>2</option>"; }
  if ($GroupSize==3) { echo "<option selected value=3>3</option>";
              } else { echo "<option value=3>3</option>"; }
  if ($GroupSize==4) { echo "<option selected value=4>4</option>";
              } else { echo "<option value=4>4</option>"; }
  echo "</select><br>";
  echo $SQLError;
  echo "Booking Date :  ";
  echo "<select name=Offset onchange='this.form.submit();'>";
  for ($i=-5;$i<7;$i++) {
    $TimeAdjust="$Day +$i weeks";
    $iDate=date("D d M Y",strtotime($TimeAdjust));
    if ($iDate==$NiceBookingDate) {
      echo "<option selected value='$i'>$iDate</option>";
    } else {
      echo "<option value='$i'>$iDate</option>";
    }
  }
  echo "</select>";
  echo "</div>";
  echo "</form>";
  $sql="SELECT p.Email Email ,concat(p.surname,' ',p.given) name, p.id FROM Players p
        where $DayFilter order by p.surname";
  $result = mysqli_query($link,$sql);
  $CopyTo = "";
  $SendToList = "";
  $CopyToList = "";
  $CopyToRows = "";
  if ($result) {
    while ($row = mysqli_fetch_array($result)) {
      $CopyTo .= $row[1]."<".filter_var($row[0],FILTER_SANITIZE_EMAIL).">,";
      $SendToList .= $row[1]." <".filter_var($row[0],FILTER_SANITIZE_EMAIL).">, ";
      $CopyToList .= "Cc: \"".$row[1]."\"<".filter_var($row[0],FILTER_SANITIZE_EMAIL).">".PHP_EOL;
      $CopyToRows .= "<tr><td style='white-space:nowrap;padding:2px'>".PHP_EOL.
                         "<a href=https://hgctt.com/PlayerDates.php>".PHP_EOL. /*  ?PlayerId=".$row[2].">".PHP_EOL. */
                         "<img src=https://hgctt.com/calendar.png></a></td>".PHP_EOL.
                     "<td style='white-space:nowrap'>".PHP_EOL.
                     "<a href=https://hgctt.com/PlayerDates.php>".PHP_EOL.   /* ?PlayerId=".$row[2].">".PHP_EOL. */
                     htmlspecialchars($row[1])."</a></td>".PHP_EOL.
                     "<td style='white-space:nowrap'>".filter_var($row[0],FILTER_SANITIZE_EMAIL)."</td></tr>".PHP_EOL;
    }
  }
  $CopyTo=rtrim($CopyTo,",");
  if ($Generate==1) {
    $sql="DELETE FROM Bookings Where BookingDate='$BookingDate';";
    $result = mysqli_query($link,$sql);
    $sql="SELECT count(*)
          FROM Players p where $DayFilter
          and  p.id not in (SELECT PlayerID from PlayerNotAvailable where BookingDate='$BookingDate')";
    $results = mysqli_query($link,$sql);
    if ($results) {
      $row = mysqli_fetch_array($results);
      $groups=ceil($row[0]/$GroupSize);
      $extras=$row[0]%$GroupSize;
    }
    $sql="select ID, PlayerName, TotalBooked, TotalPlayed, NotPlayingThisWeek,BookedLastWeek, TotalBooked/TotalPlayed + NotPlayingThisWeek + BookedLastWeek  ratio from 
          (select p.id ID, p.name PlayerName,
             (select count(*) from Bookings b 
              where b.PlayerID1=p.id and $BookingFilter 
              and   b.BookingDate<'$BookingDate') TotalBooked,
             (select count(*) from Bookings b 
              where $BookingFilter and b.BookingDate<'$BookingDate' 
              and (b.PlayerID1=p.id or b.PlayerID2=p.id or b.PlayerID3=p.id or b.PlayerID4=p.id)) TotalPlayed,
             (SELECT 0 from Bookings b 
              where b.BookingDate='$LastBookingDate' 
              and (b.PlayerID1=p.id or b.PlayerID2=p.id or b.PlayerID3=p.id or b.PlayerID4=p.id)) is null NotPlayingThisWeek,
             (SELECT 1 from Bookings 
              where BookingDate='$LastBookingDate' and PlayerID1=p.id) is not null BookedLastWeek
           from Players p 
           where $DayFilter
           and p.id not in (Select PlayerID from PlayerNotAvailable where BookingDate='$BookingDate')) as Playing order by ratio, rand()";
    $showCalculation="<div class='card'>
                       <div class='card-body'>
                       <h5 class='card-title'>Booking Calculation</h5>
                      <table class='table-striped table table-sm' style='font-size:10px'>
                      <tr><th>Name</td>
                          <th scope=col class='text-center'>Booked</th>
                          <th scope=col class='text-center'>Played</th>
                          <th scope=col class='text-center'>Out <br>$LastBookingDate</th>
                          <th scope=col class='text-center'>Booked<br> $LastBookingDate</th>
                          <th scope=col class='text-center'>Ratio</th></tr>";
    $results = mysqli_query($link,$sql);
    if ($results) {
      while ($row = mysqli_fetch_array($results)) {
        $players[] = $row[0];
        $showCalculation.="<tr><td class='text-nowrap'>".$row[1]."</td>".
                          "    <td class='text-center'>".$row[2]."</td>".
                          "    <td class='text-center'>".$row[3]."</td>".
                          "    <td class='text-center'>".yesNo($row[4])."</td>".
                          "    <td class='text-center'>".yesNo($row[5])."</td>".
                          "    <td class='text-center'>".sprintf('%0.2f',$row[6])."</td></tr>";
      }
    }
    $showCalculation.="</table>";
    $showCalculation.="<div class='card'>
                       <div class='card-body'>
                       <h5 class='card-title'>Calculation</h5>
                       <p class='card-text'>Ratio is the number of booked rounds / number of played rounds. <br>
                       plus One if player was recorded to do booking last week. <br>
                       plus One if player is not booked to play the day after the booking sheet opens.<br>
                       only players that a scheduled to play this week are included in calculation.<p></div></div></div></div>";
    for ($g=0; $g<$groups; $g++) {
      $bookingId[]=$players[$g];
    }
    $sql="SELECT p.id id,p.name name FROM Players p
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
    if ($extras>0) { $dummies=$GroupSize-$extras; }
    $p=0;
    for ($g=0; $g<$groups; $g++) {
      $GroupNumber=$g+1;
      $pg=$GroupSize;
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
      $cols=1;
      for ($i=1;$i<$pg;$i++) {
        if ($p >= count($players)) continue;
        $groupId[]=$players[$p];
        $insert.=",'".$players[$p]."'";
        $p++;
        $cols=$cols+1;
      }
      for ($i=$cols;$i<4;$i++) {
        $insert.=",'0'";
      }
      $insert.=");";
      $result = mysqli_query($link,$insert);    /* Create Booking Record for Week */
    }
  }
  $tableLarge="<div class='card d-none d-sm-block'>
        <div class='card-body'>
        <table class='table-striped table table-sm'>
        <tr><th scope=col>#</th>
            <th scope=col>Booking</td>";
  for ($g=2; $g<$GroupSize+1; $g++) {
    $tableLarge.="<th scope=col>Player $g</td>";
  }
  $tableLarge.="</tr>";

  $tableSmall="<div class='card d-block d-sm-none'>
        <div class='card-body'>
        <table class='table-striped table table-sm'>
        <tr><th scope=col>#</th>
            <th scope=col>Group</td></tr>";
  $sql="select a.GroupNo,
        (select concat(given,' ',surname) from Players where id=PlayerID1) Player1,
        (select concat(given,' ',surname) from Players where id=PlayerID2) Player2";
  if ($GroupSize>2){ $sql.=",(select concat(given,' ',surname) from Players where id=PlayerID3) Player3";}
  if ($GroupSize>3){ $sql.=",(select concat(given,' ',surname) from Players where id=PlayerID4) Player4";}
  $sql.=" from Bookings a
        where a.BookingDate = '$BookingDate'
        ORDER BY a.GroupNo";
  $result = mysqli_query($link,$sql);
  $grp=0;
  if ($result) {
    $cols=0;
    $MailTable="";
    while ($row = mysqli_fetch_array($result)) {
      $grp++;
      $p1="&nbsp;"; $p2="&nbsp;"; $p3="&nbsp;"; $p4="&nbsp;";
      if (!empty($row[1])) $p1="<b>".htmlspecialchars($row[1])."</b>";
      if (!empty($row[2])) $p2=htmlspecialchars($row[2]);
      if ($GroupSize>2) {if (!empty($row[3])) $p3=htmlspecialchars($row[3]);}
      if ($GroupSize>3) {if (!empty($row[4])) $p4=htmlspecialchars($row[4]);}
      $tableLarge.="<tr><td>".$row[0]."</td>
                        <td class='text-nowrap'>".$p1."</td>
                        <td class='text-nowrap'>".$p2."</td>";
      if ($GroupSize>2){ $tableLarge.="<td class='text-nowrap'>".$p3."</td>";}
      if ($GroupSize>3){ $tableLarge.="<td class='text-nowrap'>".$p4."</td>";}
      $tableLarge.="<tr>";
      $tableSmall.="<tr><td>".$row[0]."</td>
                        <td>".$p1."<br>".$p2;
      if ($GroupSize>2){ $tableSmall.="<br>".$p3;}
      if ($GroupSize>3){ $tableSmall.="<br>".$p4;}
      $tableSmall.="</td><tr>";
      if (!empty($row[1])) $p1=htmlspecialchars($row[1]);
      if (!empty($row[2])) $p2=htmlspecialchars($row[2]);
      if ($GroupSize>2){ if (!empty($row[3])) $p3=htmlspecialchars($row[3]);}
      if ($GroupSize>3){ if (!empty($row[4])) $p4=htmlspecialchars($row[4]);}
      $MailTable.="<tr><td>".$row[0]."</td>".PHP_EOL.
                  "<td style='font-weight:bold;width:$ColumnWidth;white-space:nowrap'>".$p1."</td>".PHP_EOL.
                  "<td style='width:$ColumnWidth;white-space:nowrap'>".$p2."</td>".PHP_EOL;
      if ($GroupSize>2){ $MailTable.="<td style='width:$ColumnWidth;white-space:nowrap'>".$p3."</td>".PHP_EOL;}
      if ($GroupSize>3){ $MailTable.="<td style='width:$ColumnWidth;white-space:nowrap'>".$p4."</td>";}
      $MailTable.="</tr>".PHP_EOL;
 
    }
    if ($grp==0) {
       $tableLarge.= "<tr><td colspan=5 style='text-align:center'><h5>Booking Sheet Not Generated</h5></td></tr>";
       $tableSmall.= "<tr><td colspan=2 style='text-align:center'><h5>Booking Sheet Not Generated</h5></td></tr>";
    }
  } else {
    echo mysqli_error($link);
  }
  $tableSmall.= "</table></div></div>";
  $tableLarge.= "</table></div></div>";
  echo $tableSmall;
  echo $tableLarge;
?>
<form id=MailForm action="Bookings.php" Method=Post>
<input type=hidden id=frmGenerate name=Generate value="0">
<input type=hidden id=frmSendmail name=Sendmail value="1">
<input type=hidden name=GroupSize value="<?php echo $GroupSize;?>">
<input type=hidden name=Day value="<?php echo $DayShort;?>">
<input type=hidden name=Offset value="<?php echo $Offset;?>">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Message</h5>
    <textarea class="form-control" id="Narrative" placeholder="Enter Email Text"  name="Narrative" rows="5"><?php echo $Narrative;?></textarea>
    <input type=password class="form-control" placeholder="Enter Password" id=frmPassword name=Password value="">
    <div class='card-body text-center'>
    <button type=button class='btn btn-success' style='width:120px' onclick="GenerateGroups();">Generate</button>
    <?php if ($grp!=0) {
      echo "<button type=button class='btn btn-success' style='width:120px' onclick='Mail();'>Send Email</button>";
    }  ?>
    </div>
  </div>
</div>
</form>
<?php   echo $showCalculation; ?>
<script type-text/javascript>
function GenerateGroups() {
  document.getElementById("frmSendmail").value="0";
  document.getElementById("frmGenerate").value="1";
  el=document.getElementById("MailForm")
  el.submit()
}
function Mail() {
  el=document.getElementById("MailForm")
  el.submit()
}
<?php echo $LoadError;?>
</script>
<?php require "Footer.php";
  if ($Sendmail=="1") {
    $MailTableHeader="<td style='width:$ColumnWidth;white-space:nowrap'>Booking Player</td>
                      <td style='width:$ColumnWidth;white-space:nowrap'>Player 2</td>";
    if ($GroupSize>2) { $MailTableHeader.="<td style='width:$ColumnWidth;white-space:nowrap'>Player 3</td>"; }
    if ($GroupSize>3) { $MailTableHeader.="<td style='width:$ColumnWidth;white-space:nowrap'>Player 4</td>"; }
    $SendToList=substr($SendToList,0,-2);  
    $from = "HGC Table Tappers <bitnami@hgctt.com>";
    $replyto = "Brian Ackland <brian.ackland@me.com>";
    $mail_subject="HGC Table Tapper Bookings for $NiceBookingDate";
    $mail_headers =  "MIME-Version: 1.0".PHP_EOL;
    $mail_headers .= "Organization: HGC Table Tapper".PHP_EOL;
    $mail_headers .= "Content-type:text/html;charset=UTF-8".PHP_EOL;
    $mail_headers .= "Content-Transfer-Encoding: 8bit".PHP_EOL;
    $mail_headers .= "From: ".($from).PHP_EOL;
    $mail_headers .= "Reply-To: ".($replyto).PHP_EOL;
    $mail_headers .= "Return-Path: ".($replyto).PHP_EOL;
    $mail_headers .= "X-Priority: 3".PHP_EOL;
    $mail_headers .= "X-Mailer: PHP".phpversion().PHP_EOL;
    $mail_message = "<html><head><title>HTML Title</title></head><body>
    <table width=100% align=center style='text-align:left;background-color:#fff'>
    <tr><td>
    <H1>HGC Table Tapper</H1>
    ".nl2br($Narrative)."
    </td></tr>
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Bookings Open at $BookTime on $BookOnDate<br></td></tr>
    <tr><td>Groups for $NiceBookingDate </td></tr>
    <tr><td>&nbsp;<br></td></tr>
    </table>
    <table style='text-align:left;background-color:#fff' border=1 cellpadding=0 cellspacing=1>
    <tr><td>#</td>
    $MailTableHeader
    </tr>
    $MailTable
    </table>
    <table style='width:100%;text-align:left;background-color:#fff'>
    <tr><td colspan=3 style='text-align:center'>&nbsp;</td></tr>
    <tr><td colspan=3 style='text-align:center'>&nbsp;</td></tr>
    <tr><td colspan=3 style='text-align:left;padding-left:10px'>
    HGC Table Tapper Player List
    </td></tr>
    $CopyToRows
    </table></body></html>";
    mail($SendToList,
       $mail_subject,
       $mail_message,
       $mail_headers);
    $insert="INSERT INTO BookingLock(BookingDate) VALUES ('$BookingDate')";
    $result = mysqli_query($link,$insert);    /* Create Booking Lock Record for Week */
 
    echo "<script type=text/javascript>alert(\"Mail Sent\");</script>";
  }
  mysqli_close($link);
?>
