<?php

require_once("../secciones/config.php");
require_once("../secciones/funcion.php");

/*----------------------------CHEQUEO CAMPOS VACIOS-----------------------*/

if(empty($_POST["usuario"]) || empty($_POST["password"])):
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Los campos usuario/email y password son obligatorios";

    header("Location: ../index.php?seccion=login");
    die();
endif;

/*----------------------------OBTENGO DATOS -----------------------*/

$email = $_POST["usuario"];
$password = $_POST["password"];


if(strpos($email,"@") === false)
    $usuario = true;
else
    $usuario = false;


if($usuario):
    
    $usuarios = glob(RUTA_USERS . "/*/usuario.txt");

    
    foreach($usuarios as $nombreUsuario):
        
        $usr = file_get_contents($nombreUsuario);

    
        if($usr == $email){
        
            $usuarioLogin = $usr;
        
            break;
        }

    endforeach;

 
    if(isset($usuarioLogin)){
       
        $email = dirname($nombreUsuario);
       
        $email = explode(RUTA_USERS . "/", $email)[1];
    }

endif;

/*----------------------------CHEQUEO PASSWORD -----------------------*/

$passwordAnterior = file_get_contents(RUTA_USERS . "/$email/password.txt");

if(!is_dir(RUTA_USERS . "/$email") || !password_verify($password,$passwordAnterior)):
    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Los datos ingresados son incorrectos";

    header("Location: ../index.php?seccion=login");

    die();
endif;

$perfil = file_get_contents(RUTA_USERS . "/$email/perfil.txt");
$usuario = file_get_contents(RUTA_USERS . "/$email/usuario.txt");

/*----------------------------INICIO SESION -----------------------*/

$_SESSION["usuario"] = [
    "usuario" => $usuario,
    "email" => $email,
    "perfil" => $perfil
];


$_SESSION["estado"] = "ok";
$_SESSION["mensaje"] = "Bienvenido "  ?><?= "<b> $usuario</b>";

/*----------------------------REDIRECCION SEGUN PERFIL -----------------------*/

if($perfil == "admin"):
    
    header("Location: ../admin/index.php");
    die();
else:
   
    header("Location: ../index.php");
    die();
endif;