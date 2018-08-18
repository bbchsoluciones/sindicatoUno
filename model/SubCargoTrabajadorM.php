<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');


//Clase
class SubCargoTrabajadorM{

    private $id_sub_cargo;
    private $nombre_subcargo;
    private $cantidad_subcargos;
    private $subcargo;
    


    //Constructor
    function __construct() {
    }
    
    public function getId_sub_cargo(){
		return $this->id_sub_cargo;
	}

	public function setId_sub_cargo($id_sub_cargo){
		$this->id_sub_cargo = $id_sub_cargo;
	}

	public function getNombre_subcargo(){
		return $this->nombre_subcargo;
	}

	public function setNombre_subcargo($nombre_subcargo){
		$this->nombre_subcargo = $nombre_subcargo;
	}

	public function getCantidad_subcargos(){
		return $this->cantidad_subcargos;
	}

	public function setCantidad_subcargos($cantidad_subcargos){
		$this->cantidad_subcargos = $cantidad_subcargos;
	}

	public function getSubcargo(){
		return $this->subcargo;
	}

	public function setSubcargo($subcargo){
		$this->subcargo = $subcargo;
	}

	
    
    public function listar_subcargos() {		
        $this->subcargo = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM sub_cargo WHERE cargo_id_cargo=:id";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id', $this->id_sub_cargo); 					
			$consulta->execute();
            $resultado = $consulta->fetchAll();
            foreach($resultado as $registros):
                array_push($this->subcargo, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}


}// Cierra clase CargoTrabajadorM.php