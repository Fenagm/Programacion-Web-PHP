<?php 
require('inc/header.php');
require('clases/comentarios.php')
?>

<div class="container-fluid">

    <?php $comentariosMenu = 'Comentarios';

$coment = new Comentario($con);

       
	   if( !in_array('coment.del',$_SESSION['usuario']['permisos']) &&		
        !in_array('coment.edit',$_SESSION['usuario']['permisos']) &&
        !in_array('coment.see',$_SESSION['usuario']['permisos'])){ 
        header('Location: index.php');
     }


      include('inc/side_bar.php');

      //var_dump($_POST);
      //die;


      if(isset($_POST['formulario_comentarios'])){ 
          if($_POST['id_ranking'] > 0){
              $coment->edit($_POST);         
          }else{
              $coment->save($_POST); 
          }

      //header('Location: comentarios.php');
      }	


      if(isset($_GET['del'])){
            $coment->del($_GET['del']);
            header('Location: comentarios.php');

      }

	 
	
        ?>

    <div class="col-sm-9 col-md-10 main">

        <!--toggle sidebar button-->
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i
                    class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            <?php echo $comentariosMenu?>
        </h1>


        <h2 class="sub-header">Listado
            <?php if(in_array('coment.add',$_SESSION['usuario']['permisos'])){?>
            <a href="comentarios_ae.php"><button type="button" class="btn btn-success" title="Agregar">A</button></a></h2>
        <?php }?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Valoracion</th>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Modelo</th>
                        <th>Comentario</th>
                        <!--<th>Habilitado</th>-->
                        <?php if(in_array('coment.edit',$_SESSION['usuario']['permisos']) ||  
								in_array('coment.del',$_SESSION['usuario']['permisos'])){?>
                        <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php  	 
						foreach($coment->getList() as $comentario){?>

                    <tr>
                        <td><?php echo $comentario['id_ranking'];?></td>
                        <td><?php echo $comentario['valoracion'];?></td>
                        <td><?php echo $comentario['date'];?></td>
                        <td><?php echo $comentario['nombre'];?></td>
                        <td><?php echo $comentario['modelo'];?></td>
                        <td><?php echo $comentario['comentario'];?></td>
                        <!--<td><?php echo ($comentario['habilitado'] == 1)?'si':'no';?></td>-->
                        <td>
                            <?php if(in_array('coment.edit',$_SESSION['usuario']['permisos'])){?>
                            <a href="comentarios_ae.php?edit=<?php echo $comentario['id_ranking']?>"><button type="button"
                                    class="btn btn-info" title="Modificar">M</button></a>
                            <?php } ?>
                            <?php if(in_array('coment.del',$_SESSION['usuario']['permisos'])){?>
                            <a href="comentarios.php?del=<?php echo $comentario['id_ranking']?>"><button type="button"
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
</div>
<!--/.container-->

<?php include('inc/footer.php');?>