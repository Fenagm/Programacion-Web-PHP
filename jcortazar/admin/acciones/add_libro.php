<br><br><br><br>
<?php
require_once("../../secciones/funcion.php");
require_once("../../secciones/config.php");
require_once("../../secciones/arrays.php");

/*----------------------------CHEQUEO CAMPOS VACIOS-----------------------*/

if(empty($_POST["nombre"]) || ($_FILES["imagen"]["size"]==0)) :

    
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Los todos los campos son obligatorios";

header("Location:../index.php?seccion=registrar_libros");
die();
endif;


/*----------------------------OBTENGO DATOS -----------------------*/

$nombre = trim(strtolower($_POST["nombre"])); 
$descripcion = $_POST["descripcion"];
$nombre=nombreenruta($nombre);
$nombreoriginal=$_POST["nombre"];

/*----------------------------CHEQUEO LIBRO CON EXISTENTES -----------------------*/
if(is_dir("libros/$nombre")):

    
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Libro ya indexado.";

    header("Location:../index.php?seccion=registrar_libros");
    die();
endif;


/*----------------------------CREO LIBRO NUEVO-----------------------*/

mkdir("../../libros/$nombre");

file_put_contents("../../libros/$nombre/descripcion.txt",$descripcion);


/*----------------------------CHEQUEO IMAGEN-----------------------*/

if(!empty($_FILES["imagen"])):
    $nombreLibro = $_FILES["imagen"]["name"];
    
    if($_FILES["imagen"]["name"] && strpos($nombreLibro,".jpg") === false):

          
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Error en formato de imagen. Solo se admiten '.JPG' ";

        header("Location:../index.php?seccion=registrar_libros");
        die();
    endif;

    $imagen  = $_FILES["imagen"];
    $origen  = $_FILES["imagen"]["tmp_name"];
    $destino = "../../libros/$nombre/$nombre.jpg";

    move_uploaded_file($origen, $destino);

endif;

    $_SESSION["estado"] = "ok";
    $_SESSION["mensaje"] = "Libro $nombreoriginal registrado exitosamente";

header("Location:../index.php?seccion=listado_libros");