

<?php 
require('inc/header.php');
require('clases/productos.php')
?>

<div class="container-fluid">

    <?php $productsMenu = 'Productos';

	 
	$prod=new Producto($con);

	if(  !in_array('prod.add',$_SESSION['usuario']['permisos']) &&
	!in_array('prod.del',$_SESSION['usuario']['permisos']) &&		
	!in_array('prod.edit',$_SESSION['usuario']['permisos']) &&
	!in_array('prod.see',$_SESSION['usuario']['permisos'])){ 
	  header('Location: index.php');
	}

	include('inc/side_bar.php');

	if(isset($_POST['formulario_productos'])){
                
        //var_dump($_FILES['img2']);
        //var_dump($_POST);
        //echo($_POST["img"]);
        //die; 
         
		if($_POST['id_producto'] > 0){
            $prod->img($_POST['id_producto'], "img", 1);
            $prod->img($_POST['id_producto'], "img2", 2);
            $prod->img($_POST['id_producto'], "img3", 3);
			$prod->edit($_POST); 
		}else{
			$prod->save($_POST); 
		}

	header('Location: productos.php');
	}	


	if(isset($_GET['del'])){
		   $prod->del($_GET['del']);
		   header('Location: productos.php');

	}

        ?>

    <div class="col-sm-9 col-md-10 main">

        <!--toggle sidebar button-->
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i
                    class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            <?php echo $productsMenu?>
        </h1>

        <h2 class="sub-header">Listado
            <?php if(in_array('prod.add',$_SESSION['usuario']['permisos'])){?>
            <a href="productos_ae.php"><button type="button" class="btn btn-success" title="Agregar">A</button></a>
            <?php }?>
        </h2>
        <div class="table-responsive">
            <table id="filtroTabla" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Categoria</th>
                        <th>Activo</th>
                        <?php if(in_array('prod.edit',$_SESSION['usuario']['permisos']) ||  
								in_array('prod.del',$_SESSION['usuario']['permisos'])){?>
                        <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php  	 
						foreach($prod->getList() as $producto){?>

                    <tr>
                        <td><?php echo $producto['id_producto'];?></td>
                        <td><?php echo $producto['nombre'];?></td>
                        <td><?php echo $producto['modelo'];?></td>
                        <td><?php echo $producto['marca'];?></td>
                        <td><?php echo $producto['categoria'];?></td>
                        <td><?php echo ($producto['habilitado'] == 1)?'si':'no';?></td>
                        <td>
                            <?php if(in_array('prod.edit',$_SESSION['usuario']['permisos'])){?>
                            <a href="productos_ae.php?edit=<?php echo $producto['id_producto']?>"><button type="button"
                                    class="btn btn-info" title="Modificar">M</button></a>
                            <?php }?>
                            <?php if(in_array('prod.edit',$_SESSION['usuario']['permisos'])){?>
                            <a href="productos.php?del=<?php echo $producto['id_producto']?>"><button type="button"
                                    class="btn btn-danger" title="Borrar">X</button></a>
                            <?php }?>
                        </td>
                        <?php } ?>
                    </tr>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
    <!--/row-->
</div>
<!--/.container-->
</div>

<?php include('inc/footer.php');?>

