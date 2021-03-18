<?php



function printCat($con, $id_padre = 0){
    $sql = 'SELECT * FROM categorias WHERE habilitado = 1 AND id_padre = '.$id_padre;
    $resultado = $con->query($sql);
    
    if(!empty($resultado)){
        $salida = '' ;
        
        foreach($resultado as $row){
            
            if (empty($_GET['marca'])) {
                if (empty($_GET['orden'])) {
                $link = 'index.php?seccion=product&idcatp='.$id_padre.'&idcat=' . $row['id_categoria']; 
                }else { $link = 'index.php?seccion=product&idcatp='.$id_padre.'&idcat=' . $row['id_categoria'].'&orden='.$_GET['orden']; }
            }else{    
                $link = 'index.php?seccion=product&idcatp='.$id_padre.'&idcat=' . $row['id_categoria'] . '&marca=' . $_GET['marca'];              
            }
        

            $salida.= 	'<div class="">
                            <a href="' . $link . '" .  
                            id="category-'. $row['id_categoria']  .'">
                                <label for="category-'. $row['id_categoria'] .'">
                                    <span></span>' . 
                                    $row['nombre'] .
                                    '<div class="input-checkbox">'
                                       . printCat($con, $row['id_categoria']) .
                                    '</div>
                                </label></a>
                        </div>';
            }
            $salida.= '';
        }
        return $salida;
}


function printCatHome($con,  $id_padre = 0){
    
    $sql = 'SELECT * FROM categorias WHERE habilitado = 1 AND id_padre = '.$id_padre;
    $resultado = $con->query($sql);
    
    if(!empty($resultado)){
        $salida = '' ;
        
        foreach($resultado as $row){
           
            $salida.= '<div class="col-md-3 col-xs-6">
                        <div class="shop">
                        <div class="shop-img">
                        <img src="./imagenes/categorias/'.$row['img'].'" alt="">
                        </div>
                            <div class="shop-body">
                            <h3>'.$row['nombre'].'<br>Collection</h3>
                        <a href="index.php?seccion=product&idcatp=0&idcat='.$row['id_categoria'].'" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>';
        }
        $salida.= '';
}
                return $salida;
}


function printMarca($con, $sql){

    $marca =' GROUP BY productos.id_marca';
    $sql .= $marca;

    $resultado = $con->query($sql);
    
    if(!empty($resultado)){
        $salida = '' ;

        $cont = 0; 
        
        foreach($resultado as $row){
       
          
            if (empty($_GET['idcat'])) { 
                if (empty($_GET['orden'])) {
                    $link = 'index.php?seccion=product&marca=' . $row['id_marca'];
                }else{ 
                    $link = 'index.php?seccion=product&marca=' . $row['id_marca'].'&orden='.$_GET['orden']; } 
            }else{    
                $link = 'index.php?seccion=product&idcat=' . $_GET['idcat'] . '&marca=' . $row['id_marca'];              
            }
            
            
            $salida.= '<div class="input-checkbox">
                            <a href="' . $link . '" id="brand-' . $row['nombreM'] . '">                               
                                <label for="brand-' . $row['nombreM'] . '">
                                    <span></span>
                                    ' . $row['nombreM'] . '
                                    <small></small>
                                </label></a>
                                </div>';    
                  
        }  
        
        $salida.='';

        return $salida;

    }

}


