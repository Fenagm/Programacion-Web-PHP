<?php
require_once("../../secciones/funcion.php");
require_once("../../secciones/config.php");
require_once("../../secciones/arrays.php");



/*----------------------------------------------------------------CHEQUEO DATOS----------------------------------*/  
if(empty($_POST["email"]) || empty($_POST["usuario"]) || empty($_POST["perfil"])  ):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Completar los siguientes campos: email, usuario y perfil";

    header("Location:../index.php?seccion=registrar_users");
    die();
endif;

/*----------------------------------------------------------------TOMA DE DATOS----------------------------------*/  

$email=$_POST["email"];
$usuario=$_POST["usuario"];
$perfil=$_POST["perfil"];
$emailviejo=$_POST["emailviejo"];
$usuarioviejo=$_POST["usuarioviejo"];
$rutauser="../../users/";

/*----------------------------------------------------------------CHEQUEO MAIL EXISTENTES----------------------------------*/  
if($emailviejo!=$email):

if(is_dir("$rutauser/$email")):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Lo sentimos, mail ya registrado";


    header("Location:../index.php?seccion=listado_users");
    die();
endif;
endif;

rename("$rutauser/$emailviejo", "$rutauser/$email");

/*----------------------------------------------------------------CHEQUEO USUARIOS EXISTENTES----------------------------------*/ 
    if($usuarioviejo!=$usuario):
        $usuarios = glob($rutauser."*/usuario.txt");
       
           
           foreach($usuarios as $nombreUsuario):
            
               $usr = file_get_contents($nombreUsuario);
            
               
               if($usr == $usuario){

                $_SESSION["estado"] = "error";
                $_SESSION["mensaje"] = "Nombre de usuario no disponible. Intente otro.";
            
          
                    header("Location:../index.php?seccion=listado_users");
                    die();
                   ;
                   
                   break;
               }
       
           endforeach;
         
endif;


/*----------------------------------------------------------------CREACION ARCHIVOS USUARIO----------------------------------*/ 

    
     
file_put_contents("$rutauser/$email/perfil.txt",$perfil);

file_put_contents("$rutauser/$email/usuario.txt",$usuario);

$_SESSION["estado"] = "ok";
$_SESSION["mensaje"] = "Usuario modificado correctamente";

header("Location:../index.php?seccion=listado_users");