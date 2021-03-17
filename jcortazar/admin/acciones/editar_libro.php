<?php
require_once("../../secciones/funcion.php");
require_once("../../secciones/config.php");
require_once("../../secciones/arrays.php");


/*----------------------------------------------------------------CHEQUEO DATOS----------------------------------*/  
if(empty($_POST["nombre"]) || empty($_POST["libro"]) ):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Los todos los campos son obligatorios";

header("Location:../index.php?seccion=registrar_libros");
die();
endif;



/*----------------------------OBTENGO DATOS -----------------------*/

$original = trim(strtolower($_POST["libro"]));
$nuevo = $_POST["nombre"];
$descripcion = $_POST["descripcion"];




/*----------------------------CHEQUEO LIBRO CON EXISTENTES -----------------------*/

if(!is_dir("../../libros/$original")):
        
        $_SESSION["estado"] = "error";
        $_SESSION["mensaje"] = "Libro no ingresado";
    
        header("Location:../index.php?seccion=registrar_libros");
        die();
    endif;




/*----------------------------CHEQUEO IMAGEN-----------------------*/

if(!empty($_FILES["imagen"])):
    $nombrelibro = $_FILES["imagen"]["name"]; 
    
    if($_FILES["imagen"]["name"] && strpos($nombrelibro,".jpg") === false):
  
          
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Error en formato de imagen. Solo se admiten '.JPG' ";

        header("Location:../index.php?seccion=registrar_libros");
        die();
    endif;


/*----------------------------MUEVO IMAGEN-----------------------*/

    $imagen  = $_FILES["imagen"];
    $origen  = $_FILES["imagen"]["tmp_name"];
    $destino = "../../libros/$nuevo/$nuevo.jpg";

    move_uploaded_file($origen, $destino);

endif;

$nuevonombre= nombreenruta($nuevo);

/*----------------------------RENOMBRAR-----------------------*/

if($nuevo!= $original):

    rename("../../libros/$original","../../libros/$nuevonombre");
    
    if(is_file("../../libros/$nuevonombre/$original.jpg")):
        rename("../../libros/$nuevonombre/$original.jpg","../../libros/$nuevonombre/$nuevonombre.jpg");
    endif;
    
    
    $nuevo = $nuevonombre;
endif;


file_put_contents("../../libros/$nuevo/descripcion.txt",$descripcion);

$nuevo=titulo($nuevo);

$_SESSION["estado"] = "ok";
$_SESSION["mensaje"] = "Libro $nuevo registrado exitosamente";

header("Location:../index.php?seccion=listado_libros");