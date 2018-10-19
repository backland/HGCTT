<?php
  error_reporting(E_ALL);
  require "Database.php";
  require "Header.php";
  require "Navigation.php";
  echo "<div class='card d-none d-sm-block'>
        <div class='card-body'>SMS Notifcation Log<ul class='list-group'>";
  $filename = 'notification.log';
  $file = fopen("notification.log", "r") or exit("Unable to open file!");
  while(!feof($file)) {
     $line = trim(fgets($file));
     if (!empty($line)) { echo "<li class='list-group-item'>".$line. "</li>"; }
  }
  fclose($file);
  echo "</ul></div></div>";
  require "Footer.php";
?>
