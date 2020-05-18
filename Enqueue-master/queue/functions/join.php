<?php
ob_start();
session_start();

include '../../includes/dbConnect.php';
include '../../includes/validate.php';
include '../../includes/session_helper.php';

// The post data
$firstName = mysqli_real_escape_string($connection, $_POST["first_name"]);
$lastName = mysqli_real_escape_string($connection,$_POST["last_name"]);
$email = mysqli_real_escape_string($connection,$_POST["email"]);
$phone = mysqli_real_escape_string($connection,$_POST["phone"]);
$reg_to_queue = mysqli_real_escape_string($connection,$_POST["queue_uid"]);

// Get the queue
$result = $connection->query("SELECT queue.queueUID FROM queue WHERE queue.queueUID = '$reg_to_queue' LIMIT 1");

if (validateDetailsForm($firstName, $lastName, $email, $phone, $reg_to_queue)) {
  if ($result) {
    $queue = $result->fetch_assoc();
    $queueUID = $queue['queueUID'];


    // The queue that the user is trying to register to exists
    // so add the users session to the queue.
    create_session($connection, $queueUID, $firstName, $lastName, $email, $phone);
  }
  else{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
  }
}
else {
  header("Location: ../details.php");
}

?>
