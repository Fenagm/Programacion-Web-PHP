<?php 
require('inc/header.php');
require('clases/marcas.php')
?>

<div class="container-fluid">

    <?php $marcasMenu = 'Marcas';

$marc = new Marca($con);

       
	   if(!in_array('marc.add',$_SESSION['usuario']['permisos']) &&
     !in_array('marc.del',$_SESSION['usuario']['permisos']) &&		
     !in_array('marc.edit',$_SESSION['usuario']['permisos']) &&
     !in_array('marc.see',$_SESSION['usuario']['permisos'])){ 
       header('Location:index.php');
     }


      include('inc/side_bar.php');

      if(isset($_POST['formulario_marcas'])){ 
          if($_POST['id_marca'] > 0){
              $marc->edit($_POST); 
                  
          }else{
              $marc->save($_POST); 
          }
        header('Location:marcas.php');
      }	


      if(isset($_GET['del'])){
            $marc->del($_GET['del']);

            header('Location:marcas.php');

      }

	 
	
        ?>

    <div class="col-sm-9 col-md-10 main">

        <!--toggle sidebar button-->
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i
                    class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            <?php echo $marcasMenu?>
        </h1>


        <h2 class="sub-header">Listado
            <?php if(in_array('marc.add',$_SESSION['usuario']['permisos'])){?>
            <a href="marcas_ae.php"><button type="button" class="btn btn-success" title="Agregar">A</button></a></h2>
        <?php }?>
        <div class="table-responsive">
            <table id="filtroTabla" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Activo</th>
                        <?php if(in_array('marc.edit',$_SESSION['usuario']['permisos']) ||  
								in_array('marc.del',$_SESSION['usuario']['permisos'])){?>
                        <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php  	 
						foreach($marc->getList() as $marca){?>

                    <tr>
                        <td><?php echo $marca['id_marca'];?></td>
                        <td><?php echo $marca['nombre'];?></td>
                        <td><?php echo ($marca['habilitado'] == 1)?'si':'no';?></td>
                        <td>
                            <?php if(in_array('marc.edit',$_SESSION['usuario']['permisos'])){?>
                            <a href="marcas_ae.php?edit=<?php echo $marca['id_marca']?>"><button type="button"
                                    class="btn btn-info" title="Modificar">M</button></a>
                            <?php } ?>
                            <?php if(in_array('marc.del',$_SESSION['usuario']['permisos'])){?>
                            <a href="marcas.php?del=<?php echo $marca['id_marca']?>"><button type="button"
                                    class="btn btn-danger" title="Borrar">X</button></a>
                            <?php } ?>
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