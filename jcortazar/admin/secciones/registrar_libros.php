<?php
require_once("../secciones/funcion.php");

require_once("../secciones/arrays.php");

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



/*----------------------------------------------------------------REGISTRAR/MODIFICAR SELECTOR----------------------------------*/  
if(!empty($_GET["libro"])):
        
        $titulo = "Editar Publicación";
        $action = "acciones/editar_libro.php";
        
        $nombre = strtolower($_GET["libro"]);
        $nombre =nombreenruta($nombre);
   
               

        if(!is_dir("../libros/$nombre")):

            $_SESSION["estado"] = "error";
            $_SESSION["mensaje"] = "Libro inexistente";

            header("Location:index.php?seccion=listado_libros");
            die();
        endif;

        

        $descripcion = file_get_contents("../libros/$nombre/descripcion.txt");
       
        
        if(is_file("../libros/$nombre/$nombre.jpg")):
            $imagen = "../libros/$nombre/$nombre.jpg";
        endif;

    else:

        $titulo = "Añadir Publicación";    
        $action = "acciones/add_libro.php";

    endif;


?>
<?
<div class="container">
    <div class="jumbotron">
        <div class="row justify-content-center">


            <div class="col-6 mx-5 mt-1 mb-3">
                <?php

            if(!empty($_GET["estado"])):
                $estado = $_GET["estado"] ?? "error";

                if (!isset($_GET["error"])){
                }else{
                 $error = $_GET["error"];
        
                    error($error);
                            }

           
                        endif;

                

/*---------------------------------------------------------------- FORMULARIO ----------------------------------*/              

            ?>
<br><br><br>
<div class="card">
    <div class="card-body">
        <form action="<?= $action ?>" method="post" enctype="multipart/form-data">
            <p class="text-cente">
                <h1 class="display-4"><?php echo titulo($titulo); ?></h1>
                <hr>
            </p>
            <?php
                            if(isset($nombre)):
                        ?>
            <input type="hidden" name="libro" value="<?= $nombre; ?>">
            <?php
                            endif;
                        ?>


            <div class="form-group">
                <label for="nombre">Titulo</label>
                <input type="text" class="form-control" name="nombre" id="nombre"
                    value="<?= isset($nombre) ? titulo($nombre) : ""; ?>">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" cols="30" class="form-control"
                    rows="4"><?= isset($descripcion) ? $descripcion : ""; ?></textarea>
            </div>


            <div class="form-group">
                <div class="form-group">
                    <label for="imagen"></label>
                    <input type="file" class="form-control-file" name="imagen" id="imagen"
                        aria-describedby="fileHelpId">
                    <small id="fileHelpId" class="form-text text-muted">El formato de la imágen debe ser
                        <b>.jpg Dimensiones max=300x400px.<b> </small>
                </div>

                <?php
                                if(isset($imagen)):
                                ?>
                <div class="card">
                    <div class="card-body">
                        <img src="<?= $imagen; ?>" alt="<?= $nombre; ?>" class="img-fluid">
                    </div>
                </div>
                <?php
                                endif;
                                ?>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn btn-dark"><?= $titulo; ?></button>
        </form>
    </div>
</div>
</div>
</div>
</div>

</div>