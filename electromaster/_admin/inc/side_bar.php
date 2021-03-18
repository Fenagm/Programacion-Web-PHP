<div class="row row-offcanvas row-offcanvas-left">

    <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">

        <ul class="nav nav-sidebar">
            <li class="<?php echo isset($homeMenu)?'active':''?>"><a href="index.php">Home</a></li>
            <?php if(in_array('cat.add',$_SESSION['usuario']['permisos'])||
					in_array('cat.del',$_SESSION['usuario']['permisos'])||		
					in_array('cat.edit',$_SESSION['usuario']['permisos'])||
					in_array('cat.see',$_SESSION['usuario']['permisos'])){?>
            <li class="<?php echo isset($categoriasMenu)?'active':''?>"><a href="categorias.php">Categorias</a></li>
            <?php }?>
            <?php if(in_array('marc.add',$_SESSION['usuario']['permisos'])||
					in_array('marc.del',$_SESSION['usuario']['permisos'])||		
					in_array('marc.edit',$_SESSION['usuario']['permisos'])||
					in_array('marc.see',$_SESSION['usuario']['permisos'])){?>
            <li class="<?php echo isset($marcasMenu)?'active':''?>"><a href="marcas.php">Marcas</a></li>
            <?php }?>
            <?php if(in_array('prod.add',$_SESSION['usuario']['permisos'])||
					in_array('prod.del',$_SESSION['usuario']['permisos'])||		
					in_array('prod.edit',$_SESSION['usuario']['permisos'])||
					in_array('prod.see',$_SESSION['usuario']['permisos'])){?>
            <li class="<?php echo isset($productsMenu)?'active':''?>"><a href="productos.php">Productos</a></li>
            <?php }?>
            <?php if(in_array('coment.add',$_SESSION['usuario']['permisos'])||
					in_array('coment.del',$_SESSION['usuario']['permisos'])||		
					in_array('coment.edit',$_SESSION['usuario']['permisos'])||
					in_array('coment.see',$_SESSION['usuario']['permisos'])){?>
            <li class="<?php echo isset($comentariosMenu)?'active':''?>"><a href="comentarios.php">Comentarios</a></li>
            <?php }?>
            <?php if(in_array('user.add',$_SESSION['usuario']['permisos'])||
					in_array('user.del',$_SESSION['usuario']['permisos'])||		
					in_array('user.edit',$_SESSION['usuario']['permisos'])||
					in_array('user.see',$_SESSION['usuario']['permisos'])){?>
            <li class="<?php echo isset($userMenu)?'active':''?>"><a href="usuarios.php">Usuarios</a></li>
            <?php }?>
            <?php if(in_array('profile.add',$_SESSION['usuario']['permisos'])||
					in_array('profile.del',$_SESSION['usuario']['permisos'])||		
					in_array('profile.edit',$_SESSION['usuario']['permisos'])||
					in_array('profile.see',$_SESSION['usuario']['permisos'])){?>
            <li class="<?php echo isset($perfilMenu)?'active':'';?>"><a href="perfiles.php">Perfiles</a></li>
            <?php }?>
        </ul>
    </div>
