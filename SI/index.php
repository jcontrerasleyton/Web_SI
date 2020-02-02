<?php
    session_start();
    include 'conexion.php';
    if(isset($_SESSION['email'])){
        echo '<script> window.location="panel.php"; </script>';
    }
?>

<!DOCTYPE html>
<html >
<head>
  <title>Login - Sistema de Etiquetado Online</title>
  <div class="h1" style="text-align: center; text-transform: uppercase;">Sistema de Etiquetado Online</div>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  
</head>

<body>
  <div class="container">

  <div id="login-form">

    <h3>Login</h3>

    <fieldset>

      <form method="post" action="validar.php">

        <input type="email" name="email" autocomplete="on" placeholder="Email" required onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' "><br>
        <input type="password" name="psw" placeholder="Contraseña" required onFocus="if(this.value=='Password')this.value='' "><br>
        <input type="submit" name="ingresar" value="Ingresar" required><br>

      </form>

    </fieldset>

  </div> <!-- end login-form -->

</div>
<div class="footer" style="bottom:0;position:fixed">
© 2017 Jean Contreras - Sistemas Inteligentes.
</div>
 
</body>

</html>
