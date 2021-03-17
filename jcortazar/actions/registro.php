<?php

require_once("../secciones/config.php");
require_once("../secciones/funcion.php");


/*----------------------------CHEQUEO CAMPOS VACIOS-----------------------*/

if(empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["usuario"])):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Los todos los campos son obligatorios";

    header("Location:../index.php?seccion=registro");
    die();
endif;


/*----------------------------OBTENGO DATOS -----------------------*/

$email = $_POST["email"];
$password = $_POST["password"];
$usuario= $_POST["usuario"];
$rutauser="../users/";

/*----------------------------CHEQUEO MAIL CON EXISTENTES -----------------------*/

if(is_dir(RUTA_USERS . "/$email")):
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "El mail ya existe en nuestro sitio";

    header("Location:../index.php?seccion=registro");
    die();
endif;

/*----------------------------CHEQUEO USUARIO CON EXISTENTES -----------------------*/
if($usuario):
    $usuarios = glob($rutauser."*/usuario.txt");
   
        foreach($usuarios as $nombreUsuario):
        
           $usr = file_get_contents($nombreUsuario);
     
           
           if($usr == $usuario){

            $_SESSION["estado"] = "error";
            $_SESSION["mensaje"] = "Nombre de usuario no disponible. Intente otro.";
        
      
                header("Location:../index.php?seccion=registro");
                die();
               ;
               
               break;
           }
   
       endforeach;
     
endif;


/*----------------------------CREACION USUARIO -----------------------*/

mkdir(RUTA_USERS . "/$email");

file_put_contents(RUTA_USERS . "/$email/usuario.txt", $usuario);

file_put_contents(RUTA_USERS . "/$email/perfil.txt", "usuario");

$password = password_hash($password, PASSWORD_DEFAULT);

file_put_contents(RUTA_USERS . "/$email/password.txt",$password);

$_SESSION["estado"] = "ok";
$_SESSION["mensaje"] = "Ya podés ingresar con los datos con los que te registraste";


header("Location: ../index.php?seccion=login");