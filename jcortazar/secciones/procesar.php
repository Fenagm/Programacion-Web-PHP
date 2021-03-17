<?php 


$nombre = $_POST['nombre'];
$email = $_POST['email'];
$comentario = $_POST['comentario'];
$genero = $_POST['genero'];
$estilo = $_POST['estilo'];


require_once("funcion.php");
require_once("config.php"); 
/*---------------------------------------------------------------- CHEQUEO DATOS ----------------------------------*/  


if(strlen($_POST["nombre"]) ==""):
     
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Los todos los campos son obligatorios. Chequee el nombre por favor.";

    header("Location:../index.php?seccion=contacto");
   
    die();
endif;

if(strlen($_POST["comentario"]) > 200):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Comentario demasiado largo.";

    header("Location:../index.php?seccion=contacto");
    die();
endif;

if(strpos($_POST["email"],"@") === false):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "formato de mail incorrecto";

    header("Location:../index.php?seccion=contacto");
    die();
endif;

if(empty($_POST['nombre'] && $_POST['email'])){

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Complete todos los datos. Mail y nombre son obligatorios. ";
   
    header("Location:../index.php?seccion=contacto&error=errornom");}
    else{



?>
<br>




Nombre: <?php echo $nombre ?>
<br>
Email: <?php echo $email?>
<br>
Comentario: <?php echo $comentario?>
<br>
Generos elegidos:<?php print_r($genero)?>
<br>
Estilos elegidos:<?php print_r($estilo)?>

<?php
$com=urlencode($comentario);

$genero = array2string($genero);

$estilo = array2string($estilo);

echo($estilo);
echo($genero);



    header("Location:../index.php?seccion=contacto&reg=registrado&nombre=$nombre&email=$email&com=$com&gen=$genero&esti=$estilo");}
    
   
?>