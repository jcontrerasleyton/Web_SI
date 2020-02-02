<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Sistemas_Inteligentes";

    $conexion = new mysqli($servername, $username, $password, $dbname) or die("No se pudo conectar al servidor");
    // Check connection
    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    } 
?>