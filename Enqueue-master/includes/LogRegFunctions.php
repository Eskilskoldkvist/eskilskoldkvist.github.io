<?php

function getRandomSalt()
{
  return sha1(random_int(0, 1000));
}

function hashPassword($password, $salt)
{
  return sha1($salt.$password);
}


function loginOwner($connection, $email, $password)
{


  $query= "SELECT password, salt FROM owner where email='$email'";

  $result = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($result)) {

    $dbpass = $row["password"];
    $dbsalt = $row["salt"];

    if (hashPassword($password, $dbsalt) == $dbpass) {
      return true;
    }
    else {
      return false;
    }

  }
  //mysqli_close($connection);


}
function existingData($connection, $email,$name){
$queryEmailnName= "SELECT email,name FROM owner";

$result = mysqli_query($connection, $queryEmailnName);

  while($row = mysqli_fetch_assoc($result))
  {
    if ($email==$row['email']) {
      return true;
    }
  }
  while($row = mysqli_fetch_assoc($result))
  {
    if ($name==$row['name']) {
      return true;
    }
  }
  return false;
}

function registerOwner($connection,$email,$password,$name)
{
if (existingData($connection, $email,$name))
    {

      echo "email exists";

    }
else
    {
    $salt = getRandomSalt();
    $hash_password = hashPassword($password,$salt);

    $query="INSERT INTO owner(email,name,password,salt) VALUES ('$email','$name','$hash_password','$salt') ";

    $connection->query($query);
    echo json_encode("null");


    }
}

function getOwnerID($connection, $email)
{

    $query= "SELECT ownerID FROM owner where email='$email'";

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)) {
        return $row["ownerID"];
    }

    //mysqli_close($connection);


}


/*
Funktioner kopplade till köare

*/
// Kontrollerar om det givna telefonnummret finns i databasen. Dvs om personen i fråga redan står i en kö.
function qerDbExists($connection, $phone)
{


  $query = "SELECT COUNT(phonenumber) as 'count' FROM user WHERE phonenumber = '$phone'";
  $result = mysqli_query($connection, $query);

  $row = mysqli_fetch_assoc($result);

  if ($row["count"] == 1) {

    return true;
  }
  else false;

  //Stänger anslutningen till databasen.
  //mysqli_close($connection);

}

function qerSessionExists($phone, $userID)
{
  session_start();
  if (isset($_SESSION["phone"]) || isset($_SESSION["userID"])) {
    return true;

  }
  else return false;
}


function getUserID($connection, $phone)
{

    $query= "SELECT userID FROM user where phonenumber='$phone'";

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)) {
        return $row["userID"];
    }

    //mysqli_close($connection);


}

// Returnerar en array med alla kolumnet för en user.
// TODO: Exception om $result är null.
function getUser($connection, $userID)
{
  $query= "SELECT * FROM user where userID='$userID'";

  $result = $connection->query($query);

  return mysqli_fetch_assoc($result);


  //mysqli_close($connection);
}

function userExists($connection, $userID)
{
  $query = "SELECT COUNT(userID) as 'count' FROM user WHERE userID = '$userID'";
  $result = mysqli_query($connection, $query);

  $row = mysqli_fetch_assoc($result);

  if ($row["count"] == 1) {

    return true;
  }
  else false;

}

function registerUser($connection, $phone, $queueID, $email, $name)
{

  $query = "INSERT INTO user (queueID, name, email, phonenumber ) VALUES ('$queueID', '$name', '$email', '$phone')";


  if (mysqli_query($connection, $query)) {
    return true;
  }
  else {
    echo "Failed to insert".mysqli_error($connection);
    return false;

  }

  //Stänger anslutningen till databasen.
  //mysqli_close($connection);


}

function queueExists($connection, $queueID)
{


    $query = "SELECT COUNT(queueID) as 'count' FROM queue WHERE queueID = '$queueID'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo 'MySQL Error: ' . mysqli_error($connection);
        exit;
    }

    $row = mysqli_fetch_assoc($result);



    if ($row["count"] == 1) {

      return true;
    }
    else return false;

    //Stänger anslutningen till databasen.

    //mysqli_close($connection);


}


function isOwnerLoggedIn()
{
  session_start();
  if (isset($_SESSION["ownerID"]) && isset($_SESSION["email"])) {

  }
  else {

    header("Location: login.php");
  }
}

function isOwnerToQueue($connection, $queueUID, $ownerID)
{
  $result = mysqli_query($connection, "SELECT * FROM queue WHERE queue.queueUID = '$queueUID' AND queue.ownerID = '$ownerID' LIMIT 1");

  if (mysqli_num_rows($result) > 0) {
    //echo "true";

  }
  else {
    //echo "false";
    header("Location: /enqueue/dashboard/login.php");

  }
}



 ?>
