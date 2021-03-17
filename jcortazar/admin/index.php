<!doctype html>
<?php
require_once("../secciones/arrays.php");
require_once("../secciones/funcion.php");
require_once("../secciones/config.php");


/*---------------------------------------------------------------- TIPO PERFIL ----------------------------------*/  

$perfil = $_SESSION["usuario"]["perfil"];



if($perfil!=="admin"):



$_SESSION["estado"] = "error";
$_SESSION["mensaje"] = "Necesita iniciar sesión y ser administrador";

header("Location:../index.php") ;
endif;
	

    $seccion = $_GET["seccion"] ?? "home";
    
    /*---------------------------------------------------------------- PANEL ----------------------------------*/  
?>

<html lang="es">

<head>
    <title>Julio Cortazar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<br>


<div class="row">

    <div class="col-sm-2 bg-custom">

        <nav class="navbar navbar-expand-lg navbar-light bg-custom justified" style="text-align: center">
            <div class="logo"> <a href="index.php" target="_blank"><img src="logo.png" alt="logo" width="130"></a>


                <?php foreach ($navbaradmin as $navitem => $url): ?>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= !empty($_GET["seccion"]) && $_GET["seccion"] == $url ? "active" : ""; ?>"
                            href="index.php?seccion=<?=$url ?>"><?= $navitem ?></a>
                    </li>
                    <?php endforeach ?>



                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Web Pública</a>
                    <li></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../actions/logout.php"> Cerrar sesión</a>
                    <li></li>
                
                </ul>

            </div>
    </div>

    <div class="col-sm-10 pl-1 " class="span12" style="border: 2px primary">
        <div>


            <?php
	       
	        if(file_exists("secciones/$seccion.php")):
	            require_once("secciones/$seccion.php");
	        else:
	            require_once("secciones/listado_libros.php");
	        endif;

	    ?>


        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="lib/jquery/jquery-3.3.1.min.js"></script>
<script src="lib/popper/popper.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>


</html>