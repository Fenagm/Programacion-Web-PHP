<br><br><br><br>
<?php
require_once("../../secciones/funcion.php");
require_once("../../secciones/config.php");
require_once("../../secciones/arrays.php");


/*----------------------------------------------------------------CHEQUEO DATOS----------------------------------*/  

if( empty($_POST["email"]) || empty($_POST["usuario"])|| empty($_POST["password"])|| empty($_POST["perfil"])) :

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "Todos los campos son obligatorios";

header("Location:../index.php?seccion=registrar_users");
die();
endif;

/*----------------------------------------------------------------TOMA DE DATOS----------------------------------*/  
$usuario=$_POST["usuario"];
$email=$_POST["email"];
$pass=$_POST["password"];
$perfil=$_POST["perfil"];
$rutauser="../../users/";

/*----------------------------------------------------------------CHEQUEO DATOS----------------------------------*/  
if(is_dir("../../users/$email")):

    $_SESSION["estado"] = "error";
    $_SESSION["mensaje"] = "E-mail ya registrado.";
    header("Location:../index.php?seccion=registrar_users");
    die();
endif;


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

/*----------------------------------------------------------------ALTA USUARIO----------------------------------*/  

$dir="../../users/$email";
mkdir($dir);

file_put_contents("$dir/usuario.txt", $usuario);

file_put_contents("$dir/perfil.txt", $perfil);

$pass = password_hash($pass, PASSWORD_DEFAULT);

file_put_contents("$dir/password.txt",$pass);


    $_SESSION["estado"] = "ok";
    $_SESSION["mensaje"] = "Alta de usuario correcta.";


header("Location:../index.php?seccion=listado_users");