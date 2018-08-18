<?php
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');

class NombreMovimientoM{

    //atributos
    private $id_nombre_movimiento;
    private $nombre_movimiento;
    private $categoria_movimiento_id_categoria_movimiento;
    //bd
    private $nombresMovimientos;

    public function getId_nombre_movimiento(){
		return $this->id_nombre_movimiento;
	}

	public function setId_nombre_movimiento($id_nombre_movimiento){
		$this->id_nombre_movimiento = $id_nombre_movimiento;
	}

	public function getNombre_movimiento(){
		return $this->nombre_movimiento;
	}

	public function setNombre_movimiento($nombre_movimiento){
		$this->nombre_movimiento = $nombre_movimiento;
	}

	public function getCategoria_movimiento_id_categoria_movimiento(){
		return $this->categoria_movimiento_id_categoria_movimiento;
	}

	public function setCategoria_movimiento_id_categoria_movimiento($categoria_movimiento_id_categoria_movimiento){
		$this->categoria_movimiento_id_categoria_movimiento = $categoria_movimiento_id_categoria_movimiento;
	}
    //BD
	public function getNombresMovimientos(){
		return $this->nombresMovimientos;
	}

	public function setNombresMovimientos($nombresMovimientos){
		$this->nombresMovimientos = $nombresMovimientos;
    }
    
    //metodos
    public function listar_NombreMovimiento(){

        $this->nombresMovimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM nombre_movimiento
					WHERE categoria_movimiento_id_categoria_movimiento=:categoria_movimiento_id_categoria_movimiento;";
			$consulta = $conn->prepare($sql);	
			$consulta->bindValue(':categoria_movimiento_id_categoria_movimiento', $this->categoria_movimiento_id_categoria_movimiento);				
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->nombresMovimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

    }//Cierra listar_TipoMovimiento()

}// Cierra clase