<?php
    session_start();
    include 'conexion.php';

    if(isset($_SESSION['email'])) {

        $email = $_SESSION['email'];
        $name = 'Perfiles-('.$email.').zip';
        $folder = 'Perfiles-('.$email.')/';
        $path = './Data/perfiles/'.$folder.$name;
        $type = 'application/zip';
?>

<!DOCTYPE html>
<html >
<head>
    <title>Descarga</title>
    <div class="h1">
        <?php echo "Bienvenido: ".$_SESSION['email']; ?>
        <nav>
		    <a href="logout.php">Cerrar Sesión</a>
	    </nav>
    </div>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 style="text-align:center;margin-bottom: 100px;margin-top: 100px;">El archivo ZIP con los perfiles de usuario se descargará automaticamente.</h2>
<div style="text-align:center;margin-bottom: 100px">  <a href="panel.php"><button>Volver</button></a> </div>

<div class="footer" style="bottom:0;position:fixed">
© 2017 Jean Contreras - Sistemas Inteligentes.
</div>
</body>
</html>
<?php 
        echo '<script> window.location="download.php?path='.$path.'&name='.$name.'&type='.$type.'";</script>';
    }else{
	    echo '<script> window.location="index.php"; </script>';
    }
?>
