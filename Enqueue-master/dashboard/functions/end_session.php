<?php
ob_start();

include '../../includes/dbConnect.php';
include '../../includes/LogRegFunctions.php';
isOwnerLoggedIn();

$queueUID = $_POST['queueUID'];
$sessionID = $_POST['sessionID'];

$sql = "UPDATE session SET sessionStatus='completed', sessionEndTime=Now() WHERE sessionID='$sessionID'";

if ($connection->query($sql)) {
  header('Location: ../details.php?quid='.$queueUID);
  $_SESSION["notice"] = "Sessionen stängd";
  $_SESSION["notice_type"] = "success";
  exit;
} else {
    header('Location: ../details.php?quid='.$queueUID);
    $_SESSION["notice"] = "Fel, Kunde inte stänga session: ".$connection->error;
    $_SESSION["notice_type"] = "error";
}

?>
