<?php 

require_once("config.php");
require_once("funcion.php");

/*----------------------------------------------------------------CHEQUEO DATOS----------------------------------*/   

if(empty($_POST["email"]) || empty($_POST["password"])):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Los campos email y password son obligatorios";

    header("Location:../index.php?seccion=perfil");
    die();
endif;




/*----------------------------------------------------------------CAMBIO CLAVE----------------------------------*/   

$password = $_POST['password'];
$email =$_POST['email'];
$password = password_hash($password, PASSWORD_DEFAULT);

file_put_contents(RUTA_USERS . "/$email/password.txt",$password);

$_SESSION["estado"] = "ok";
$_SESSION["mensaje"] = "Clave Actualizada correctamente";

header("Location:../index.php?seccion=perfil");
die();