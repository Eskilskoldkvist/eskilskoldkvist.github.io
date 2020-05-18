<?php
ob_start();
session_start();
include '../../includes/dbConnect.php';
include '../../includes/validate.php';
include '../../includes/LogRegFunctions.php';
include '../admin/admin.php';


$email = mysqli_real_escape_string($connection, $_POST["email"]);
$password = mysqli_real_escape_string($connection, $_POST["password"]);

$admin = new Admin();

if (validateLogin($email, $password) && $admin->isAdmin($email, $password)) {
  $_SESSION["admin"]=$email;
  header("Location:  ../admin/godview.php");
  exit;
}

if(validateLogin($email, $password) && loginOwner($connection, $email, $password)){
  //session_start();
  $_SESSION["ownerID"] = getOwnerID($connection, $email);
  $_SESSION["email"] = $email;
  header("Location: ../index.php");
}
else {
  echo "Failed to login.";
  header("Location: ../login.php");
}

?>
