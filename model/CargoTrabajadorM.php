<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');


//Clase
class CargoTrabajadorM{

    private $id_cargo;
    private $nombre_cargo;
    private $cantidad_cargos;
    private $cargos;
    


    //Constructor
    function __construct() {
    }
    

	public function getId_cargo(){
		return $this->id_cargo;
	}

	public function setId_cargo($id_cargo){
		$this->id_cargo = $id_cargo;
	}

	public function getNombre_cargo(){
		return $this->nombre_cargo;
	}

	public function setNombre_cargo($nombre_cargo){
		$this->nombre_cargo = $nombre_cargo;
	}

	public function getCantidad_cargos(){
		return $this->cantidad_cargos;
	}

	public function setCantidad_cargos($cantidad_cargos){
		$this->cantidad_cargos = $cantidad_cargos;
	}
    public function getCargo(){
		return $this->cargo;
	}

	public function setCargo($cargo){
		$this->cargo = $cargo;
    }
    
    public function listar_cargos() {		
		$this->cargo = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM cargo";
			$consulta = $conn->prepare($sql);					
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->cargo, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}// Cierra listar_trabajador


}// Cierra clase CargoTrabajadorM.php