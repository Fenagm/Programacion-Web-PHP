<?php 
require('inc/header.php');
require('clases/categorias.php')
?>

<div class="container-fluid">

    <?php $categoriasMenu = 'Categorias';
      

$cat = new Categoria($con);

    if(  !in_array('cat.add',$_SESSION['usuario']['permisos']) &&
        !in_array('cat.del',$_SESSION['usuario']['permisos']) &&		
        !in_array('cat.edit',$_SESSION['usuario']['permisos']) &&
        !in_array('cat.see',$_SESSION['usuario']['permisos'])){ 
            header('Location: index.php');
    }   

    include('inc/side_bar.php');

    if(isset($_POST['formulario_categorias'])){ 
        if($_POST['id_categoria'] > 0){
            $cat->img($_POST['id_categoria'], "img");
            $cat->edit($_POST); 
                  
        }else{
            $cat->save($_POST); 
        }

        header('Location: categorias.php');
    }	


    if(isset($_GET['del'])){
        $cat->del($_GET['del']);
        header('Location: categorias.php');

    }

	 
	
        ?>

    <div class="col-sm-9 col-md-10 main">

        <!--toggle sidebar button-->
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i
                    class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            <?php echo $categoriasMenu?>
        </h1>


        <h2 class="sub-header">Listado
            <?php if(in_array('cat.add',$_SESSION['usuario']['permisos'])){?>
            <a href="categorias_ae.php"><button type="button" class="btn btn-success" title="Agregar">A</button></a>
        </h2>
        <?php }?>
        <div class="table-responsive">
            <table id="filtroTabla" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Categoria Superior</th>
                        <th>Activo</th>
                        <?php if(in_array('cat.edit',$_SESSION['usuario']['permisos']) ||  
								                in_array('cat.del',$_SESSION['usuario']['permisos'])){?>
                        <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php  	 
						foreach($cat->getList() as $categoria){?>

                    <tr>
                        <td><?php echo $categoria['id_categoria'];?></td>
                        <td><?php echo $categoria['nombre'];?></td>
                        <?php   if ($categoria['id_padre'] == 0){ 
                                $cat_superior = "--";
                           }else{
                                //var_dump($categoria['id_padre']);
                                $categoria2 = $cat->get($categoria['id_padre']); 
                                $cat_superior = $categoria2->nombre;
                            } ?>
                        <td><?php echo $cat_superior?></td>
                        <td><?php echo ($categoria['habilitado'] == 1)?'si':'no';?></td>

                        <td>
                            <?php if(in_array('cat.edit',$_SESSION['usuario']['permisos'])){?>
                            <a href="categorias_ae.php?edit=<?php echo $categoria['id_categoria']?>"><button
                                    type="button" class="btn btn-info" title="Modificar">M</button></a>
                            <?php } ?>
                            <?php if(in_array('cat.del',$_SESSION['usuario']['permisos'])){?>
                            <a href="categorias.php?del=<?php echo $categoria['id_categoria']?>"><button type="button"
                                    class="btn btn-danger" title="Borrar">X</button></a>
                            <?php } ?>
                        </td>
                        <?php } ?>
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