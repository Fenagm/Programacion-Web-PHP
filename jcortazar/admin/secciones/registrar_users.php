<?php
require_once("../secciones/funcion.php");
require_once("../secciones/config.php");
require_once("../secciones/arrays.php");

/*----------------------------------------------------------------MENSAJES----------------------------------*/  
if(isset($_SESSION["estado"])):
  $clase = $_SESSION["estado"] == "error" ? "danger" : "success";

  $respuesta = "<br><div class='alert alert-$clase 'alert-dismissible fade show' role='alert'><div class='row mx-4'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
      <span class='sr-only'>Close</span>
  </button>
  <strong></strong> $_SESSION[mensaje]
</div></div>";

  

  unset($_SESSION["estado"]);
else:
  $respuesta = false;
endif;

echo $respuesta;




/*----------------------------------------------------------------REGISTRAR/MODIFICAR SELECTOR----------------------------------*/  
if(!empty($_GET["email"])) :
        
  $titulo = "Modificar Perfil de Usuario";
  $accion = "acciones/editar_user.php";
  

  $email=$_GET["email"];

  if(!is_dir("../users/$email")):
     //error user no existe;
      die();
  endif;

  $perfil = file_get_contents("../users/$email/perfil.txt");
  $usuario= file_get_contents("../users/$email/usuario.txt");
  $pass="";
  $emailviejo=$_GET["email"];
  $usuarioviejo= $usuario;
  $useractivo=$_SESSION['usuario']["email"];
 

else:

  $titulo = "Registrar nuevo usuario";    
  $accion = "acciones/new_user.php";

  $usuario="";
  $email="";
  $pass="";
  $perfil="";
  $useractivo="";
endif;

/*---------------------------------------------------------------- FORMULARIO ----------------------------------*/  
?>
<div class="container">
    <div class="card-body">
        <form action=<?=$accion?> method="post" enctype="multipart/form-data">
            <p class="text-centre">
                <h1 class="text-center"><?=$titulo?></h1>
                <hr>
            </p>


            <form>
  <div class="form-group">
  <input type="hidden" id="emailviejo" name="emailviejo"  value= "<?= $emailviejo; ?>">
  <input type="hidden" id="emailviejo" name="usuarioviejo"  value= "<?= $usuarioviejo; ?>">  

    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" value= "<?= $email; ?>" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Ingrese email">

    <div class="form-group">
    <label for="text">Usuario</label>
    <input type="text" class="form-control" id="username" value="<?=$usuario?>" name="usuario" placeholder="Ingrese usuario">
    
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" value="<?=$pass?>" id="exampleInputPassword1" name="password" placeholder="**********"
  <?php if ($useractivo!=$email):
   ?>readonly<?php else:
     ""; endif;?>>
  </div>

  <label>Perfil</label>
  
  <div class="form-check">
  <input class="form-check-input" type="radio" name="perfil" id="perfil2" value="admin" <?php if ($perfil=="usuario"): ?>checked<?php else:""; endif;?>>
  <label class="form-check-label" for="perfil2">
    Usuario
  </label>
</div>


<div class="form-check">
  <input class="form-check-input" type="radio" name="perfil" id="perfil2" value="admin" <?php if ($perfil=="admin"): ?>checked<?php else:""; endif;?>>
  <label class="form-check-label" for="perfil2">
    Administrador
  </label>
</div>

<br>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</div>
</div>
</div>
</div>

</div>