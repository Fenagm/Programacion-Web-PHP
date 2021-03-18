<?php
require('inc/header.php');
require('clases/comentarios.php')
?>

<div class="container-fluid">

    <?php $comentariosMenu = 'Comentarios';
    include('inc/side_bar.php');

    if(  !in_array('coment.add',$_SESSION['usuario']['permisos']) &&
    !in_array('coment.del',$_SESSION['usuario']['permisos']) &&		
    !in_array('coment.edit',$_SESSION['usuario']['permisos']) &&
    !in_array('coment.see',$_SESSION['usuario']['permisos'])){ 
        header('Location: index.php');
    }

    $coment = new Comentario($con);

    if (isset($_GET['edit'])) {
        $comentario = $coment->get($_GET['edit']);
    }
    ?>



    <div class="col-sm-9 col-md-10 main">

        <!--toggle sidebar button-->
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i
                    class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            <?php if (!empty($_GET)) {
                echo "Modificar Comentario";
            } else {
                echo "Nuevo Comentario";
            } ?>
        </h1>

        <div class="col-md-2"></div>
        <form action="comentarios.php" method="post" class="col-md-6 from-horizontal">

            <div class="form-group">
                <label for="valoracion" class="col-sm-2 control-label">Valoracion</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="valoracion" name="valoracion" readonly placeholder=""
                        value="<?php echo (isset($comentario->valoracion) ? $comentario->valoracion : ''); ?>">
                    <br>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="date" name="date" readonly placeholder=""
                        value="<?php echo (isset($comentario->date) ? $comentario->date : ''); ?>">
                    <br>
                </div>
            </div>
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Producto</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" readonly placeholder=""
                        value="<?php echo (isset($comentario->nombre) ? $comentario->nombre : ''); ?>">
                    <br>
                </div>
            </div>
            <div class="form-group">
                <label for="modelo" class="col-sm-2 control-label">Modelo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" readonly placeholder=""
                        value="<?php echo trim($comentario->modelo)?>">
                    <br>
                </div>
            </div>
            <div class="form-group">
                <label for="comentario" class="col-sm-2 control-label">Descripcion</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="comentario" 
                        name="comentario" rows="2"><?php echo trim($comentario->comentario)?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label for="habilitado" class="control-label">
                            <?php if(isset($comentario->habilitado)) {
                                     if($comentario->habilitado == 1) {echo '<input type="checkbox" name="habilitado" value="0" "checked">';
                                    echo "Deshabilitar";
                                }else
                                    {echo '<input type="checkbox" name="habilitado" value="1">';
                                    echo "Habilitar";
                                }}  else {echo '<input type="hidden" name="habilitado" value="1" checked >' ;
                                            echo "Las marcas nuevas, se habilitan por defecto.";} ?>

                        </label>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" name="formulario_comentarios">Guardar</button>
                </div>
            </div>
            <input type="hidden" class="form-control my-3" id="id_ranking" name="id_ranking" placeholder=""
                value="<?php echo (isset($comentario->id_ranking) ? $comentario->id_ranking : ''); ?>">

        </form>
    </div>


</div>
<!--/row-->

<!--/.container-->

<?php include('inc/footer.php'); ?>