<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');


//Clase
class RegionM{

    private $id_region;
    private $nombre_region;
    private $region;

    //Constructor
    function __construct() {
    }

    public function getId_region(){
		return $this->id_region;
	}

	public function setId_region($id_region){
		$this->id_region = $id_region;
	}

	public function getNombre_region(){
		return $this->nombre_region;
	}

	public function setNombre_region($nombre_region){
		$this->nombre_region = $nombre_region;
	}

	public function getRegion(){
		return $this->region;
	}

	public function setRegion($region){
		$this->region = $region;
	}
    


    
    public function listar_region() {		
		$this->region = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM region";
			$consulta = $conn->prepare($sql);					
			$consulta->execute();
            $resultado = $consulta->fetchAll();
            foreach ($resultado as $registros):
                array_push($this->region, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}


}// Cierra clase regionM.php