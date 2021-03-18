<?php 
require('inc/header.php');
require('helpers/arrays.php');

//include('clases/usuarios.php');
?>

<div class="container-fluid">

    <?php $userMenu = 'Usuarios';
	include('inc/side_bar.php');
	
	$perfil = new Perfil($con); 
	
	if(isset($_GET['edit'])){
            $usuario = $user->get($_GET['edit']); 
	} 
	?>

    <div class="col-sm-9 col-md-10 main">

        <!--toggle sidebar button-->
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i
                    class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <h1 class="page-header">
            Modificando <?php echo isset($usuario->nombre)?$usuario->nombre:'';?>
        </h1>

        <div class="col-md-2"></div>
        <form action="index.php" method="post" class="col-md-6 from-horizontal">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label text-center">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder=""
                        value="<?php echo isset($usuario->nombre)?$usuario->nombre:'';?>">
                    <br>
                </div>
            </div>
            <div class="form-group">
                <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder=""
                        value="<?php echo isset($usuario->apellido)?$usuario->apellido:'';?>">
                    <br>
                </div>
            </div>
            <div class="form-group">
                <label for="usuario" class="col-sm-2 control-label">Usuario</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder=""
                        value="<?php echo isset($usuario->usuario)?$usuario->usuario:'';?>" readonly="readonly">
                    <br>
                </div>
            </div>

            <div class="form-group"><label for="avatar" class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                    <button type="button" class="btn btn-default dropdown-toggle btn-avatar" data-toggle="dropdown">
                        Seleccione su Avatar...
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-center avatar">
                        <?php foreach($avatars as $t){?>
                        <label class="col-md-4">
                            <input class="col-2" type="radio" name="avatar" id="avatar" 
                            value="<?php echo $t ?>" <?php if($usuario->avatar == $t){ echo 'checked'; }?>>
                            <img class="col-10" src="../imagenes/avatars/<?php echo $t ?>" width="50" height="50">
                        </label>
                        <?php } ?>
                    </ul>
                </div>
            </div> 

            <div class="form-group">
              
                <label for="email" class="col-sm-2 control-label">e-Mail</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder=""
                        value="<?php echo isset($usuario->email)?$usuario->email:'';?>" readonly="readonly">
                    <br>
                </div>
            </div>
            <div class="form-group">
                <label for="clave" class="col-sm-2 control-label">Clave</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="clave" name="clave" placeholder="">
                    <br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" name="edit_user">Guardar</button>
                </div>
            </div>
            <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" placeholder=""
                value="<?php echo isset($usuario->id_usuario)?$usuario->id_usuario:'';?>">
        </form>
    </div>
</div>

<?php include('inc/footer.php');?>