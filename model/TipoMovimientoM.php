<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Modelo
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');
//Dentro de Modelo

class TipoMovimientoM{

    //Atributos
    private $id_tipo_movimiento;
	private $tipo_movimiento;
	
	//BD
	private $tipoMovimientos;

    //Get & Set
    public function getId_tipo_movimiento(){
		return $this->id_tipo_movimiento;
	}

	public function setId_tipo_movimiento($id_tipo_movimiento){
		$this->id_tipo_movimiento = $id_tipo_movimiento;
	}

	public function getTipo_movimiento(){
		return $this->tipo_movimiento;
	}

	public function setTipo_movimiento($tipo_movimiento){
		$this->tipo_movimiento = $tipo_movimiento;
	}
	
	//BD
	public function getTipoMovimientos(){
		return $this->tipoMovimientos;
	}

	public function setTipoMovimientos($tipoMovimientos){
		$this->tipoMovimientos = $tipoMovimientos;
	}
    
    //Metodos
    public function listar_TipoMovimiento(){

        $this->tipoMovimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM tipo_movimiento";
			$consulta = $conn->prepare($sql);					
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->tipoMovimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

    }//Cierra listar_TipoMovimiento()

}//Cierra clase