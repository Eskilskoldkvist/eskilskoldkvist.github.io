<!doctype html>
<html lang="sv">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../favicon.ico">
    <link rel="stylesheet" href="../assets/css/ownerLogin.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/js/validate.js"></script>
    <script src="../assets/js/requestFunctions.js"></script>
    <title>Registera nytt konto | Enqueue</title>
  </head>

<body>
<div class="registerForm">

  <div class="registerFormInfo">

        <p class="registerFormInfoText">
     </p>
     <img class="infoimage" src="../assets/img/leaving-queue.png" width="50%">
     <p> Revolutionera din kö idag.</br>Helt gratis med Enqueue. </p>

     <a href="../index.php"> <img class="infoimage2" src="../assets/img/hem.png">
     </a>
  </div>


    <div class="registerFormBody">


    <div class="registerFormHeader">
      <a href="../index.php">  <img class="infologo" src="../assets/img/enqueueLogo.png" width="20%">
      </a>
      <div class="btn-group">
          <input type="button" class="active" value="Registrera"
           onclick="window.location.href='register.php'" />
          <input type="button" value="Logga in"
           onclick="window.location.href='login.php'" />
      </div>
    </div>

    <div align="center"   class="registerFormDiv">

      <div align="center"   class="registerFormDiv">

      <form   name="regForm"  id="reg"   method="POST" >
      <br>      <input class="registerFormInput" placeholder="Ditt namn" type="text" name="name"
                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ditt namn'">

      <br>      <input class="registerFormInput" id="em" placeholder="Email"type="text" name="email"
                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">

      <br>      <input class="registerFormInput" placeholder="Lösenord" type="password" name="password"
                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Lösenord'">

                <input class="registerFormInput" placeholder="Upprepa lösenord" type="password" name="passwordR"
                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Upprepa lösenord'">

        <br>    <input type="button" id="subbtn" value="Registrera konto" class="registerbtn" onclick="register(validateFormReg())">

    </form>

        <div class="alertDiv">
        <span id="alertmsg"></span>
      </div>


    </div>
  </div>
</div>



</body>
