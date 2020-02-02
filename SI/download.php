<?php
    session_start();
    include 'conexion.php';
    
    if(isset($_SESSION['email'])) {

        $path=($_GET['path']);
        $name=($_GET['name']);
        $type=($_GET['type']);

        if(!$path){ // file does not exist
            die('file not found');
        } else {
            /*header("Content-disposition: attachment; filename='.$name.'");
            header("Content-type: '.$type.'");
            readfile($path);*/
	
            if (headers_sent()) {
                echo 'HTTP header already sent';
            } else {
                if (!is_file($path)) {
                    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
                } else if (!is_readable($path)) {
                    header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
                } else {
                    header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
                    header("Content-Type: ".$type);
                    header("Content-Transfer-Encoding: Binary");
                    header("Content-Length: ".filesize($path));
                    header("Content-Disposition: attachment; filename=\"".$name."\"");
                    readfile($path);
                    exit;
                }
            }
        }
    }
    else{
        header('Location: index.php');
    }
?>