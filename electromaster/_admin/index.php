<?php include('inc/header.php')?>

<?php $homeMenu = 'Home'; ?>

<div class="container-fluid">

    <?php include('inc/side_bar.php');
    
    //var_dump($_POST);
    //die;

	if(isset($_POST['edit_user'])){ 
	    if($_POST['id_usuario'] > 0){
                $user->edit_user($_POST); 
        }
        header('Location: index.php');
    }
    
    ?>

    <div class="col-sm-9 col-md-10 main">

        <!--toggle sidebar button-->
        <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i
                    class="glyphicon glyphicon-chevron-left"></i></button>
        </p>

        <div class="col-12">
            <iframe class="frame" src="http://localhost/electromaster" marginwidth="0" marginheight="0"
                name="ventana_iframe" scrolling="si" border="0" frameborder="0">
            </iframe>
        </div>


    </div>
    <!--/row-->
</div>

<!--/.container-->
</div>
<?php include('inc/footer.php');?>