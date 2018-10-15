<?php
error_reporting(0);
require "Database.php";
$ID=(isset($_REQUEST["ID"])) ? $_REQUEST["ID"] : "";
if (!is_numeric($ID)) exit;
if (isset($_POST["cmdUpdate"])) {
    $MemberNo=(isset($_REQUEST["MemberNo"])) ? $_REQUEST["MemberNo"] : null;
    $Name=(isset($_REQUEST["Name"])) ? $_REQUEST["Name"] : null;
    $Given=(isset($_REQUEST["Given"])) ? $_REQUEST["Given"] : null;
    $Surname=(isset($_REQUEST["Surname"])) ? $_REQUEST["Surname"] : null;
    $Email=(isset($_REQUEST["Email"])) ? $_REQUEST["Email"] : null;
    $Saturday=(isset($_REQUEST["Saturday"])) ? $_REQUEST["Saturday"] : null;
    $Wednesday=(isset($_REQUEST["Wednesday"])) ? $_REQUEST["Wednesday"] : null;
    $SQL="UPDATE Players SET  
             MemberNo= ?,
             Name= ?,
             Given= ?,
             Surname= ?,
             Email= ?,
             Wednesday= ?,
             Saturday= ?
          WHERE ID= ? ";
   $stmt = mysqli_prepare($link, $SQL);
   mysqli_stmt_bind_param($stmt, 'issssiii', $MemberNo,$Name,$Given, $Surname, $Email,$Wednesday,$Saturday,$ID);
   mysqli_stmt_execute($stmt);
   header("Location: index.php");
   exit();
}

$sql="SELECT * FROM Players where Id=$ID";
$results = mysqli_query($link,$sql);
$player = mysqli_fetch_array($results);
$Sat=($player[6]=='1')? "checked":"";
$Wed=($player[8]=='1')? "checked":"";
require "Header.php"; 
require "Navigation.php";

?>
<div class="panel">
  <div class="panel-body">
<form id=Player name=Player action=EditPlayer.php method=POST>
<ul class="list-group">
  <li class="list-group-item"><label>Member No</label>
   <input class='form-control' id=MemberNo name=MemberNo type=text value='<?php echo $player[1]; ?>'></li>
  <li class="list-group-item"><label>Nick Name</label>
   <input size=30 class='form-control' id=Name name=Name type=text value='<?php echo $player[4]; ?>'></li>    
  <li class="list-group-item"><label>Given Name</label>
   <input size=30 class='form-control' id=Given name=Given type=text value='<?php echo $player[2]; ?>'></li>    
  <li class="list-group-item"><label>Surname</label>
   <input size=40 class='form-control' id=Surname name=Surname type=text value='<?php echo $player[3]; ?>'></li>    
  <li class="list-group-item"><label>Email</label>
   <input size=40 class='form-control' id=Email name=Email type=text value='<?php echo $player[5]; ?>'></li>    
  <li class="list-group-item">
     <div class="custom-control custom-checkbox custom-control-inline">
       <input type="checkbox" class="custom-control-input" id=Wednesday name='Wednesday' <?php echo $Wed;?> value=1>
       <label class="custom-control-label" for="Wednesday">Wednesday</label>
     </div>
     <div class="custom-control custom-checkbox custom-control-inline">
       <input type="checkbox" class="custom-control-input" id=Saturday name='Saturday' <?php echo $Sat;?> value=1> 
       <label class="custom-control-label" for="Saturday">Saturday</label>
     </div>
        </li>    
  </ul>
<input type=hidden name=ID value="<?php echo $player[0]; ?>">
<input type=hidden name=cmdUpdate value="<?php echo $player[0]; ?>">
  <li class="list-group-item" style='text-align:center'>
   <button type=button class='btn btn-danger '  style='width:120px' onclick="CancelForm();">Cancel</button>
   <button type=button class='btn btn-success ' style='width:120px' onclick="SaveForm();">Save</button>
  </li>    
</form> 
</div>     
</div>     
</div>
<script type-text/javascript>
function CancelForm() {
    location.href="Players.php";  
}
function SaveForm() {
   document.Player.submit();  
}
</script>
<?php require "Footer.php"?>
