<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');


//Clase
class ProvinciaM{

    private $id_provincia;
    private $region_id_region;
    private $nombre_provincia;
    private $provincia;
    


    //Constructor
    function __construct() {
    }
    
    public function getId_provincia(){
		return $this->id_provincia;
	}

	public function setId_provincia($id_provincia){
		$this->id_provincia = $id_provincia;
	}

	public function getRegion_id_region(){
		return $this->region_id_region;
	}

	public function setRegion_id_region($region_id_region){
		$this->region_id_region = $region_id_region;
	}

	public function getNombre_provincia(){
		return $this->nombre_provincia;
	}

	public function setNombre_provincia($nombre_provincia){
		$this->nombre_provincia = $nombre_provincia;
	}

	public function getProvincia(){
		return $this->provincia;
	}

	public function setProvincia($provincia){
		$this->provincia = $provincia;
	}
  
	
    
    public function listar_provincias() {		
        $this->provincia = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM provincia WHERE region_id_region=:id";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id', $this->region_id_region); 					
			$consulta->execute();
            $resultado = $consulta->fetchAll();
            foreach($resultado as $registros):
                array_push($this->provincia, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}


}// Cierra clase CargoTrabajadorM.php