<?php

include 'dbConnect.php';
session_start();

function create_session($connection, $queueUID, $firstName, $lastName, $email, $phone){

  // Generate random unique UDID for the session.
  $uniqueID = uniqid(rand());

  // Set session status and notification status.
  $status = "inQueue";
  $notificationStatus = "inQueue";

  // Create query.
  $query = "INSERT INTO session (sessionID, sessionStatus, sessionNotification, queueUID, customerFirstName, customerLastName, customerEmail, customerPhone, queueEndTime, sessionStartTime, sessionEndTime)
          VALUES ('$uniqueID', '$status', '$notificationStatus', '$queueUID','$firstName', '$lastName', '$email', '$phone', NULL, NULL, NULL)";

  // Create the session.
  if (mysqli_query($connection, $query)) {
    // The session was created, send the user the link to the queue page
    // via text message using 46Elks.
    $msg = "Hej ".$firstName.", du är nu placerad i kö. Öppna följande länk i din webläsare för att se och administrera din plats i kön: http://enqueue.se/queue/index.php?sid=".$uniqueID;
    $sms = array(
      "from" => "Enqueue",
      "to" => $phone,
      "message" => $msg,
    );
     sendSMS($sms);
    // Redirect the user to the show queue page.
    header("Location: ../index.php?sid=".$uniqueID);
    $_SESSION["notice"] = "Du är nu ställd i kö";
    $_SESSION["notice_type"] = "success";
  }
  else {
    echo "COULD NOT ADD TO QUEUE: Could not create session. Error: <br>".mysqli_error($connection);
  }
}

function get_session($connection, $sessionID){

  // Get the QueueID from the queue the session is in.
  $queueUID = $connection->query("SELECT queueUID FROM session WHERE sessionID = '$sessionID' LIMIT 1")->fetch_assoc()["queueUID"];

  // Firstly check if the session has the status of inSession completed
  $completed_insession_session = $connection->query("SELECT session.sessionStatus, session.sessionID, session.customerFirstName, session.customerLastName, session.queueStartTime, queue.qname, queue.description
  FROM session
  JOIN queue ON queue.queueUID = session.queueUID
  WHERE session.sessionID = '$sessionID'
  AND (session.sessionStatus = 'inSession' OR session.sessionStatus = 'completed')
  LIMIT 1;")->fetch_assoc();

  if (is_null($completed_insession_session)) {
    // If no session with that status was found
    // the session is probably inQueue. So find the
    // session and session placement for the session.
    // Set local variable for SQL query
    $connection->query("SET @placement = 0;");

    // Perform the query
    $session = $connection->query("SELECT * FROM (SELECT @placement:=@placement+1 AS placement, session.sessionStatus, session.sessionID, session.customerFirstName, session.customerLastName, session.queueStartTime, queue.qname, queue.description
    FROM session
    JOIN queue ON queue.queueUID = session.queueUID
    WHERE session.queueUID = '$queueUID'
    AND session.sessionStatus = 'inQueue'
    ORDER BY queueStartTime ASC) AS allQers WHERE sessionID = '$sessionID' LIMIT 1;")->fetch_assoc();

    // Return the session
    return $session;
  }
  else {
    // Return the session
    return $completed_insession_session;
  };

  var_dump($completed_insession_session);

};

function sendSMS ($sms) {
  $username = "u21ebd1a8f26b352e54b5f7f0a207db36";
  $password = "3F6B26F1BDFE86A987919743379C2ACE";
  $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header'  => 'Authorization: Basic '.
                   base64_encode($username.':'.$password). "\r\n".
                   "Content-type: application/x-www-form-urlencoded\r\n",
      'content' => http_build_query($sms),
      'timeout' => 10
  )));
  $response = file_get_contents("https://api.46elks.com/a1/SMS",
    false, $context);

  if (!strstr($http_response_header[0],"200 OK"))
    return $http_response_header[0];
  return $response;
}

?>
