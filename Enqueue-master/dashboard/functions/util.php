<?php



function getQueueData($connection, $queueUID)
{

  $query = "SELECT * FROM queue q WHERE q.queueUID='$queueUID'";

  $result = mysqli_query($connection, $query)->fetch_assoc();

  return $result;

}





 ?>
