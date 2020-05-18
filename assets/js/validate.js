


function validateForm() {
  var passfield = (document.forms["loginForm"]["password"].value).trim();
  var emailfield = (document.forms["loginForm"]["email"].value).trim();
  var emailFromAt = emailfield.slice(emailfield.indexOf('@'));
  //alert("Email"+emailfield+" Pass"+passfield.length);
  if (emailfield.length==0){
    document.getElementById("alertmsg").innerHTML = "Du har inte angivit en email!";
    //alert("Email must be filled out");
    return false;
  }
  if(emailfield.indexOf('@') == -1) {
    document.getElementById("alertmsg").innerHTML = "Detta är inte en gilitg email!";

    //alert("Not a valid email");
    return false;
  }
  else if (emailFromAt.indexOf('.') == -1 ) {
    document.getElementById("alertmsg").innerHTML = "Detta är inte en gilitg email!";
    //alert("Not a valid email");
    return false;
  }
  if (passfield.length==0) {
    document.getElementById("alertmsg").innerHTML = "Du har inte angivit ett lösenord";

      //alert("Password must be filled out");
      return false;
  }
  else {
    return true;
  }

}

function validateFormReg() {
var namefield = (document.forms["regForm"]["name"].value).trim();
var passfield = (document.forms["regForm"]["password"].value).trim();
var passfield = (document.forms["regForm"]["passwordR"].value).trim();
var emailfield = (document.forms["regForm"]["email"].value).trim();
var emailFromAt = emailfield.slice(emailfield.indexOf('@'))
//alert("Email"+emailfield+" Pass"+passfield.length);
if (emailfield.length==0){
  document.getElementById("alertmsg").innerHTML = "Du har inte angivit en email!";


  //alert("Email must be filled out");
  return false;
}
if(emailfield.indexOf('@') == -1) {
  document.getElementById("alertmsg").innerHTML = "Detta är inte en gilitg email!";

  //alert("Not a valid email");
  return false;
}
else if (emailFromAt.indexOf('.') == -1 )  {
  document.getElementById("alertmsg").innerHTML = "Detta är inte en gilitg email!";

  //alert("Not a valid email");
  return false;
}
if (passfield.length==0) {
  document.getElementById("alertmsg").innerHTML = "Du har inte angivit ett lösenord!";

  //  alert("Password must be filled out");
    return false;
}
if (namefield.length==0) {
  document.getElementById("alertmsg").innerHTML = "Du har inte angivit ett namn!";

  //alert("Name field must be filled out");
  return false;

}
return true;

}


function validateFormJoin() {
  var firstName = (document.forms["detailsForm"]["first_name"].value).trim();
  var lastName = (document.forms["detailsForm"]["last_name"].value).trim();
  var email = (document.forms["detailsForm"]["email"].value).trim();
  var phone = (document.forms["detailsForm"]["phone"].value).trim();

  if (firstName.length==0) {
    document.getElementById("alertmsg").innerHTML = "Du har inte angivit ett namn!";

    //alert("Name field must be filled out");
    return false;
  }
  if (lastName.length==0) {
    document.getElementById("alertmsg").innerHTML = "Du har inte angivit ett namn!";

    //alert("Name field must be filled out");
    return false;
  }

  if (email.length==0){
    document.getElementById("alertmsg").innerHTML = "Du har inte angivit en email!";


    //alert("Email must be filled out");
    return false;
  }
  if(email.indexOf('@') == -1) {
    document.getElementById("alertmsg").innerHTML = "Detta är inte en gilitg email!";

    //alert("Not a valid email");
    return false;
  }
  else if (email.indexOf('.') == -1 )  {
    document.getElementById("alertmsg").innerHTML = "Detta är inte en gilitg email!";

    //alert("Not a valid email");
    return false;
  }
  if (phone.length==0) {
    document.getElementById("alertmsg").innerHTML = "Du har inte angivit ett telefonnummer!";

    //  alert("Password must be filled out");
      return false;
  }

  return true;




}
