<?php
require('inc/header.php');
require('clases/productos.php')
?>

<div class="container-fluid">

    <?php $productsMenu = 'Productos';
    include('inc/side_bar.php');

    $prod = new Producto($con);

    if (isset($_GET['edit'])) {
        $producto = $prod->get($_GET['edit']);
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
                echo "Modificar Producto";
            } else {
                echo "Nuevo Producto";
            } ?>
        </h1>

        <div class="col-md-1"></div>
        <form action="productos.php" method="post" class="col-md-10 from-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder=""
                        value="<?php echo (isset($producto->nombre) ? $producto->nombre : ''); ?>">
                    <br>
                </div>
            </div>

            <div class="form-group">
                <label for="modelo" class="col-sm-2 control-label">Modelo </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="modelo" name="modelo" placeholder=""
                        value="<?php echo (isset($producto->modelo) ? $producto->modelo : ''); ?>">
                    <br>
                </div>
            </div>

            <div class="form-group"><label for="id_marca" class="col-sm-2 control-label">Marca</label>
                <div class="col-sm-10 col-md-4">
                    <select name="id_marca" id="id_marca">
                        <option value="">Elige una opción</option>
                        <?php  foreach($prod->getListMarca() as $t){?>
                        <option value="<?php echo $t['id_marca']?>" <?php 
									if(isset($producto->id_marca)){
										if($t['id_marca'] == $producto->id_marca){
											echo ' selected="selected" ';
										}
									}          
                                    ?>><?php echo $t['nombre']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            <div class="form-group"><label for="id_categoria" class="col-sm-2 control-label">Categoria</label>
                <div class="col-sm-10 col-md-4">
                    <select name="id_categoria" id="id_categoria">
                        <option value="">Elige una opción</option>
                        <?php  foreach($prod->getListCategoria() as $r){?>
                        <option value="<?php echo $r['id_categoria']?>" <?php 
									if(isset($producto->id_categoria)){
										if($r['id_categoria'] == $producto->id_categoria){
											echo ' selected="selected" ';
										}
									}          
                                    ?>><?php echo $r['nombre']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>



            <label for="imagen" class="col-sm-2 control-label">Imagen</label>
            <div class="container">
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="row">
                            <?php if (isset($producto->img)){?>
                            <div class="col-md-3">
                                <td class="p-3"><img width="85" height="85" src="../imagenes/productos/<?php echo $producto->img ?>"></td>
                            </div>
                            <?php } ?>
                            <div class="col-sm-10 col-md-9">
                                <label for="img">Upload Image 1</label>
                                <input type="file" class="form-control-file" name="img" id="img">
                                <small class="form-text text-muted">La imagen debe ser de 1000px x 1000px. El formato
                                    debe
                                    ser <b>JPG</b></small>
                            </div>
                        </div>
                        <div class="row">
                            <?php if (isset($producto->img2)){?>
                            <div class="col-md-3">
                                <td class="p-3"><img width="85" height="85" src="../imagenes/productos/<?php echo $producto->img2 ?>"></td>
                            </div>
                            <?php } ?>
                            <div class="col-md-9">
                                <label for="img2">Upload Image 2</label>
                                <input type="file" class="form-control-file" name="img2" id="img2">
                                <small class="form-text text-muted">La imagen debe ser de 1000px x 1000px. El formato
                                    debe
                                    ser <b>JPG</b></small>
                            </div>
                        </div>
                        <div class="row">
                            <?php if (isset($producto->img3)){?>
                            <div class="col-md-3">
                                <td class="p-3"><img width="85" height="85" src="../imagenes/productos/<?php echo $producto->img3 ?>"></td>
                            </div>
                            <?php } ?>
                            <div class="col-md-9">
                                <label for="img3">Upload Image 3</label>
                                <input type="file" class="form-control-file" name="img3" id="img3">
                                <small class="form-text text-muted">La imagen debe ser de 1000px x 1000px. El formato
                                    debe
                                    ser <b>JPG</b></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>



            <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>

                <div class="col-sm-10">
                    <textarea class="form-control" id="descripcion" name="descripcion" 
                    rows="10"><?= (isset($producto->descripcion) ? trim($producto->descripcion) : ''); ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label for="habilitado" class="control-label">
                            <?php if(isset($producto->habilitado)) {
                                    if($producto->habilitado == 1) {
                                        echo '<input type="checkbox" name="habilitado" value="0">';
                                        echo "Deshabilitar";
                                    }else{
                                        echo '<input type="checkbox" name="habilitado" value="1">';
                                        echo "Habilitar";
                                    }
                                }else{
                                    echo '<input type="hidden" name="habilitado" value="1" checked >';
                                    echo "<p>Las productos nuevos, se habilitan por defecto.</p>";
                                } ?>
                        </label>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" name="formulario_productos">Guardar</button>
                </div>
            </div>
            <input type="hidden" class="form-control" id="id_producto" name="id_producto" placeholder=""
                value="<?php echo (isset($producto->id_producto) ? $producto->id_producto : ''); ?>">

    </div>

    </form>
</div>




<?php include('inc/footer.php'); ?>