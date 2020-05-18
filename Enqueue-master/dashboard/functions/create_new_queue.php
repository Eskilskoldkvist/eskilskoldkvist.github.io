<?php
session_start();

include '../../includes/dbConnect.php';

$qname = $_POST["qname"];
$desc = $_POST["description"];
$ownerID= $_SESSION["ownerID"];

$random_int = mt_rand(10000,99999);

function randomID() {
  $length=5;
	$str = "";
	$characters = array_merge(range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
$queueUID = randomID();

$query = "INSERT INTO queue(queueUID, ownerID, qname, description) VALUES('$queueUID', '$ownerID', '$qname', '$desc')";

$result = mysqli_query($connection, $query);

if ($result) {
  //echo "SEGER!";
  header("Location: ../index.php");
  $_SESSION["notice"] = "Ny kö skapad";
  $_SESSION["notice_type"] = "success";
}
else {
  echo "Error";
  header("Location: ../index.php");
  $_SESSION["notice"] = "Fel, kön kunde inte skapas";
  $_SESSION["notice_type"] = "error";
}

?>
