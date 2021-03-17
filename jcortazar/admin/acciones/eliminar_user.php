<?php
require_once("../../secciones/funcion.php");
require_once("../../secciones/config.php");
require_once("../../secciones/arrays.php");


/*----------------------------------------------------------------CHEQUEO DE DATOS----------------------------------*/  
if(empty($_POST["email"])):
      
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Usuario no encontrado.";

    header("Location:../index.php?seccion=registrar_users");
    die();
endif;

$email = $_POST["email"];

$dir="../../users/$email";

if(!is_dir($dir)):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Usuario no encontrado.";

    header("Location:../index.php?seccion=registrar_users");
    die();
endif;


/*----------------------------------------------------------------TOMA DE DATOS----------------------------------*/  

if(is_file("$dir/password.txt"))
    unlink("$dir/password.txt");
    
unlink("$dir/usuario.txt");
unlink("$dir/perfil.txt");

rmdir("$dir");

$_SESSION["estado"] = "ok";
$_SESSION["mensaje"] = "Usuario eliminado correctamente";

header("Location:../index.php?seccion=listado_users");
die();


