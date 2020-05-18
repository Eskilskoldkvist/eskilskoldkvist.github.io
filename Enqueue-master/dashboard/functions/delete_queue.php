<?php


include '../../includes/LogRegFunctions.php';
include '../../includes/dbConnect.php';
isOwnerLoggedIn();

$queueUID = $_GET["quid"];


  $queryQueue = "DELETE FROM queue WHERE queueUID='$queueUID'";
  $querySession = "DELETE FROM session WHERE queueUID='$queueUID'";


  // Set autocommit to off
  mysqli_autocommit($connection,FALSE);
  // Insert some values
  mysqli_query($connection, $queryQueue);
  mysqli_query($connection, $querySession);

  // Commit transaction
  mysqli_commit($connection);

  // Close connection
//  mysqli_close($connection);

header("Location: ../index.php?");
$_SESSION["notice"] = "Kön har blivit raderad";
$_SESSION["notice_type"] = "success";





 ?>
