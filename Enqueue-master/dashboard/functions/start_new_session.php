<?php
include '../../includes/dbConnect.php';

//$queueID = $_POST['queueID'];

include '../../includes/LogRegFunctions.php';
isOwnerLoggedIn();
$queueUID = $_POST['queueUID'];

// Set local variable for SQL query
$connection->query("SET @placement = 0;");
// Find the session that has waited the longest in queue
// aka the session with placement 1.
$first_in_queue_session = $connection->query("SELECT * FROM (SELECT @placement:=@placement+1 AS placement, session.sessionID, session.customerFirstName, session.customerLastName, session.queueStartTime, queue.qname, queue.description
FROM session
JOIN queue ON queue.queueUID = session.queueUID
WHERE session.queueUID = '$queueUID' AND session.sessionStatus = 'inQueue'
ORDER BY queueStartTime ASC) AS allqers WHERE placement = '1' LIMIT 1")->fetch_assoc();

if ($first_in_queue_session) {
  // The session that is first in line is fetched successfully.
  // Update the session status and queue end times, session start time.
  $sessionID = $first_in_queue_session['sessionID'];
  $sql = "UPDATE session SET sessionStatus='inSession', queueEndTime=Now(), sessionStartTime=Now() WHERE sessionID='$sessionID'";
  if ($connection->query($sql) === TRUE) {
    header('Location: ../details.php?quid='.$queueUID);
    $_SESSION["notice"] = "Ny session startad";
    exit;
  } else {
    header('Location: ../details.php?quid='.$queueUID);
    $_SESSION["notice"] = "Kunde inte starta ny session:'.$connection->error";
    $_SESSION["notice_type"] = "error";
    exit;
  }
}
else {
  // There are no sessions left in queue.
  header('Location: ../details.php?quid='.$queueUID);
  $_SESSION["notice"] = "Kan inte starta ny session: Inga kunder finns i kön.";
  $_SESSION["notice_type"] = "error";
  exit;
}
?>
