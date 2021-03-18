<?php

class sqlProducto{
    var $con;

    function sqlProducto($con){
        $this->con = $con;
    }

    function getProductos($idPadre = 0){
        $sql = "SELECT * FROM categorias WHERE id_padre = ".$idPadre;
        return $this->con->query($sql, PDO::FETCH_ASSOC);
    }

    function setProducto($datos){ 
    }

    function getProducto($datos){ 
    }

    function delProducto($datos){ 
    }

}