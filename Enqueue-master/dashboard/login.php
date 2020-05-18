<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../favicon.ico.png">
    <link rel="stylesheet" href="../assets/css/ownerLogin.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <script src="../assets/js/validate.js"></script>
    <title>Logga in | Enqueue</title>
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
      <a href="../index.php">  <img class="infologo" src="../assets/img/enqueueLogo.png">
      </a>
      <div class="btn-group">
          <input type="button" value="Registrera"
           onclick="window.location.href='register.php'" />
          <input type="button" class="active" value="Logga in"
           onclick="window.location.href='login.php'" />
      </div>
    </div>

    <div align="center"   class="registerFormDiv">
          <form name="loginForm" action="functions/login.php" method="POST" onsubmit="return validateForm()">
          <br>      <input class="registerFormInput" placeholder="Email"type="text" name="email"
                      onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" />

          <br>      <input class="registerFormInput" placeholder="Lösenord"type="password" name="password"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Lösenord'">
          <br>      <button type="submit" class="registerbtn">Logga in</button>

        </form>

        <div class="alertDiv">
        <span id="alertmsg"></span>
      </div>
    </div>
  </div>
</div>
</body>
</html>
