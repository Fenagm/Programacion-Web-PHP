<?php include_once ("funcion.php"); ?>



<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-6">

            <h1 class="text-center">Contactanos</h1>
            <?php
         if(!empty($_SESSION["estado"])):
$mensaje=$_SESSION["mensaje"];

  
?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Error!</strong> <?= $mensaje ?? ""; ?>
            </div>



            <?php

endif;
?>

            <?php
         if(!empty($_GET["reg"])):
  $reg = $_GET["reg"];
  $nombre=$_GET["nombre"];
  $email=$_GET["email"];
   $com = urldecode($_GET["com"]);
   $gen = urldecode($_GET["gen"]);
   $esti = urldecode($_GET["esti"]);    
  
?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Bienvenido, Usted se ha registrado correctamente:</strong>
                <br> Usuario: <?= $nombre ?>
                <br> E-mail: <?= $email ?>
                <br>Solicito informacion los sobre: <?= $esti ?> 
                <br>Solicito informacion los sobre: <?= $gen ?>
                <br> Nos comento lo siguiente: <?= $com ?> 
            </div>



            <?php

endif;
?>

            <form action="secciones/procesar.php" method="post">

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId"
                        placeholder="">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId"
                        placeholder="">
                </div>
                <p>Contanos tus gustos, y te enviaremos información</p>
                <div class="form-group">
                    <p>Genero</p>
                    <input type="checkbox" name="genero[]" value="suspenso" checked> Suspenso<br>
                    <input type="checkbox" name="genero[]" value="ciencia_ficcion"> Ciencia Ficción <br>
                    <input type="checkbox" name="genero[]" value="fantasia"> Fantasia <br>
                    <input type="checkbox" name="genero[]" value="drama">Drama <br>
                    <input type="checkbox" name="genero[]" value="romantica"> Romantico <br>
                </div>
                <div class="form-group">
                    <p>Estilo</p>
                    <input type="checkbox" name="estilo[]" value="poesia" checked> Poesía<br>
                    <input type="checkbox" name="estilo[]" value="cuentos"> Cuentos <br>
                    <input type="checkbox" name="estilo[]" value="novelas"> Novelas <br>
                    <input type="checkbox" name="estilo[]" value="narrativos"> Narrativos <br>
                    <input type="checkbox" name="estilo[]" value="best_seller"> Best Sellers <br>
                </div>
                <div class="form-group">
                    <label for="comentario">Comentario (Opcional)</label>
                    <textarea class="form-control" name="comentario" id="comentario" rows="3"></textarea>
                    <small id="helpId" class="form-text text-muted">Máximo 200 caracteres</small>
                </div>


                <button type="submit" class="btn btn-primary">Enviar</button>


            </form>
        </div>
    </div>
</div>