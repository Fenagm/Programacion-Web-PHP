<?php

if(isset($_SESSION["usuario"])):
        // volver atrás
        // $pagAnt = $_SERVER["HTTP_REFERER"];

        header("Location:index.php");
    endif;

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h2 class="text-center my-3">Registrate en nuestro sitio</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card bg-primary my-5">
                <div class="card-body border-white">
                    <form action="actions/registro.php" method="post">

                        <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario"  placeholder="Ingrese su usuario">
                        </div>

                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu email">
                        </div>

                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="************">
                        </div>

                        <button type="submit" class="btn btn-outline-light d-block m-auto">Registrarse</button>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</div>