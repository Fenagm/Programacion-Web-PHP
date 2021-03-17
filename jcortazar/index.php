<!doctype html>
<?php

	
	require_once("secciones/arrays.php");
	require_once("secciones/funcion.php");
    require_once("secciones/config.php");

	$seccion = $_GET["seccion"] ?? "home";
?>
<html lang="es">

<head>
    <title>Julio Cortazar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<?php

/*----------------------------------------------------------------NAVBAR SECCIONES----------------------------------*/

?>
<nav class="navbar navbar-expand-lg navbar-light bg-custom position:fixed" style="text-align: center">
    <div class="logo"> <a href="index.php" target="_blank"><img src="img/logo.png" alt="logo" width="130"></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" style="text-align: center" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <?php foreach ($navbar as $navitem => $url): ?>
            <li class="nav-item">
                <a class="nav-link <?= !empty($_GET["seccion"]) && $_GET["seccion"] == $url ? "active" : ""; ?>"
                    href="index.php?seccion=<?=$url ?>"><?= $navitem ?></a>
            </li>
            <?php endforeach ?>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav mr-0">

<?php

/*----------------------------------------------------------------NAVBAR LOGIN----------------------------------*/

    if(isset($_SESSION["usuario"])):
        $usuario = $_SESSION["usuario"];
        if($_SESSION["usuario"]["perfil"] == "admin"):

?>

            <li class="nav-item">
                <a href="admin/index.php" class="nav-link"><?= $_SESSION["usuario"]["usuario"]; ?></a>
            </li>
<?php
        else:
?>
            <li class="nav-item">
            <a href="index.php?seccion=perfil" class="nav-link"><?= $_SESSION["usuario"]["usuario"]; ?></a>
            </li>
<?php
        endif;
?>

        <li class="nav-item">
            <a href="actions/logout.php" class="nav-link">Salir</a>
        </li>
<?php
    else:
?>

    <li class="nav-item">
        <a href="index.php?seccion=login" class="nav-link">Ingresar</a>
    </li>
    
    <li class="nav-item">
        <a href="index.php?seccion=registro" class="nav-link">Registrarse</a>
    </li>
<?php
    endif;

/*----------------------------------------------------------------NAVBAR FIN----------------------------------*/     


?>
</ul>
</div><!-- /.navbar-collapse -->

</nav>

</div>
</div>
<?PHP 

/*----------------------------------------------------------------MENSAJES----------------------------------*/     

if(isset($_SESSION["estado"])):
    $clase = $_SESSION["estado"] == "error" ? "danger" : "success";

    $respuesta = "<br><div class='alert alert-$clase alert-dismissible fade show' role='alert'><div class='row mx-4'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        <span class='sr-only'>Close</span>
    </button>
    <strong></strong> $_SESSION[mensaje]
</div></div>";

    

    unset($_SESSION["estado"]);
else:
    $respuesta = false;
endif;

echo $respuesta;
?>





<br>

<body>


    <div class="container yo">

        <?php


/*----------------------------------------------------------------CARGA SECCIONES----------------------------------*/

/*			
			if($seccion == "")
				require_once("index.php");

			elseif($seccion == "bio")
				require_once("secciones/bio.php");

			elseif($seccion == "publicaciones")
        require_once("secciones/publicaciones.php");

        elseif($seccion == "contacto")
                require_once("secciones/contacto.php");
       
        elseif($seccion == "login")
                require_once("secciones/login.php");            
       
        elseif($seccion == "registro")
                require_once("secciones/registro.php");      

			else
				require_once("secciones/bio.php");
			
*/
if(file_exists("secciones/$seccion.php")):
    require_once("secciones/$seccion.php");
else:
    require_once("secciones/bio.php");
endif;

/*----------------------------------------------------------------FOOTER----------------------------------*/

		?>

    </div>
</body>
<footer class="page-footer font-small special-color-dark pt-4">
    <hr>
    <!-- Footer Elements -->


    <!-- Social buttons -->
    <ul class="list-unstyled list-inline text-center">
        <li class="list-inline-item">
            <a href="https://www.facebook.com/" target="_blank" class="btn-floating btn-fb mx-1">
                <img src="img/facebook.jpg" alt="facebook logo">
            </a>
        </li>
        <li class="list-inline-item">
            <a href="https://twitter.com/" target="_blank" class="btn-floating btn-tw mx-1">
                <img src="img/twitter.jpg" alt="twitter logo">
            </a>
        </li>
        <li class="list-inline-item">
            <a href="https://www.instagram.com/" target="_blank" class="btn-floating btn-gplus mx-1">
                <img src="img/instagram.jpg" alt="instagram logo">
            </a>
        </li>

    </ul>
    <!-- Social buttons -->

    </div>
    <!-- Footer Elements -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 bg-custom">
        <p>Queda expresamente prohibida, sin la autorización escrita de los titulares del Copyright©, bajo las
            sanciones
            establecidas por las leyes, la reproducción total o parcial de esta obra por cualquier medio o
            procedimiento, comprendidas la reprografía y el tratamiento informático</p>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->

<!-- JavaScript -->
<script src="lib/jquery/jquery-3.3.1.min.js"></script>
<script src="lib/popper/popper.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>


</html>