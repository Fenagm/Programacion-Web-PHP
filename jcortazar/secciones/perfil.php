<?php 
require_once("config.php");
require_once("funcion.php");
?>
<div class='container'>

    <?php 
/*----------------------------------------------------------------MENSAJES----------------------------------*/  

if(isset($_SESSION["estado"])):
    ?>
    <div class="alert alert-success" class="col-12 col-md-6">
        <a class="close" data-dismiss="alert"></a>
        <strong>Well done!</strong> <?=$_SESSION[mensaje];


unset($_SESSION["estado"]);
else:
$respuesta = false;

endif;
?>
</div>

<?php



/*----------------------------------------------------------------TOMA DE DATOS----------------------------------*/  



$usuario = $_SESSION["usuario"]["usuario"];
$perfil = $_SESSION["usuario"]["perfil"];
$email= $_SESSION["usuario"]["email"];
$password = file_get_contents(RUTA_USERS . "/$email/password.txt");


/*----------------------------------------------------------------FORMULARIO----------------------------------*/  
 ?>

    <div class="container">


        <h1 class="text-center my-3">Perfil de Usuario</h1>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card my-5">
                    <div class="card-body border-white">
                        <form action="secciones/passwordupdate.php" method="post">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" value=<?=$usuario; ?> class="form-control" readonly>
                                <br>
                                <br>
                                <label>Perfil</label>
                                <input type="text" value=<?=$perfil; ?> class="form-control" readonly>
                                <br>
                                <br>
                                <label>Email</label>
                                <input type="form-control" value=<?=$email; ?> name="email" id="email"
                                    class="form-control" readonly>
                                <br>
                                <br>
                                <label>Nueva Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    aria-describedby="helpId" placeholder="">


                                <div>
                                    <br>
                                    <button class="btn btn-primary">Actualizar Contraseña</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>