<?php

class Conexion{

	private $conexion;

	function __construct(){

		$host = "localhost";
		$user = "milart";
		$pass = "12345";
		$bd = "milart";

		$conect = new mysqli($host, $user, $pass, $bd);

		if($conect->connect_error){
			die("Error al conectar con la BD");
		}
		else{
			$this->conexion = $conect;
			$this->conexion->query("set names 'utf8'");
		}

	}

	public function getConexion(){
		return $this->conexion;
	}

}

class Productos{

	private $sql;

	function __construct(){

		$obj = new Conexion();
		$this->sql = $obj->getConexion();

	}

	public function getProductos(){

		$consulta = $this->sql->query("select * from productos");

		if($consulta->num_rows > 0){
			$datos = array();
			while($fila = $consulta->fetch_object()){
				$aux = array(
					"idProducto"  => $fila->id,
					"nombre" => $fila->nombre,
					"descripcion" => $fila->descripcion,
					"img" => $fila->img,
				);
				
				array_push($datos, $aux);
			}
		}
		else{
			$datos = false;
		}

		return $datos;
		
		$this->sql->close();

	}
	
	public function getUnProducto($id){
		
		$consulta = $this->sql->query("select * from productos where id = '$id'");
		
		if($consulta->num_rows == 1){
			return $consulta;
		}
		else{
			return false;	
		}
		
		$this->sql->close();
		
	}

}

?>