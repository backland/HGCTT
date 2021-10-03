<?php
//  error_reporting(0);
  require "Database.php";
  $LoadError="";
  $BookOffset=(isset($_REQUEST["BookOffset"])) ? $_REQUEST["BookOffset"] : "Sat 0";
  $Day=substr($BookOffset,0,3);
  $Offset=substr($BookOffset,4,2);
  $DayShort=$Day;
  if ($Day=="Sat"){ 
    $BookDay="Tuesday";
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
    $BookDay="Saturday";
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
  $TimeAdjust="$BookingDate $BookDay -1 weeks";
  $BookOnDate=date("D d M Y",strtotime($TimeAdjust));
  $LastOffset=$Offset-1;
  $TimeAdjust="$Day +$LastOffset weeks";
  $LastBookingDate=date("Y-m-d",strtotime($TimeAdjust));
  $TimeAdjust="$Day -2 weeks";
  $RecentBookingLimit=date("Y-m-d",strtotime($TimeAdjust));
  require "Header.php";
  require "Navigation.php";
  echo "<form action=ViewBookings.php method=post>";
  echo "<input type=hidden name=Generate value=0>";
  echo "<input type=hidden name=Sendmail value=0>";
  echo "<input type=hidden name=Day value='$DayShort'>";
  echo "<div class=\"alert alert-success\" role=\"alert\">";
  echo "<h3>$Day Booking Sheet </h3>";
  echo "Book On : ".$BookOnDate." at 2PM<br>";
  echo "Booking Date :  ";
  echo "<select name=BookOffset onchange='this.form.submit();'>";
  for ($i=-5;$i<2;$i++) {
    $TimeAdjust="Wed +$i weeks";
    $iDate=date("D d M Y",strtotime($TimeAdjust));
    $of="Wed $i";
    if ($iDate==$NiceBookingDate) {
      echo "<option selected value='$of'>$iDate</option>";
    } else {
      echo "<option value='$of'>$iDate</option>";
    }
    $TimeAdjust="Sat +$i weeks";
    $iDate=date("D d M Y",strtotime($TimeAdjust));
    $of="Sat $i";
    if ($iDate==$NiceBookingDate) {
      echo "<option selected value='$of'>$iDate</option>";
    } else {
      echo "<option value='$of'>$iDate</option>";
    }
  }
  echo "</select>";
  echo "</div>";
  echo "</form>";
  $tableLarge="<div class='card d-none d-sm-block'>
        <div class='card-body'>
        <table class='table-striped table table-sm'>
        <tr><th scope=col>#</th>
            <th scope=col>Booking</td>
            <th scope=col>Player 2 </td>
            <th scope=col>Player 3</td>
            <th scope=col>Player 4</td></tr>";

  $tableSmall="<div class='card d-block d-sm-none'>
        <div class='card-body'>
        <table class='table-striped table table-sm'>
        <tr><th scope=col>#</th>
            <th scope=col>Group</td></tr>";

  $sql="select a.GroupNo,
        (select concat(given,' ',surname) from Players where id=PlayerID1) Player1,
        (select concat(given,' ',surname) from Players where id=PlayerID2) Player2,
        (select concat(given,' ',surname) from Players where id=PlayerID3) Player3,
        (select concat(given,' ',surname) from Players where id=PlayerID4) Player4
        from Bookings a
        where a.BookingDate = '$BookingDate'
        ORDER BY a.GroupNo";
  $result = mysqli_query($link,$sql);
  if ($result) {
    $cols=0;
    $grp=0;
    while ($row = mysqli_fetch_array($result)) {
      $grp++;
      $p1="&nbsp;"; $p2="&nbsp;"; $p3="&nbsp;"; $p4="&nbsp;";
      if (!empty($row[1])) $p1="<b>".htmlspecialchars($row[1])."</b>";
      if (!empty($row[2])) $p2=htmlspecialchars($row[2]);
      if (!empty($row[3])) $p3=htmlspecialchars($row[3]);
      if (!empty($row[4])) $p4=htmlspecialchars($row[4]);
      $tableLarge.="<tr><td>".$row[0]."</td>
                        <td class='text-nowrap'>".$p1."</td>
                        <td class='text-nowrap'>".$p2."</td>
                        <td class='text-nowrap'>".$p3."</td>
                        <td class='text-nowrap'>".$p4."</td><tr>";
      $tableSmall.="<tr><td>".$row[0]."</td>
                        <td>".$p1."<br>".$p2."<br>".$p3."<br>".$p4."</td></tr>";
    }
    if ($grp==0) {
       $tableLarge.= "<tr><td colspan=5 style='text-align:center'><h3>Booking Sheet Not Created</td></tr>";
       $tableSmall.= "<tr><td colspan=2 style='text-align:center'><h3>Booking Sheet Not Created</td></tr>";
    }
  } else {
    echo mysqli_error($link);
  }
  $tableSmall.= "</table></div></div>";
  $tableLarge.= "</table></div></div>";
  echo $tableSmall;
  echo $tableLarge;
?>
<?php require "Footer.php";
  mysqli_close($link);
?>
