<?php
    session_start();
    include 'conexion.php';

    if(isset($_SESSION['email'])) {
?>

<!DOCTYPE html>
<html >
<head>
    <title>Administrador</title>
    <div class="h1">
        <?php echo "Bienvenido: ".$_SESSION['email']; ?>
        <nav>
		    <a href="logout.php">Cerrar Sesión</a>
	    </nav>
    </div>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2 style="text-align:center;margin-bottom: 100px;margin-top: 100px;">Seleccione el tipo de archivo a descargar:</h2>
<div style="text-align:center;margin-bottom: 100px"><a href="login_csv_admin.php"><button>Descargar CSV Login</button></a> </div>
<div style="text-align:center;margin-bottom: 100px"><a href="etiqueta_csv_admin.php"><button>Descargar CSV Etiquetado</button></a> </div>

<div class="footer" style="bottom:0;position:fixed">
© 2017 Jean Contreras - Sistemas Inteligentes.
</div>
</body>
</html>
<?php
    }else{
	    echo '<script> window.location="index.php"; </script>';
    }
?>
