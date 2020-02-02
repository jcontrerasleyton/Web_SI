<?php
    session_start();
    include 'conexion.php';

    if(isset($_SESSION['email'])) {
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="css/style.css">
    <div class="h1">
        <?php echo "Bienvenido: ".$_SESSION['email']; ?>
        <h3 class="alignright" style="font-size: 8px;"><a href="panel.php"><button>Volver a Inicio</button></a></h3> 
        <nav><a href="logout.php">Cerrar Sesión</a></nav>   
    </div>
    <?php
    $id_perfil = "";
    $total = 100;
    $email = $_SESSION['email'];
    $resultado = $conexion->query("SELECT etiquetas FROM Alumnos WHERE email='$email'");
    $row = mysqli_fetch_array($resultado);
    $actual = $row['etiquetas']+1;
    if($actual>$total){
        echo '<script> window.location="panel.php";</script>';
    }else{
        echo '<title>Eiquetar '.$actual.' de '.$total.'</title>';
    }
    $resultado = $conexion->query("SELECT id_perfil FROM Perfiles WHERE email='$email' AND etiquetado=0");
    if ($resultado->num_rows > 0) {
        // output data of each row
        while($row = $resultado->fetch_assoc()) {
            $id_perfil = $row["id_perfil"];
            break;
        }
    }
    error_reporting(0);
    $path = './Data/perfiles/Perfiles-('.$email.')/'.$id_perfil;
    $linea = "";$preguntas="";$respuestas="";$image="";$aboutme="";$nickname="";
    $anterior ="";$anterior2="";$br = '<br><br>-';
    $hr= '<hr style="border: 0;height: 0;border-top: 1px solid rgba(0, 0, 0, 0.1);border-bottom: 1px solid rgba(255, 255, 255, 0.3);">';
    $fp = fopen($path, "r");
    while(!feof($fp)) {
        $linea = trim(fgetss($fp),"\n");
        $tokens = explode("	",$linea);
        if($tokens[0] === 'ANSWER'){
            
            if($anterior === $tokens[1]){
 	            $respuestas = $respuestas.$br.$tokens[2];
            }
            else{
	            $anterior = $tokens[1];
	            $respuestas = $respuestas.$hr.'<b>'.$tokens[1].'</b>';
	            $respuestas = $respuestas.$br.$tokens[2];
            }
        }
        if($tokens[0] === 'QUESTION'){
            
            if($anterior2 === $tokens[1]){
 	            $preguntas = $preguntas.$br.$tokens[2];
            }
            else{
	            $anterior2 = $tokens[1];
	            $preguntas = $preguntas.$hr.'<b>'.$tokens[1].'</b>';
	            $preguntas = $preguntas.$br.$tokens[2];
            }
        }
        
        if($tokens[0] === 'IMAGE'){
            $image = $tokens[1];
        }
        if($tokens[0] === 'NICKNAME'){
            $nickname = $tokens[1];
        }
        if($tokens[0] === 'ABOUTME'){
            $aboutme = $tokens[1];
        }
    }


        /*$linea = $linea. fgets($fp). "<br />";*/
    fclose($fp);
    ?>
</script>
</head>
<body>

<div>
<!--<div class="footer">
© 2017 Jean Contreras - Sistemas Inteligentes.
</div>-->
<?php echo '<hr><h3 style="text-align:center">Perfil '.$actual.' de '.$total.'</h3><hr>';?>
<div id="wrapper" style="margin: 0 auto">
    <section id="content">
        <div class="scroll2">
        <div class="pic" style="text-align:center; margin-top:7px">
	        <a><img src=<?php echo $image ?> width="60" height="60" border="1"/></a>
	        <div class="data">
	            <h3><?php echo $nickname ?></h3>
                <h3 style="font-size: 75%;"><?php echo 'ID: '.$id_perfil; ?></h3>
            </div>
        </div>
        <h4>About Me:</h4>
	    <p> <?php echo $aboutme ?> </p>
        </div>
    </section>

    <section id="middle">
        <h3 style="text-align:center">Preguntas</h3><hr>
        <div style="height: 40%;">
            <div class="scroll_text">
            <p>
                <?php echo $preguntas ?>
            </p>
            </div> 
        </div>   
        <h3 style="text-align:center">Respuestas</h3><hr>    
        <div style="height: 40%;">
            <div class="scroll_text">
            <p><?php echo $respuestas ?> </p>
            </div> 
        </div>
    </section>
    <section id="sidebar">
        <h3 style="text-align:center"><b>Elige Etiquetas</b></h3><hr>
        <form action="actualizar.php" method="post">
            <div class="scroll" style="margin-bottom: 6px">
            <h3 style="font-size: 100%;">Edad:</h3>
            <select name="Edad" style="max-width:100%;" required>
                <option value="">Seleccionar</option>
                <option value="12-17 years old">12-17 years old</option>
                <option value="18-24 years old">18-24 years old</option>
                <option value="25-34 years old">25-34 years old</option>
                <option value="35-44 years old">35-44 years old</option>
                <option value="45-54 years old">45-54 years old</option>
                <option value="55-64 years old">55-64 years old</option>
                <option value="65-74 years old">65-74 years old</option>
                <option value="75 years or older">75 years or older</option>
                <option value="No identificable">No identificable</option>
            </select><p></p>
            <h3 style="font-size: 100%;">Etnia:</h3>
            <select name="Etnia" style="max-width:100%;" required>
                <option value="">Seleccionar</option>
                <option value="White">White</option>
                <option value="Hispanic or Latino">Hispanic or Latino</option>
                <option value="Black or African American">Black or African American</option>
                <option value="Native American or American Indian">Native American or American Indian</option>
                <option value="Asian / Pacific Islander">Asian / Pacific Islander</option>
                <option value="Other">Other</option>
                <option value="No identificable">No identificable</option>
            </select><p></p>
            <h3 style="font-size: 100%;">Estado Civil:</h3>
            <select name="Estado_Civil" style="max-width:100%;" required>
                <option value="">Seleccionar</option>
                <option value="Single, never married">Single, never married</option>
                <option value="Married or domestic partnership">Married or domestic partnership</option>
                <option value="Widowed">Widowed</option>
                <option value="Divorced">Divorced</option>
                <option value="Separated">Separated</option>
                <option value="No identificable">No identificable</option>
            </select><p></p>
            <h3 style="font-size: 100%;">Clase Social:</h3>
            <select name="Clase_Social" style="max-width:100%;" required>
                <option value="">Seleccionar</option>
                <option value="TOP-UPPERS">TOP-UPPERS</option>
                <option value="BOTTOM-UPPERS">BOTTOM-UPPERS</option>
                <option value="TOP-MIDDLES">TOP-MIDDLES</option>
                <option value="BOTTLE-MIDDLES">BOTTLE-MIDDLES</option>
                <option value="TOP-LOWERS">TOP-LOWERS</option>
                <option value="BOTTLE-LOWERS">BOTTLE-LOWERS</option>
                <option value="No identificable">No identificable</option>
            </select><p></p>
            <h3 style="font-size: 100%;">Religión:</h3>
            <select name="Religion" style="max-width:100%;" required>
                <option value="">Seleccionar</option>
                <option value="Protestant/Other Christian">Protestant/Other Christian</option>
                <option value="Catholic">Catholic</option>
                <option value="Mormon">Mormon</option>
                <option value="Jewish">Jewish</option>
                <option value="Muslim">Muslim</option>
                <option value="Other non-Christian">Other non-Christian (Buddhist, Hindu, Native American, Sikh, Wiccan, Pagan, Spiritualist, Sikh, Unitarian/Universalist)</option>
                <option value="No religion identity">No religion identity (Atheist, Agnostic, Humanist, No religion)</option>
                <option value="No identificable">No identificable</option>
            </select><p></p>
            <h3 style="font-size: 100%;">General lisfestyle:</h3>
            <select name="General_Lisfestyle" style="max-width:100%;" required>
                <option value="">Seleccionar</option>
                <option value="Activism">Activism</option>
                <option value="Asceticism">Asceticism</option>
                <option value="Modern Primitivism">Modern Primitivism</option>
                <option value="Back to the land">Back to the land</option>
                <option value="Bohemianism">Bohemianism</option>
                <option value="Clothes free">Clothes free</option>
                <option value="Communal living">Communal living</option>
                <option value="Groupie lifestyle">Groupie lifestyle</option>
                <option value="Hippie">Hippie</option>
                <option value="Nomadism">Nomadism</option>
                <option value="Quirkyalone">Quirkyalone</option>
                <option value="Rural lifestyle">Rural lifestyle</option>
                <option value="Simple living">Simple living</option>
                <option value="Traditional lifestyle">Traditional lifestyle</option>
                <option value="Other">Other</option>
                <option value="No identificable">No identificable</option>
            </select><p></p>
            <h3 style="font-size: 100%;">Partido Politico:</h3>
            <select name="Partido_Politico" style="max-width:100%;" required>
                <option value="">Seleccionar</option>
                <option value="Republican">Republican</option>
                <option value="Democrat">Democrat</option>
                <option value="Libertarian">Libertarian</option>
                <option value="Independiente">Independiente</option>
                <option value="Green">Green</option>
                <option value="Other">Other</option>
                <option value="No identificable">No identificable</option>
            </select>
            <p></p><hr><p></p>
            <label><input type="checkbox" name="check_list[]" value="Affectionate, passionate, loving, romantic" cursor="pointer">Affectionate, passionate, loving, romantic.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Amicable, amiable, affable, benevolent" cursor="pointer"> Amicable, amiable, affable, benevolent.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Awkward, absent-minded, forgetful, careless" cursor="pointer"> Awkward, absent-minded, forgetful, careless.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Brave, courageous, daring, adventuresome" cursor="pointer"> Brave, courageous, daring, adventuresome.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Broad-minded, open-minded, liberal, tolerant" cursor="pointer"> Broad-minded, open-minded, liberal, tolerant.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Creative, inventive, imaginative, artistic" cursor="pointer"> Creative, inventive, imaginative, artistic.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Dominating, authoritarian, demanding, aggressive" cursor="pointer"> Dominating, authoritarian, demanding, aggressive.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Efficient, organized, diligent, thorough" cursor="pointer"> Efficient, organized, diligent, thorough.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Egocentric, vain, self-centered, narcissistic" cursor="pointer"> Egocentric, vain, self-centered, narcissistic.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Frank, straightforward, outspoken, candid" cursor="pointer"> Frank, straightforward, outspoken, candid.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Funny, humorous, amusing, witty" cursor="pointer"> Funny, humorous, amusing, witty.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Intelligent, smart, bright, well-informed" cursor="pointer"> Intelligent, smart, bright, well-informed.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Kind, good-hearted, warm-hearted, sincere" cursor="pointer"> Kind, good-hearted, warm-hearted, sincere.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Refined, gracious, sophisticated, dignified" cursor="pointer"> Refined, gracious, sophisticated, dignified.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Reserved, conservative, quiet, conventional" cursor="pointer"> Reserved, conservative, quiet, conventional.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Self-assured, confident, self-sufficient, secure" cursor="pointer"> Self-assured, confident, self-sufficient, secure.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Sociable, friendly, cheerful, likeable" cursor="pointer"> Sociable, friendly, cheerful, likeable.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Stubborn, hard-headed, headstrong, obstinate" cursor="pointer"> Stubborn, hard-headed, headstrong, obstinate.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Tense, nervous, high-strung, excitable" cursor="pointer"> Tense, nervous, high-strung, excitable.<br></label>
            <label><input type="checkbox" name="check_list[]" value="Trustworthy, competent, reliable, responsible" cursor="pointer"> Trustworthy, competent, reliable, responsible.<br></label>
            </div>
            <input type="hidden" name="Id_perfil" value=<?php echo $id_perfil; ?>><br>
            <div style="text-align:center"><input type="submit" name="submit" value="Etiquetar" required><br></div>
        </form>
    </section>
</div>
<!--<div class="w3-container">
    
    <div class="pic">
	<a><img src="https://s.yimg.com/dh/ap/social/profile/profile_b48.png" width="50" height="50" /></a>
	<div class="data">
	<h3>Johnny Appleseed</h3>
    </div>
    </div>
    <h4>About Me:</h4>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>-->

</div>
</body>
</html>
<?php
}else{
	echo '<script> window.location="index.php"; </script>';
}
?>