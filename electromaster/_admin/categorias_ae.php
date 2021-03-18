<?php
require('inc/header.php');
require('clases/categorias.php')
?>

<div class="container-fluid">

    <?php $categoriasMenu = 'Categorias';
    include('inc/side_bar.php');

    if(  !in_array('cat.add',$_SESSION['usuario']['permisos']) &&
    !in_array('cat.del',$_SESSION['usuario']['permisos']) &&		
    !in_array('cat.edit',$_SESSION['usuario']['permisos']) &&
    !in_array('cat.see',$_SESSION['usuario']['permisos'])){ 
        header('Location: index.php');
    }

    $cat = new Categoria($con);

    if (isset($_GET['edit'])) {
        $categoria = $cat->get($_GET['edit']);
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
                echo "Modificar Categoria";
            } else {
                echo "Nueva Categoria";
            } ?>
        </h1>

        <div class="col-md-2"></div>
        <form action="categorias.php" method="post" class="col-md-6 from-horizontal" enctype="multipart/form-data">

            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder=""
                        value="<?php echo (isset($categoria->nombre) ? $categoria->nombre : ''); ?>">
                    <br>
                </div>
            </div>

            <div class="form-group">
                <label for="cat_superior" class="col-sm-2 control-label">Pertenece</label>
                <div class="col-sm-10">
                    <select name="id_padre" id="id_padre" onchange="pOnChange(this)">
                        <option value="0">--
                            <?php  foreach($cat->getList() as $t){?>
                        <option value="<?php echo $t['id_categoria']?>" <?php 
									if(isset($categoria->id_padre)){
										if($t['id_categoria'] == $categoria->id_padre){
											echo ' selected="selected" ';
										}
									}          
                                    ?>><?php echo $t['nombre']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div id="imagen" <?php if(isset($categoria->id_padre) && $categoria->id_padre > 0){
                                        echo'style="display:none;"';}?>>
                <label for="imagen" class="col-sm-2 control-label">Imagen</label>
                <div class="container">
                    <div class="col-md-10">
                        <div class="form-group">
                            <div class="row">
                                <?php if (isset($categoria->img) && $categoria->img != ''){?>
                                <div class="col-md-3">
                                    <td class="p-3"><img width="85" height="85" src="../imagenes/categorias/<?php echo $categoria->img ?>"></td>
                                </div>
                                <?php } ?>
                                <div class="col-sm-10 col-md-9">
                                    <label for="img">Cargar Imagen Categoria</label>
                                    <input type="file" class="form-control-file" name="img" id="img">
                                    <small class="form-text text-muted">La imagen debe ser de 1000px x 1000px. El
                                        formato
                                        debe
                                        ser <b>JPG</b></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label for="habilitado" class="control-label">
                            <?php if(isset($categoria->habilitado)) {
                                     if($categoria->habilitado == 1) {echo '<input type="checkbox" name="habilitado" value="0" "checked">';
                                        echo "Deshabilitar";
                                    }else{
                                        echo '<input type="checkbox" name="habilitado" value="1">';
                                        echo "Habilitar";
                                    }
                                }else{echo '<input type="hidden" name="habilitado" value="1" checked >' ;
                                            echo "Las categorias nuevas, se habilitan por defecto.";} ?>

                        </label>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" name="formulario_categorias">Guardar</button>
                </div>
            </div>
            <input type="hidden" class="form-control my-3" id="id_categoria" name="id_categoria" placeholder=""
                value="<?php echo (isset($categoria->id_categoria) ? $categoria->id_categoria : ''); ?>">

        </form>
    </div>


</div>
<!--/row-->
</div>
</div>
<!--/.container-->

<?php include('inc/footer.php'); ?>