

function register(isvalidated) {
  console.log("Register function");
  if (isvalidated) {
    $.ajax({
      type:'POST',
      url: 'functions/register.php',
      dataType: 'json',
      data: $('#reg').serialize(),
      success:function(data) {

        //console.log("Register success");

        window.location = "login.php";
        return true;
      },
      error: function(jqXHR, textStatus, errorThrown){
          document.getElementById("alertmsg").innerHTML = "Det finns redan en användare registrerad med den emailadressen!";
          document.getElementById("reg").reset();

          //console.log("Register fail");

          return false;
      }
    });
    return false;
  }
  else {
    return false;
  }

}
