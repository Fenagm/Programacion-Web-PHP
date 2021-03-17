<?php

    if(isset($_SESSION["usuario"])):

        header("Location:index.php");
    endif;

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <h2 class="text-center my-3">Iniciá sesión</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card bg-primary my-5">
                <div class="card-body border-white">
                    <form action="actions/login.php" method="post">

                        <div class="form-group">
                        <label for="usuario">Usuario o Email</label>
                        <input type="text" class="form-control" name="usuario" id="usuario"  placeholder="Ingrese su usuario o email">
                        </div>

                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="************">
                        </div>

                        <button type="submit" class="btn btn-outline-light d-block m-auto">Ingresar</button>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</div>