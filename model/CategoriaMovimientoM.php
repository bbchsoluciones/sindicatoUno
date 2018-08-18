<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');

class CategoriaMovimientoM{

    //Atributos
    private $id_categoria_movimiento;
    private $categoria_movimiento;
	private $tipo_movimiento_id_tipo_movimiento;
	
	//BD
	private $categoriasMovimientos;

    //get and set
    public function getId_categoria_movimiento(){
		return $this->id_categoria_movimiento;
	}

	public function setId_categoria_movimiento($id_categoria_movimiento){
		$this->id_categoria_movimiento = $id_categoria_movimiento;
	}

	public function getCategoria_movimiento(){
		return $this->categoria_movimiento;
	}

	public function setCategoria_movimiento($categoria_movimiento){
		$this->categoria_movimiento = $categoria_movimiento;
	}

	public function getTipo_movimiento_id_tipo_movimiento(){
		return $this->tipo_movimiento_id_tipo_movimiento;
	}

	public function setTipo_movimiento_id_tipo_movimiento($tipo_movimiento_id_tipo_movimiento){
		$this->tipo_movimiento_id_tipo_movimiento = $tipo_movimiento_id_tipo_movimiento;
	}
	
	//BD
	public function getCategoriasMovimientos(){
		return $this->categoriasMovimientos;
	}

	public function setCategoriasMovimientos($categoriasMovimientos){
		$this->categoriasMovimientos = $categoriasMovimientos;
	}
    
    //metodos
    public function listar_CategoriaMovimiento(){

        $this->categoriasMovimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM categoria_movimiento
					WHERE tipo_movimiento_id_tipo_movimiento=:tipo_movimiento_id_tipo_movimiento";
			$consulta = $conn->prepare($sql);	
			$consulta->bindValue(':tipo_movimiento_id_tipo_movimiento', $this->tipo_movimiento_id_tipo_movimiento);				
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->categoriasMovimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

    }//Cierra listar_TipoMovimiento()


}//Cierra clase