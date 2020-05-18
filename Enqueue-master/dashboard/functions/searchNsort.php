<?php




if (isset($_GET["sort"])) {
  if ($_GET['sort'] == 'inQueue' || $_GET['sort'] == 'Completed') {
   $sortOn = mysqli_real_escape_string($connection, $_GET['sort']);
  }
  else {
    $sortOn = 'inQueue';
  }
}
else {
  $sortOn = 'inQueue';

}


  if (isset($_POST["search"])) {
    $search_on = mysqli_real_escape_string($connection, $_POST['search']);

    $connection->query("SET @placement = 0;");

    // Perform the query
    $all_sessions = $connection->query("SELECT * FROM (SELECT @placement:=@placement+1 AS placement, session.sessionID, session.customerFirstName, session.customerLastName, session.queueStartTime, queue.qname, queue.description
    FROM session
    JOIN queue ON queue.queueUID = session.queueUID
    WHERE session.queueUID = '$queueUID' AND session.sessionStatus= 'inQueue'
    ORDER BY queueStartTime ASC) AS allQers WHERE customerFirstName = '$search_on';");
  }
  else {
    $search_on="";
    $connection->query("SET @placement = 0;");

    // Perform the query
    $all_sessions = $connection->query("SELECT @placement:=@placement+1 AS placement, session.sessionID, session.customerFirstName, session.customerLastName, session.queueStartTime, queue.qname, queue.description
    FROM session
    JOIN queue ON queue.queueUID = session.queueUID
    WHERE session.queueUID = '$queueUID'
    AND session.sessionStatus = '$sortOn'
    ORDER BY queueStartTime ASC;");
  }

 ?>
