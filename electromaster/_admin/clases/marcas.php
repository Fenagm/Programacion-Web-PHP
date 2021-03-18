<?php 
Class Marca{

    /*conexion a la base*/
	private $con;
	
	
	public function __construct($con){
		$this->con = $con;
	}
        /**
        * Obtengo todos las marcas
        */
	public function getList(){
		$query = "SELECT * FROM web.marcas";
		$resultado = array();
		foreach($this->con->query($query) as $key=>$marca){
			$resultado[$key] = $marca;
        }     
       
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado;
       
	}
	
	/**
	* obtengo una marcas
	*/
	public function get($id){
	    $query = "SELECT *
		FROM web.marcas 
	    WHERE id_marca = ".$id;
        $query = $this->con->query($query); 
			
		$marca = $query->fetch(PDO::FETCH_OBJ);
			
					/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $marca;
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
            $sql = "INSERT INTO marcas(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
            $this->con->exec($sql);
			

	} 
	
	/**
	* Actualizo los datos en la base de datos
	*/
	public function edit($data){
	    $id = $data['id_marca'];
	    unset($data['id_marca']);
	    
		$marc = $this->get($id);
          
            foreach($data as $key => $value){
                if($value != null){
                    $columns[]=$key." = '".$value."'"; 
                }
            }
            $sql = "UPDATE web.marcas SET " .implode(", ",$columns) ." WHERE id_marca = ".$id;
            //var_dump($data);
            //echo $sql; die();
            $this->con->exec($sql);
			
			
	} 


	/**
	* borrado de marca
	*/
	
        public function del($id){
			$sql = "DELETE FROM marcas WHERE id_marca = ".$id.';';
		

            $this->con->exec($sql);
        }
		
	}?>
