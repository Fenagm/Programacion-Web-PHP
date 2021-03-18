<?php


$sql="SELECT DISTINCT *, ROUND(AVG(valoracion),1) AS promedio, COUNT(valoracion) AS destacado, 
productos.id_producto, productos.nombre, productos.descripcion, productos.modelo, productos.img,
productos.img2, productos.img3, marcas.id_marca, marcas.nombre AS nombreM,
categorias.id_categoria, categorias.id_padre, categorias.nombre 
FROM web.ranking
RIGHT JOIN web.productos ON ranking.id_producto = productos.id_producto
INNER JOIN web.categorias ON
    categorias.id_categoria = productos.id_categoria
INNER JOIN web.marcas ON
	productos.id_marca = marcas.id_marca
WHERE categorias.habilitado = 1 AND marcas.habilitado = 1 AND productos.habilitado = 1";



if(isset($_GET['idcatp'])&&isset($_GET['idcat']) && $_GET['idcatp']==0 ){

$idcatp=$_GET['idcatp'];

$idcat=$_GET['idcat'];


    $sql.=' AND categorias.id_padre='.$idcat;
    
    
    if(!empty($_GET['marca'])){
        $sql .= ' AND marcas.id_marca = '.$_GET['marca'];
    }
    }else{


if(!empty($_GET['marca'])){
    $sql .= ' AND marcas.id_marca = '.$_GET['marca'];
}
if(isset($_GET['idcat'])){
    $idcat=$_GET['idcat'];
    $sql .= ' AND categorias.id_categoria = '.$_GET['idcat'];}
}

if(isset($_GET['idcatp'])&&$_GET['idcatp']>0){
    $sql.=' AND categorias.id_padre='.$_GET['idcatp'];
}

$sqlMarca = $sql;

$sql .=' GROUP BY productos.id_producto';

if(isset($_GET['orden'])){
    if($_GET['orden'] == 'Destacados'){
        $sql .= ' ORDER BY destacado DESC';
    }
    if($_GET['orden'] == 'Ranqueados'){
        $sql .= ' ORDER BY promedio DESC';
    }
    if($_GET['orden'] == 'Z -> A' && empty($_GET['marca'])){
        
        $sql .=' ORDER BY modelo desc';
    }
    if($_GET['orden'] == 'A -> Z' && empty($_GET['marca'])){
        $sql .=' ORDER BY modelo asc';
    }
}
 



