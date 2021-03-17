<br>
<br>

<?php
 require_once("funcion.php"); 
   $dir = "libros";
   $recurso = opendir($dir); 
?>
<hr>




<div class="container">
    <div class="row">

        <?php
                while($libro = readdir($recurso)):
                    // chequear ese . y ..
                    if($libro == "." || $libro == "..")
                        continue;

            ?>
        <div class="col-lg-4 ">
            <div class="row">
            <br>
            <div class="card-group">
            <div class="card border-dark mb-9" >
            <br>
                <div class="col-lg-6 col-md-6 col-xs-6">


                
                    <img src="<?= "$dir/$libro/$libro.jpg"; ?>" alt="<?= $libro ?>" class="mx-auto d-block">
                    <div class="card-body"  style="width: 20rem;">
                        <h5 class="card-title"> <?php echo titulo($libro) ?></h5>
                        <p class="card-text-center"><?php echo nl2br(file_get_contents("$dir/$libro/descripcion.txt"))?></p>
                        <a href="index.php?seccion=contacto" class="btn btn-primary d-block mx-auto">Consultar</a>
                    </div>
                </div>
            </div>


            </p>
        </div>
        </div>
        </div>

    <?php
                endwhile;
            ?>

</div>
</div>