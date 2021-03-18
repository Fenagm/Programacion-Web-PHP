<?php 

require_once('../database/mysql-login.php');
$con = new PDO('mysql:host='.$hostname.';port='.$port.';dbname='.$database, $username, $password);

sleep(1);
if (isset($_POST)) {
    $usuario = (string)$_POST['usuario'];
 
    $result = $con->prepare("SELECT count(usuario) as c FROM ranking WHERE usuario ='$usuario'");
    $result->execute();
    $result = $result->fetch(PDO::FETCH_ASSOC);

    if ($result['c'] > 0) {
        echo '<div class="alert alert-danger"><strong>Oh no!</strong> Nombre de usuario no disponible.</div>';
    } else {
        echo '<div class="alert alert-success"><strong>Enhorabuena!</strong> Usuario disponible.</div>';
    }
}