function printProduct($con, $sql){
        
    $resultado = $con->query($sql)->fetchAll();
    //echo '<pre>' , var_dump($resultado) , '</pre>';
    
  
    if(count($resultado) > 0){
        $salida = '' ;
        $cont = 1;
        
    
        foreach($resultado as $row ){
        
            $price=rand(1000,10000).'.99';
        
            
            $cont++;
            
            $salida.='<div class="col-12 col-md-6 col-lg-4 mb-5 mb-md-3">
            <div class="product" >
            <div class="product-img">
                                            <img src="./imagenes/productos/'. $row['img'] . '"alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">' . $row['nombre'] . '</p>
                                            <h3 class="product-name"><a href="index.php?seccion=items&id=' . $row['id_producto'] . '">' . $row['modelo'] . '</a></h3>
                                            <h4 class="product-price">$ '.$price.'</h4>
                                            <div class="product-rating">.'                            
                                            .str_repeat("<i class='fa fa-star'></i> ",round($row['promedio'])).str_repeat("<i class='fa fa-star-o'></i> ",5-round($row['promedio'])).'

            
                                         
                                           
                                        </div>
                                            
                                        </div>
                                        <div class="add-to-cart">
            

                                            <a href="index.php?seccion=items&id=' . $row['id_producto'] . '&p='.$price.'" class="add-to-cart-btn"><i class="fa fa-hand-o-right"></i>Ver más</a>
                                        
                                        </div>
                                   </div>
                    </div>';
            
        }
    
        return $salida;
    }else {
        $salida = '<b>No se encontraron productos para esta busqueda</b>' ;
        return $salida;
    }
}

function printItem($con, $id){
    $sql = 'SELECT * FROM web.productos WHERE id='.$id;
    $resultado = $con->query($sql);

    return $resultado;

}


function printProductFiltered($con, $sql, $limite){
    
    $resultado = $con->query($sql);
    
    if($limite!="0"){
        
        
    if(!empty($resultado)){
        $salida = '' ;
        
        $cont=0;

        do{
        foreach($resultado as $row){
            
            
                    
            $cont++;
            
            $salida.='<div class="col-12 col-md-6 col-lg-4 mb-5 mb-md-3">
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="./imagenes/productos/'. $row['img'] .'"width="210" height="210" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">' . $row['nombre'] . '</p>
                                            <h3 class="product-name"><a href="index.php?seccion=items&id=' . $row['id_producto'] . '">' . $row['modelo'] . '</a></h3>
                                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            
                                        </div>
                                        <div class="add-to-cart">
                                        
                                            <a href="index.php?seccion=items&id=' . $row['id_producto'] . '" class="add-to-cart-btn"><i class="fa fa-hand-o-right"></i>Ver más</a>
                                        
                                        </div>
                                    </div>
                    </div>';
     } }while($cont<=$limite); }                
    }
    return $salida;
}


    function printCom($con,$id){

      
        $sql = "SELECT * FROM web.ranking
        WHERE id_producto =$id and habilitado=1";

      
       $resultado = $con->query($sql);

       $cuenta = $resultado->rowCount();

       $salida='';
       
       if($cuenta==0){
                  $salida.='<li>
                  <div class="review-heading">
                  <h5 class="name"></h5></div>
                  <div class="review-body">
                      <p>Todavía no hay comentarios. Sé el primero</p>
                  </div>
                  </li>';
              }else{
       
       foreach($resultado as $result){
           
                   
                   $salida.=' <li>
                                                           <div class="review-heading">
                                                               <h5 class="name">'.$result['usuario'].'</h5>
                                                               <p class="date">'.$result['date'].'</p>
                                                               <div class="review-rating">
                                                               '. str_repeat("<i class='fa fa-star'></i> ", round($result['valoracion'])).
   
                                                               str_repeat("<i class='fa fa-star-o'></i> ", 5-round($result['valoracion'])).'
   
                                                               </div>
                                                           </div>
                                                           <div class="review-body">
                                                               <p>'. $result['comentario'].'</p>
                                                           </div>
                                                           </li>';
                                         
                                  
                                                               
                }  } return $salida;
               
               
           
       }

       function printstars($con, $sql, $total) {
  
        $resultado = $con->query($sql);
        $salida='';
    
        foreach($resultado as $cont){
                                        
           $salida.='<li>
                    <div class="rating-stars">'.
                    str_repeat("<i class='fa fa-star'></i> ", round($cont['valoracion'])).
                    str_repeat("<i class='fa fa-star-o'></i> ", 5-round($cont['valoracion'])).'
                    </div>
                     <div class="rating-progress">
                    <div style="width:';
                if($total>0){
                    $salida.=(($cont['total']/ $total)*100);}
                    else{ $salida.='';}
                    
                    $salida.='%;"></div>
                    </div>
                    <span class="sum">'.$cont['total'].'</span>
                    </li>';
        } 
        return $salida;
    
    
    }            
     