<?php
    session_start();
?>

<html>
<head>
    <title>Login - Sistema de Etiquetado Online</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
        include 'conexion.php';
        if(isset($_POST['ingresar'])){
            $email = $_POST['email'];
            $psw = $_POST['psw'];

            $resultado = $conexion->query("SELECT * FROM Alumnos WHERE email='$email' AND psw='$psw'");

            if ($resultado->num_rows > 0){
                /*echo "Bienvenido " .$email;*/
                $row = mysqli_fetch_array($resultado);
                $_SESSION["email"] = $row['email'];

                /* liberar el conjunto de resultados */
                $resultado->close();

                /*echo 'Iniciando sesión para '.$_SESSION['email'].' <p>';*/
                if($email === 'Admin@unab.cl'){
                    echo '<script> window.location="admin.php"; </script>';                
                }
                else {
                    $t=time();
                    date_default_timezone_set('America/Santiago');
                    $time = date("Y-m-d H:i:s",$t);

                    $sql = "INSERT INTO LogTime (email,time_log) VALUES ('$email','$time')";
                
                    if ($conexion->query($sql) === TRUE) {
                    } else {
                        echo "Error: " . $sql . "<br>" . $conexion->error;
                    }
                
                    echo '<script> window.location="panel.php"; </script>';                  
                }
            } else{
                $resultado = $conexion->query("SELECT email FROM Alumnos WHERE email='$email'");
                if($resultado->num_rows > 0){
                    $resultado->close();
                    echo '<script> alert("Contraseña Incorrecta."); </script>';
                    echo '<script> window.location="index.php";</script>';
                }
                else{ 
                    echo '<script> alert("Email Incorrecto."); </script>';
                    echo '<script> window.location="index.php";</script>';
                }
            } 
        }
    ?>
</body>
</html>