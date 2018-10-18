<?php
error_reporting(0);
require "Database.php";
$sql="SELECT * FROM Players
      Order By surname, given";
$results = mysqli_query($link,$sql);
require "Header.php"; 
require "Navigation.php"; ?>
<div class="table-responsive">
<?php
    echo "<table class='table-striped table table-hover'><tr><th scope=col>#</th>".
             "<th scope=col>Name</th>".
             "<th scope=col class='text-center'>Wed</th>".
             "<th scope=col class='text-center'>Sat</th>".
             "<th scope=col>Email</th>".
             "<th scope=col>Mobile</th></tr>";
if ($results) {
  while ($row = mysqli_fetch_array($results)) {
    $Sat=($row[6]=='1')? "<i class=\"fas fa-golf-club text-success\"></i>":"";
    $Wed=($row[8]=='1')? "<i class=\"fas fa-golf-club text-success\"></i>":"";
    echo "<tr>".
             "<td class='text-nowrap'>".
             "<a href='PlayerDates.php?PlayerId=".$row[0]."'>".
             "<i class=\"fas fa-calendar text-success\"></i>&nbsp;".
             $row[1]."<a></td>".
             "<td class='text-nowrap'><a href='EditPlayer.php?ID=".$row[0]."'>".
             "<i class=\"fas fa-edit text-success\"></i>&nbsp;".
             $row[3].", ".$row[2]."<a></td>".
             "<td class='text-center'>$Wed</td>".
             "<td class='text-center'>$Sat</td>".
             "<td>".$row[5]."</td>".
             "<td>".$row[9]."</td></tr>";
  }
}
?>
</table>
</div>
<?php require "Footer.php"?>
