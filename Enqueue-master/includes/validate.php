<?php



//Validerar email-fältet. Om fältet är tomt eller inte innehåller ett @ följt av en '.' så returnerar funktionen false.

function validateEmail($email)
{
  $email=trim($email);
  $emailFromAt = substr($email,(strpos($email,'@')-1));
  if (strlen($email)==0) {
    return false;

  }
  elseif(strpos($emailFromAt, '.')>-1){
    return true;
  }
    return false;
}


//Validerar password-fältet. Om fältet är tomt returnerar funktionen false annars true.
function validatePass($passfield){
  $passfield=trim($passfield);

  if (strlen($passfield)==0) {
    return false;

  }
  else return true;
}

//Validerar hela formen. Om inputen inte möter kraven på alla så skickas användaren till index.php
function validateLogin($email, $password)
{
  if (validateEmail($email) && validatePass($password)) {
    return true;
  }
  else return false; //header("Location: http://localhost/lindstedthenrik/index.php");
}

function validatePhone($phonenumber)
{
  if (strlen(trim($phonenumber))==0) {
    return false;
  }
  else return true;

}
function validateName($name)
{
  if (strlen(trim($name))==0) {
    return false;
  }
  else return true;

}

function validateReg($name, $email,$password, $passwordRepeat){
  if (validateName($name) && validateEmail($email) && validatePass($password) && validatePass($passwordRepeat) && $passwordRepeat==$password ) {
    return true;
  }
  else return false;
}

function validateDetailsForm($firstName, $lastName, $email, $phone, $reg_to_queue)
{
  if (validateName($firstName) && validateName($lastName) && validateEmail($email) && validatePhone($phone)) {
    return true;
  }
  else return false;

}







 ?>
