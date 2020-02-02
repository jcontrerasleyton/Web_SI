<?php
    session_start();
    include 'conexion.php';

    if(isset($_SESSION['email'])) {

        $email = $_SESSION['email'];
        $name = 'Etiquetas-('.$email.').csv';
        $path = './Data/etiquetas/'.$name;
        $type = 'text/csv';

        $output = fopen($path, 'w');

        // output the column headings
        fputcsv($output, array('id_perfil', 'etiqueta'),";");

        // fetch the data
        $result=$conexion->query("SELECT id_perfil,etiqueta FROM TagTime WHERE email='$email'");

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $row_text = array($row["id_perfil"], $row["etiqueta"]);
                fputcsv($output, $row_text,";");
            }
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
<h2 style="text-align:center;margin-bottom: 100px;margin-top: 100px;">El archivo CSV se descargará automaticamente.</h2>
<div style="text-align:center;margin-bottom: 100px">  <a href="panel.php"><button>Volver</button></a> </div>

<div class="footer" style="bottom:0;position:fixed">
© 2017 Jean Contreras - Sistemas Inteligentes.
</div>
</body>
</html>


<?php
            echo '<script> window.location="download.php?path='.$path.'&name='.$name.'&type='.$type.'";</script>';
        } 
        else {
            echo '<script> alert("Perfiles no etiquetados"); </script>';
            echo '<script> window.location="panel.php"; </script>';
        }
    }else{
	    echo '<script> window.location="index.php"; </script>';
    }
?>
