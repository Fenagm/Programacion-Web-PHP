<?php
require_once("../../secciones/funcion.php");
require_once("../../secciones/config.php");
require_once("../../secciones/arrays.php");



/*----------------------------------------------------------------CHEQUEO CAMPOS----------------------------------*/  

if(empty($_POST["libros"])):

    
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Libro no indexado.";

    header("Location:../index.php?seccion=listado_libros");
    die();
endif;

$libros = $_POST["libros"];


if(!is_dir("../../libros/$libros")):
  
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Libro no indexado.";

    header("Location:../index.php?seccion=listado_libro");
    die();
endif;


/*----------------------------------------------------------------BORRADO DE DATOS----------------------------------*/  

if(is_file("../../libros/$libros/$libros.jpg"))
    unlink("../../libros/$libros/$libros.jpg");
    
unlink("../../libros/$libros/descripcion.txt");
unlink("../../libros/$libros/marca.txt");

rmdir("../../libros/$libros");
  
$_SESSION["estado"] = "ok";
$_SESSION["mensaje"] = "Libro eliminado correctamente";

header("Location:../index.php?seccion=listado_libro");
die();


