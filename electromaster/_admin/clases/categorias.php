<?php 
Class Categoria{

    /*conexion a la base*/
	private $con;
	
	
	public function __construct($con){
		$this->con = $con;
	}
        /**
        * Obtengo todos las categorias
        */
	public function getList(){
		$query = "SELECT * FROM web.categorias";
		$resultado = array();
		foreach($this->con->query($query) as $key=>$categoria){
			$resultado[$key] = $categoria;
        }     
       
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado;
       
	}
	
	/**
	* obtengo una categoria
	*/
	public function get($id){
	    $query = "SELECT *
		FROM web.categorias 
	    WHERE id_categoria = ".$id;
        $query = $this->con->query($query); 
			
		$categoria = $query->fetch(PDO::FETCH_OBJ);
			
					/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $categoria;
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
            $sql = "INSERT INTO categorias(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
			//echo $sql; die()
			$this->con->exec($sql);
			$id_categoria = $this->con->lastInsertId();
			
			$imagen1 = $this->img($id_categoria, "img");

			//var_dump($id_prod);
			//var_dump($_FILES);
			//var_dump($_POST);
			
			foreach($_POST as $key2 => $value2){
                if($value2 != null){
                    $columns2[]=$key2." = '".$value2."'"; 
                }
			}
			$query = "UPDATE categorias SET ".implode(',',$columns2)." WHERE id_categoria = ".$id_categoria;
			
			//var_dump($query);
			//die;

			$this->con->exec($query);

 			

	} 
	
	/**
	* Actualizo los datos en la base de datos
	*/
	public function edit($data){
	    $id = $data['id_categoria'];
	    unset($data['id_categoria']);
	    
		$cat = $this->get($id);
          
            foreach($data as $key => $value){
                if($value != null){
                    $columns[]=$key." = '".$value."'"; 
                }
            }
            $sql = "UPDATE web.categorias SET " .implode(", ",$columns) ." WHERE id_categoria = ".$id;
            //echo $sql; die();
            $this->con->exec($sql);
			
			
	} 


	/**
	* borrado de categoria
	*/
	
        public function del($id){
			$sql = "DELETE FROM categorias WHERE id_categoria = ".$id.';';
		

            $this->con->exec($sql);
        }
		
	
	
	public function img($id, $img){
	
		$ruta = "../imagenes/categorias";

		if(isset($_FILES["$img"]) && ($_FILES["$img"]["size"] > "0")){
			unset($_POST["$img"]);
			$archivo = "categoria-id=$id.jpg";
			$_POST["$img"] = $archivo;
			$ruta_completa = "$ruta/$archivo";
			if(file_exists($ruta_completa)){
				unlink($ruta_completa);
			}
			move_uploaded_file($_FILES["$img"]["tmp_name"],"$ruta_completa");			
			
		}
	}
}
	
	?>