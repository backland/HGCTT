<?php
  $json = str_replace("\n","\\n",file_get_contents('php://input'));
  $jsonArray = json_decode($json,true); //convert JSON into array
  $xapikey       =(isset($_SERVER["HTTP_X_API_KEY"])) ?   $_SERVER["HTTP_X_API_KEY"]    : null; 
  $messageId     =(isset($jsonArray["messageId"])) ?      $jsonArray["messageId"]      : null;
  $sourceAddress =(isset($jsonArray["sourceAddress"])) ?  $jsonArray["sourceAddress"]  : null;
  $messageContent=(isset($jsonArray["messageContent"])) ? $jsonArray["messageContent"] : null;
  $replyContent  =(isset($jsonArray["replyContent"])) ?   $jsonArray["replyContent"]   : null;
  $accountId     =(isset($jsonArray["accountId"])) ?      $jsonArray["accountId"]      : null;
  $messageStatus =(isset($jsonArray["messageStatus"])) ?  $jsonArray["messageStatus"]  : null;
  if ($xapikey != "apiG0lf@HGCTT") exit();
  $filecontent="x-api-key = $xapikey\n".
               "messageId = $messageId\n".
               "sourceAddress = $sourceAddress \n".
               "messageContent = $messageContent\n".
               "replyContent = $replyContent\n".
               "accountId = $accountId\n".
               "messageStatus = $messageStatus\n";
  file_put_contents("sms-hook.log",$filecontent, FILE_APPEND);
//  $filecontent.="\n\nSERVER\n";
//  foreach($_SERVER as $key => $val) {
//    $filecontent.="$key: $val \n";
//  }
//  $filecontent.="\n\nREQUEST\n";
//  foreach($_REQUEST as $key => $val) {
//    $filecontent.="$key: $val \n";
//  }
//  $filecontent.="\n\nJSON\n";
//  foreach($jsonArray as $key => $val) {
//    $filecontent.="$key: $val \n";
//  }
//  echo $filecontent;
?>
