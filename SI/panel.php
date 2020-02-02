<?php
    session_start();
    include 'conexion.php';

    if(isset($_SESSION['email'])) {
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    $total = 100;
    $email = $_SESSION['email'];
    $resultado = $conexion->query("SELECT etiquetas FROM Alumnos WHERE email='$email'");
    $row = mysqli_fetch_array($resultado);
    $actual = $row['etiquetas'];
    $prom = ($actual/$total)*100;
    $prom2 = 100-$prom;
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <div class="h1">
        <?php echo "Bienvenido: ".$_SESSION['email']; ?>
        <nav>
			<a href="logout.php">Cerrar Sesión</a>
		</nav>
    </div>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<style type="text/css">
    ${demo.css}
	</style>
		<script type="text/javascript">
        $(function () {
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            
            title: {
                text: 'Avance Etiquetado'
            },
            subtitle: {<?php echo "text: 'Completado: ".$actual." - Total: ".$total."'"; ?>
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            
            series: [{  
                name: 'Perfiles',
                colorByPoint: true,
                data: [{
                    name: 'Completado',<?php echo "y: ".$prom; ?>
                }, {
                    name: 'Faltante',<?php echo "y: ".$prom2; ?>
                }]
            }]

        });
    });
</script>
</head>
<body>
<div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<link rel="stylesheet" href="style.css">
<div id="container" style="min-width: 310px; height: 435px; max-width: 600px; margin: 0 auto"></div>

<?php 
    if($actual != $total){  
        echo '<div style="text-align:center;margin-bottom: 34px">  <a href="etiquetado.php"><button>Continuar</button></a> </div>';
    }else{  
        echo '<div style="text-align:center;margin-bottom: 12px">  <a href="descarga_csv.php"><button>Descargar Archivo CSV</button></a> </div>';
        echo '<div style="text-align:center;margin-bottom: 34px">  <a href="descarga_zip.php"><button>Descargar Perfiles</button></a> </div>';
    }
?>


</div>
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