<!DOCTYPE html>
<?php  session_start();
include('../database/mysql-login.php');

include('clases/usuarios.php');
include('clases/perfil.php');


try {
        $con = new PDO('mysql:host='.$hostname.';port='.$port.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
        print "�Error!: " . $e->getMessage();
        die();
}


$user = new Usuario($con);

if(isset($_POST['login'])){
	$user->login($_POST);
}
 
if(isset($_GET['logout'])){
    unset($_SESSION['usuario']); 

}
	
if($user->notLogged()){
	 header('Location: login.php');
}
?>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Electro-Admin</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="barra">
                    <a class="navbar-brand"
                        href="usuarios_edit.php?edit=<?php echo $_SESSION['usuario']['id_usuario']?>">
                        <?php if($_SESSION['usuario']['avatar'] == ''){
                            $avatar = 'default.png';
                        }else{
                            $avatar = $_SESSION['usuario']['avatar'];
                        }?>
                        <img width="35" height="35" src="../imagenes/avatars/<?php echo $avatar?>">
                    </a>
                    <p class="h3 user"><?php echo $_SESSION['usuario']['nombre']?></p>
                </div>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div class="btn-group perfil">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                Profile
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu text-center">
                                <li><img width="85" height="85" src="../imagenes/avatars/<?php echo $avatar?>"></li>
                                <li class="divider"></li>
                                <li><a>User: <?php echo $_SESSION['usuario']['usuario']?></a></li>
                                <li class="divider"></li>
                                <li class="bg-info"><a
                                        href="usuarios_edit.php?edit=<?php echo $_SESSION['usuario']['id_usuario']?>">Ver
                                        Perfil</a></li>
                                <li class="divider"></li>
                                <li class="bg-danger"><a href="?logout">logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>