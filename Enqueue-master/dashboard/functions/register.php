<?php
include '../../includes/dbConnect.php';
include '../../includes/LogRegFunctions.php';
include '../../includes/validate.php';

$name =mysqli_real_escape_string($connection,$_POST["name"]);
$email =mysqli_real_escape_string($connection,$_POST["email"]);
$password =mysqli_real_escape_string($connection, $_POST["password"]);
$passwordRepeat =mysqli_real_escape_string($connection, $_POST["passwordR"]);


if(validateReg($name, $email, $password, $passwordRepeat)){
  // TODO: registerOwner bör returnera true eller false.
  registerOwner($connection, $email, $password, $name);
  //header("Location: ownerLogin.php");

}

else {
  echo "Fail to validate";
  //header("Location: http://localhost/enqueue/owner/ownerRegister.php");


}


 ?>
