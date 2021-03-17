<div><?php
  
  if(isset($_SESSION["estado"])):
    $clase = $_SESSION["estado"] == "error" ? "danger" : "success";

    $respuesta = "<br><div class='alert alert-$clase alert-dismissible fade show' role='alert'><div class='row mx-4'>
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
?>

 <div class="row my-4 justify-content-end">
            <div class="col-auto">
                <a href="index.php?seccion=registrar_users" class="btn btn-success">Nuevo usuario</a>
            </div>
        </div>

    <table class="table table-bordered table-sm fs-90">
        <thead class="thead-light text-center">
            <tr>
              
                <th>E-mail</th>

                <th>Usuario</th>

                <th>Perfil</th>

                <th>Acciones</th>




            </tr>

        </thead>

        <tbody class="text-center bg-white">

            <?php
                                    $carpeta = "../users";

                                    $dir = opendir($carpeta);

                                       
                                    while($users = readdir($dir)):
                                        if($users == "." || $users == "..")
                                            continue;
                                ?>

            <tr>
                <td class="py-3"><?= ($users); ?></td>



                <td class="py-3"><?= file_get_contents("$carpeta/$users/usuario.txt") ?></td>

                <td class="py-3"><?= file_get_contents("$carpeta/$users/perfil.txt") ?></td>
                                                
                <td class="py-3">
                    <div class="dropdown">


                        <form action="acciones/eliminar_user.php" method="post">
                            <input type="hidden" name="email" value="<?= $users; ?>">
                            <p> <button type="submit" class="btn btn-danger">Borrar</button></p>
                        </form>
                        <a href="index.php?seccion=registrar_users&email=<?= $users; ?>">
                            <button type="submit" class="btn btn-warning">Editar</button></a>


                    </div>
                </td>
            </tr>
            <?php
                                        endwhile;
                                    ?>
        </tbody>
    </table>