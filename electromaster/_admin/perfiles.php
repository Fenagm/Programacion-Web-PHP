<?php 
require('inc/header.php'); 
//require('clases/perfil.php');
?>

<div class="container-fluid">

    <?php $perfilMenu = 'Perfiles';
	  
	 $perfiles = new Perfil($con);
	include('inc/side_bar.php');
	 
	 
	if(isset($_POST['formulario_perfiles'])){ 
	    if($_POST['id'] > 0){
                $perfiles->edit($_POST); 
               
	    }else{
			
                $perfiles->save($_POST); 
        }
		
		header('Location: perfiles.php');
	}	
	 
	if(isset($_GET['del'])){
			$resp = $perfiles->del($_GET['del']) 	;
            if($resp == 1){
				header('Location: perfiles.php');	
			}
			echo '<script>alert("'.$resp.'");</script>';

	}
	

        ?>



    <div class="col-sm-9 col-md-10 main">

        <!--toggle sidebar button-->
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i
                    class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            Perfiles
        </h1>

        <h2 class="sub-header">Listado
            <?php if(in_array('profile.add',$_SESSION['usuario']['permisos'])){?>
            <a href="perfiles_ae.php"><button type="button" class="btn btn-success" title="Agregar">A</button></a>
            <?php }?>
        </h2>
        <div class="table-responsive">
            <table id="filtroTabla" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <?php if(in_array('profile.edit',$_SESSION['usuario']['permisos']) || 
								in_array('profile.del',$_SESSION['usuario']['permisos'])){?>
                        <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php  	 
					foreach($perfiles->getList() as $perfil){?>

                    <tr>
                        <td><?php echo $perfil['id'];?></td>
                        <td><?php echo $perfil['nombre'];?></td>
                        <td>
                            <?php if(in_array('profile.edit',$_SESSION['usuario']['permisos'])){?>
                            <a href="perfiles_ae.php?edit=<?php echo $perfil['id']?>"><button type="button"
                                    class="btn btn-info" title="Modificar">M</button></a>
                            <?php }?>
                            <?php if(in_array('profile.edit',$_SESSION['usuario']['permisos'])){?>
                            <a href="perfiles.php?del=<?php echo $perfil['id']?>"><button type="button"
                                    class="btn btn-danger" title="Borrar">X</button></a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/row-->
</div>
<!--/.container-->
</div>

<?php include('inc/footer.php');?>