<?php
    session_start();
    include 'conexion.php';

    if(isset($_SESSION['email'])) {

        $email = $_SESSION['email'];
        $name = 'Etiquetas.csv';
        $path = './Data/admin/'.$name;
        $type = 'text/csv';

        $output = fopen($path, 'w');

        // output the column headings
        fputcsv($output, array('email', 'id_perfil', 'etiqueta', 'time_tag'),";");

        // fetch the data
        $result=$conexion->query("SELECT * FROM TagTime ORDER BY email, time_tag ASC");

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $row_text = array($row["email"], $row["id_perfil"], $row["etiqueta"], $row["time_tag"]);
                fputcsv($output, $row_text,";");
            }
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
            echo '<script> window.location="download.php?path='.$path.'&name='.$name.'&type='.$type.'";</script>';
        } 
        else {
            echo '<script> alert("Ningún alumno a ingresado"); </script>';
            echo '<script> window.location="admin.php"; </script>';
        }
    }else{
	    echo '<script> window.location="index.php"; </script>';
    }
?>
