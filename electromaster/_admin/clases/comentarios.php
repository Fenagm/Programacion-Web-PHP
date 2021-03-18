<?php 
Class Comentario{

    /*conexion a la base*/
	private $con;
	
	
	public function __construct($con){
		$this->con = $con;
	}
        /**
        * Obtengo todos los comentarios
        */
	public function getList($habilitado){
		$query = "SELECT *, productos.nombre AS nombre, productos.modelo AS modelo, ranking.habilitado AS habilitado
        FROM web.ranking
		INNER JOIN web.productos ON ranking.id_producto = productos.id_producto
		WHERE ranking.habilitado = " . $habilitado;
		$resultado = array();
		foreach($this->con->query($query) as $key=>$comentario){
			$resultado[$key] = $comentario;
        }     
       
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado;
       
	}
	
	/**
	* obtengo un comentario
	*/
	public function get($id){
	    $query = "SELECT *, productos.nombre AS nombre, ranking.habilitado AS habilitado
		FROM web.ranking
        INNER JOIN web.productos ON ranking.id_producto = productos.id_producto
        WHERE id_ranking = ".$id;
        $query = $this->con->query($query); 

        
		$comentario = $query->fetch(PDO::FETCH_OBJ);
        
        //var_dump($comentario);
					/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $comentario;
	}
	
	
	/**
	* Guardo los datos en la base de datos
	*/
	public function save($data){
            
            foreach($data as $key => $value){
				if(!is_array($value)){
					if($value != null){
						$columns[]=$key;
						$datos[]=$value;
					}
				}
            }
            $sql = "INSERT INTO comentarios(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
            $this->con->exec($sql);
			

	} 
	
	/**
	* Actualizo los datos en la base de datos
	*/
	public function edit($data){
	    $id = $data['id_ranking'];
	    unset($data['id_ranking']);
	    
		//$comentario = $this->get($id);
          
            foreach($data as $key => $value){
                if($value != null){
                    $columns[]=$key." = '".$value."'"; 
                }
            }
            $sql = "UPDATE web.ranking SET " .implode(", ",$columns) ." WHERE id_ranking = ".$id;
            //var_dump($sql);
            //die;
            //echo $sql; die();
            $this->con->exec($sql);
			
			
	} 


	/**
	* borrado de comentario
	*/
	
        public function del($id){
			$sql = "DELETE FROM web.ranking WHERE id_ranking = ".$id.';';
		

            $this->con->exec($sql);
        }
		
	}?>
