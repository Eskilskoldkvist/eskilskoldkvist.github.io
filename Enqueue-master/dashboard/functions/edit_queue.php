<?php


session_start();

include '../../includes/dbConnect.php';

$qname = $_POST["qname"];
$desc = $_POST["description"];
$queueUID=$_POST["queueUID"];
$ownerID= $_SESSION["ownerID"];


$query = "UPDATE queue SET qname='$qname', description='$desc' WHERE queueUID = '$queueUID'";

$result = mysqli_query($connection, $query);

if ($result) {
  //echo "SEGER!";
  header("Location: ../index.php");
  $_SESSION["notice"] = "Kön uppdaterad";
  $_SESSION["notice_type"] = "success";
}
else {
//  echo "Error";
  header("Location: ../index.php?notice=Fel, kön kunde inte uppdateras&notice_type=error");
  $_SESSION["notice"] = "Fel, kön kunde inte uppdateras";
  $_SESSION["notice_type"] = "error";
}









 ?>
