<?php
require('inc/header.php');
require('clases/marcas.php')
?>

<div class="container-fluid">

    <?php $marcasMenu = 'Marcas';
    include('inc/side_bar.php');

    if(  !in_array('marc.add',$_SESSION['usuario']['permisos']) &&
    !in_array('marc.del',$_SESSION['usuario']['permisos']) &&		
    !in_array('marc.edit',$_SESSION['usuario']['permisos']) &&
    !in_array('marc.see',$_SESSION['usuario']['permisos'])){ 
        header('Location: index.php');
    }

    $marc = new Marca($con);

    if (isset($_GET['edit'])) {
        $marca = $marc->get($_GET['edit']);
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
                echo "Modificar Marca";
            } else {
                echo "Nueva Marca";
            } ?>
        </h1>

        <div class="col-md-2"></div>
        <form action="marcas.php" method="post" class="col-md-6 from-horizontal">

            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder=""
                        value="<?php echo (isset($marca->nombre) ? $marca->nombre : ''); ?>">
                    <br>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label for="habilitado" class="control-label">                          
                        <?php if(isset($marca->habilitado)) {
                                     if($marca->habilitado == 1) {echo '<input type="checkbox" name="habilitado" value="0" "checked">';
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
                    <button type="submit" class="btn btn-primary" name="formulario_marcas">Guardar</button>
                </div>
            </div>
            <input type="hidden" class="form-control my-3" id="id_marca" name="id_marca" placeholder=""
                value="<?php echo (isset($marca->id_marca) ? $marca->id_marca : ''); ?>">

        </form>
    </div>


</div>
<!--/row-->
</div>
</div>
<!--/.container-->

<?php include('inc/footer.php'); ?>