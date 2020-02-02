<?php
    session_start();
    include 'conexion.php';
    if(isset($_SESSION['email'])) {

    if(isset($_POST['submit'])){//to run PHP script on submit
        $id_perfil = $_POST['Id_perfil'];
        $clases = $_POST['Edad']." # ".$_POST['Etnia']." # ".$_POST['Estado_Civil']." # ".$_POST['Clase_Social']." # ".$_POST['Religion']." # ".$_POST['General_Lisfestyle']." # ".$_POST['Partido_Politico'];
        if(!empty($_POST['check_list'])){
            // Loop to store and display values of individual checked checkbox.
            
            foreach($_POST['check_list'] as $selected){
                /*echo $selected."</br>";*/
                $clases = $clases." # ".$selected;
            }
        }

        $email = $_SESSION['email'];
        $conexion->query("UPDATE Alumnos SET etiquetas=etiquetas+1 WHERE email='$email'");
        $conexion->query("UPDATE Perfiles SET etiquetado=1 WHERE email='$email' AND id_perfil='$id_perfil'");

        $t=time();
        date_default_timezone_set('America/Santiago');
        $time = date("Y-m-d H:i:s",$t);
        $sql = "INSERT INTO TagTime (email,id_perfil,etiqueta,time_tag) VALUES ('$email','$id_perfil','$clases','$time')";

        if ($conexion->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }

        echo '<script> window.location="etiquetado.php";</script>';
    }
    }else{
	    echo '<script> window.location="index.php"; </script>';
    }
?>