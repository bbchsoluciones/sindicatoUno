<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');


//Clase
class ComunaM{

    private $id_comuna;
    private $provincia_id_provincia;
    private $nombre_comuna;
    private $comuna;
    


    //Constructor
    function __construct() {
    }

    public function getId_comuna(){
		return $this->id_comuna;
	}

	public function setId_comuna($id_comuna){
		$this->id_comuna = $id_comuna;
	}

	public function getProvincia_id_provincia(){
		return $this->provincia_id_provincia;
	}

	public function setProvincia_id_provincia($provincia_id_provincia){
		$this->provincia_id_provincia = $provincia_id_provincia;
	}

	public function getNombre_comuna(){
		return $this->nombre_comuna;
	}

	public function setNombre_comuna($nombre_comuna){
		$this->nombre_comuna = $nombre_comuna;
	}

	public function getComuna(){
		return $this->comuna;
	}

	public function setComuna($comuna){
		$this->comuna = $comuna;
	}
    

  
	
    
    public function listar_comunas() {		
        $this->comuna = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM comuna WHERE provincia_id_provincia=:id";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id', $this->provincia_id_provincia); 					
			$consulta->execute();
            $resultado = $consulta->fetchAll();
            foreach($resultado as $registros):
                array_push($this->comuna, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}


}// Cierra clase 