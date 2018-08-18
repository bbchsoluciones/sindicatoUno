<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');

class FondoM{

    //atributos
    //BD
    private $monto_fondo;

    //get and set
    public function getMonto_fondo(){
		return $this->monto_fondo;
	}

	public function setMonto_fondo($monto_fondo){
		$this->monto_fondo = $monto_fondo;
	}

    function saldoFondo(){

        $this->monto_fondo = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			//$sql = "SELECT * FROM movimiento";
            $sql = "SELECT
            IFNULL(SUM(m.monto_movimiento),0) AS ingreso,
            (SELECT
            IFNULL(SUM(m.monto_movimiento),0)
            FROM movimiento m
            JOIN nombre_movimiento nm
            ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
            JOIN categoria_movimiento cm
            ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
            JOIN tipo_movimiento tm
            ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
            WHERE tm.id_tipo_movimiento=1)  AS egreso,
            (SELECT monto_fondo FROM fondo WHERE id_fondo=1) AS fondo
            FROM movimiento m
            JOIN nombre_movimiento nm
            ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
            JOIN categoria_movimiento cm
            ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
            JOIN tipo_movimiento tm
            ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
            WHERE tm.id_tipo_movimiento=0";
            $consulta = $conn->prepare($sql);				
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->monto_fondo, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

    }

}//Cierra clase