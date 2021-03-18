<?php 
Class Producto{

    /*conexion a la base*/
	private $con;
	
	
	public function __construct($con){
		$this->con = $con;
	}
	 
	/**
        * Obtengo todos los productos
        */
	public function getList(){
		$query = "SELECT *,marcas.nombre as marca,categorias.nombre as categoria,
		productos.nombre as nombre, productos.habilitado as habilitado
		FROM web.productos 
		INNER JOIN marcas 
		ON marcas.id_marca = productos.id_marca
		INNER JOIN categorias 
		ON categorias.id_categoria = productos.id_categoria";

		$resultado = array();

		
		foreach($this->con->query($query) as $key=>$producto){
			$resultado[$key] = $producto;
			
			
			
		}
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado; 
	}
	
	public function getListCategoria(){
		$query = "SELECT * FROM web.categorias WHERE id_padre not like 0";

		$resultado = array();

		
		foreach($this->con->query($query) as $key=>$producto){
			$resultado[$key] = $producto;
			
			
			
		}
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado; 
	}

	public function getListMarca(){
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
	* obtengo un producto
	*/
	public function get($id){
	    $query = "SELECT *,marcas.nombre as marca,categorias.nombre as categoria, 
		productos.nombre as nombre, productos.habilitado as habilitado, productos.img AS img
		FROM web.productos 
		INNER JOIN marcas 
		ON marcas.id_marca = productos.id_marca
		INNER JOIN categorias 
		ON categorias.id_categoria = productos.id_categoria WHERE id_producto = ".$id;
        $query = $this->con->query($query); 
			
		$producto = $query->fetch(PDO::FETCH_OBJ);
			
					/*echo '<pre>';
			var_dump($producto);echo '</pre>'; */
            return $producto;
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
			$sql = "INSERT INTO productos(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
			//var_dump ($sql); die();
			$this->con->exec($sql);
			
			$id_prod = $this->con->lastInsertId();
			
			$imagen1 = $this->img($id_prod, "img", 1);
			$imagen2 = $this->img($id_prod, "img2", 2);
			$imagen3 = $this->img($id_prod, "img3", 3);

			//var_dump($id_prod);
			//var_dump($_FILES);
			//var_dump($_POST);
			
			foreach($_POST as $key2 => $value2){
                if($value2 != null){
                    $columns2[]=$key2." = '".$value2."'"; 
                }
			}
			$query = "UPDATE productos SET ".implode(',',$columns2)." WHERE id_producto = ".$id_prod;
			
			//var_dump($query);
			//die;

			$this->con->exec($query);


	} 
	
	/**
	* Actualizo los datos en la base de datos
	*/
	public function edit($data){
		
		$id = $data['id_producto'];
		unset($data['id_producto']);
		
		//$sql = 'SELECT * FROM web.productos';
			
			//$prod = $this->get($id);
			
            foreach($data as $key => $value){
                if($value != null){
                    $columns[]=$key." = '".$value."'"; 
                }
			}
			
            $sql = "UPDATE productos SET ".implode(',',$columns)." WHERE id_producto = ".$id;
			
			//var_dump($sql);
			//die;

			$this->con->exec($sql);
			

			
	} 

	public function img($id, $img, $numImg){
	
		$ruta = "../imagenes/productos";

		if(isset($_FILES["$img"]) && ($_FILES["$img"]["size"] > "0")){
			unset($_POST["$img"]);
			$archivo = "producto-id=$id-$numImg.jpg";
			$_POST["$img"] = $archivo;
			$ruta_completa = "$ruta/$archivo";
			if(file_exists($ruta_completa)){
				unlink($ruta_completa);
			}
			move_uploaded_file($_FILES["$img"]["tmp_name"],"$ruta_completa");			
			
		}

		//var_dump($ruta_completa);
		//var_dump($_POST);
		//var_dump($archivo);
		//die;
	}

	/**
	* Borro los datos en la base de datos
	*/
        public function del($id){

			if(file_exists("../imagenes/productos/producto-id=$id-1.jpg")){	
				unlink("../imagenes/productos/producto-id=$id-1.jpg");
			}
			if(file_exists("../imagenes/productos/producto-id=$id-2.jpg")){
				unlink("../imagenes/productos/producto-id=$id-2.jpg");
			}
			if(file_exists("../imagenes/productos/producto-id=$id-3.jpg")){
				unlink("../imagenes/productos/producto-id=$id-3.jpg");
			}

			$sql = "DELETE FROM productos WHERE id_producto = ".$id.';';
			$this->con->exec($sql);

        }


	}?>