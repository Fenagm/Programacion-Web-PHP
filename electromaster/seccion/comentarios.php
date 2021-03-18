<?php 

require_once('../database/mysql-login.php');

$con = new PDO('mysql:host='.$hostname.';port='.$port.';dbname='.$database, $username, $password);

$id = $_POST['id'];
$nombre = $_POST['usuario'];
$comentario = $_POST['comentario'];
$valoracion = $_POST['valoracion'];
$email= $_POST['email'];
$p=$_POST['p'];

?>
Nombre: <?php echo $nombre ?>
<br>
Comentario: <?php echo $comentario?>
<br>

valor: <?php echo $valoracion?>
<br>

id: <?php echo $id?>
<br>

<?php $sql= "INSERT INTO web.ranking (usuario, comentario, valoracion, id_producto) VALUES('$nombre','$comentario',$valoracion,$id)";
            $con->exec($sql);
header('Location:../index.php?seccion=items&id='.$id.'&p='.$p);
