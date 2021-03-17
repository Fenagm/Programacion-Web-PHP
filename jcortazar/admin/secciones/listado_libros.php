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





    <table class="table table-bordered table-sm fs-90">
        <thead class="thead-light text-center">
            <tr>

                <th>Titulo</th>

                <th>Imágen</th>

                <th>Descripción</th>

                <th>Accion</th>




            </tr>

        </thead>

        <tbody class="text-center bg-white">

            <?php
                                    $carpeta = "../libros";

                                    $dir = opendir($carpeta);

                                       
                                    while($libros = readdir($dir)):
                                        if($libros == "." || $libros == "..")
                                            continue;
                                ?>

            <tr>
                <td class="py-5"><?= titulo($libros); ?></td>



                <td class="py-3"><img width="85" src="<?= "$carpeta/$libros/$libros.jpg" ?>" alt="<?= $libros; ?>"></td>

                <td class="py-5"><?= 
                                                $desc=(file_get_contents("$carpeta/$libros/descripcion.txt"));
                                            if(empty($desc)){
                                                  echo $mensaje="Sin Descripción";}
                                                    else{
                                                        $mensaje = nl2br($desc);}
                                                                                       
                                             ?></td>
                <td class="py-3">
                    <div class="dropdown">


                        <form action="acciones/eliminar_libro.php" method="post">
                            <input type="hidden" name="libros" value="<?= $libros; ?>">
                            <p> <button type="submit" class="btn btn-danger">Borrar</button></p>
                        </form>
                        <a href="index.php?seccion=registrar_libros&libro=<?= $libros; ?>">
                            <button type="submit" class="btn btn-warning">Editar</button></a>


                    </div>
                </td>
            </tr>
            <?php
                                        endwhile;
                                    ?>
        </tbody>
    </table>