<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Modelo
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');
require_once($ruta_raiz . '/controller/FechaHoraActualC.php');
//Dentro de Modelo

//PRUEBAS DE METODOS 
//PRUEBAS DE METODOS 
//PRUEBAS DE METODOS 
//$mov = new MovimientoM();

//$mov->mostrar_todos_movimientos();
//var_dump($mov->getMovimientos());

//1.
/*if($mov->registrar_movimiento(1490, '193412130', 3)){
    echo "MOVIMIENTO REGISTRADO CON ÉXITO";
}else{
    echo "FATAL ERROR";
}*/

//2.
//var_dump($mov->mostrar_todos_movimientos());
/*foreach($mov->mostrar_todos_movimientos() as $mov){

    var_dump($mov->getTrabajador_run_trabajador());

}*/
//var_dump($mov->mostrar_todos_movimientos()[0]->getTrabajador_run_trabajador());

//3.
//var_dump($mov->mostrar_movimiento(6));

//4.
/*if($mov->modificar_movimiento(5, 50000, 4)){
    echo "MOVIMIENTO MODIFICADO CON ÉXITO";
}else{
    echo "FATAL ERROR";
}*/

//5.
/*if($mov->eliminar_movimiento(5)){
    echo "MOVIMIENTO ELIMINADO CON ÉXITO";
}else{
    echo "FATAL ERROR";
}*/

//6.
/*
if($mov->encontrar_movimiento(4)){
    echo "MOVIMIENTO EXISTE";
}else{
    echo "MOVIMIENTO NO EXISTE";
}*/

//7.
/* $mov->mostrar_movimientos_ingresos(8, 2018);
print_r($mov->getMovimientos());
var_dump($mov->getMovimientos()); */




//PRUEBAS DE METODOS 
//PRUEBAS DE METODOS 
//PRUEBAS DE METODOS 


//Clase
class MovimientoM{

    //Atributos Tabla Trabajador
    //Atributos Tabla Trabajador
    //Atributos Tabla Trabajador
    //Atributos Clase
    private $id_movimiento;
    private $fecha_movimiento;
    private $monto_movimiento;
    private $fondo_id_fondo;
    private $trabajador_run_trabajador;
	private $nombre_movimiento_id_nombre_movimiento;
	
	//BD
	private $movimientos;

    //Constructor
    //Constructor
    //Constructor
    function __construct() {
	}

    //Get and Set Atributos Tabla Trabajador
    //Get and Set Atributos Tabla Trabajador
    //Get and Set Atributos Tabla Trabajador
    public function getId_movimiento(){
		return $this->id_movimiento;
	}
	public function setId_movimiento($id_movimiento){
		$this->id_movimiento = $id_movimiento;
	}
	public function getFecha_movimiento(){
		return $this->fecha_movimiento;
	}
	public function setFecha_movimiento($fecha_movimiento){
		$this->fecha_movimiento = $fecha_movimiento;
	}
	public function getMonto_movimiento(){
		return $this->monto_movimiento;
	}
	public function setMonto_movimiento($monto_movimiento){
		$this->monto_movimiento = $monto_movimiento;
	}
	public function getFondo_id_fondo(){
		return $this->fondo_id_fondo;
	}
	public function setFondo_id_fondo($fondo_id_fondo){
		$this->fondo_id_fondo = $fondo_id_fondo;
	}
	public function getTrabajador_run_trabajador(){
		return $this->trabajador_run_trabajador;
	}
	public function setTrabajador_run_trabajador($trabajador_run_trabajador){
		$this->trabajador_run_trabajador = $trabajador_run_trabajador;
	}
	public function getNombre_movimiento_id_nombre_movimiento(){
		return $this->nombre_movimiento_id_nombre_movimiento;
	}
	public function setNombre_movimiento_id_nombre_movimiento($nombre_movimiento_id_nombre_movimiento){
		$this->nombre_movimiento_id_nombre_movimiento = $nombre_movimiento_id_nombre_movimiento;
	}
	//BD
	public function getMovimientos(){
		return $this->movimientos;
	}
	public function setMovimientos($movimientos){
		$this->movimientos = $movimientos;
	}

    //Metodos
    //Metodos
	//Metodos
	public function encontrar_movimiento($id_movimiento){

		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM movimiento
					WHERE id_movimiento=:id_movimiento";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':id_movimiento', $id_movimiento);			
			$consulta->execute();
			$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
			//echo "Resultado consulta buscar: ".var_dump($resultado);
			if(!empty($resultado)){
				//Movimiento Existe
				return true;
			}else{
				//Movimiento NO Existe
				return false;
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

	}// Cierra encontrar_movimiento

	public function registrar_movimiento($monto, $id_nom_mov, $run, $fecha, $desc) {	
        
        
		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "INSERT INTO movimiento (fecha_movimiento, 
                                            monto_movimiento,
											descripcion_movimiento,
                                            fondo_id_fondo,
                                            trabajador_run_trabajador,
                                            nombre_movimiento_id_nombre_movimiento) 
					VALUES (:fecha_movimiento, 
                            :monto_movimiento,
							:descripcion_movimiento, 
                            :fondo_id_fondo,
                            :trabajador_run_trabajador,
                            :nombre_movimiento_id_nombre_movimiento);";
			$consulta = $conn->prepare($sql);
			$consulta->bindValue(':fecha_movimiento', $fecha);
			$consulta->bindValue(':monto_movimiento', $monto);
			$consulta->bindValue(':descripcion_movimiento', $desc);
			$consulta->bindValue(':fondo_id_fondo', 1);
			$consulta->bindValue(':trabajador_run_trabajador', $run);
			$consulta->bindValue(':nombre_movimiento_id_nombre_movimiento', $id_nom_mov);
			if($consulta->execute()){
				//Registrado con éxito
				return true;
			}else{
				//Error
				return false;
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
            //return false;
        }	        
    }// Cierra registrar_movimiento
    
    public function mostrar_todos_movimientos(){
        
		$this->movimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			//$sql = "SELECT * FROM movimiento";
			$sql = "SELECT
			m.id_movimiento,
			tm.tipo_movimiento,
			cm.categoria_movimiento,
			nm.nombre_movimiento,
			IFNULL(m.descripcion_movimiento, 'No Aplica') AS descripcion_movimiento,
			m.monto_movimiento,
			DATE_FORMAT(m.fecha_movimiento,'%d/%m/%Y') as fecha_movimiento,
			t.nombres_trabajador
			FROM movimiento m
			JOIN nombre_movimiento nm
			ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
			JOIN categoria_movimiento cm
			ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
			JOIN tipo_movimiento tm
			ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
			JOIN trabajador t
			ON m.trabajador_run_trabajador = t.run_trabajador
			ORDER BY m.id_movimiento DESC;";
			$consulta = $conn->prepare($sql);					
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->movimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	
            

    }// Cierra mostrar_todos_movimientos

    public function mostrar_movimiento($id_movimiento){

		try{

            $m;
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM movimiento WHERE id_movimiento=:id_movimiento";
			$consulta = $conn->prepare($sql);	
			$consulta->bindValue(':id_movimiento', $id_movimiento);				
			$consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);            
			
			if(!empty($resultado)){
				//Hay registros
				
                    $m = new MovimientoM();
                    $m->setId_movimiento($resultado['id_movimiento']);
                    $m->setFecha_movimiento($resultado['fecha_movimiento']);
                    $m->setMonto_movimiento($resultado['monto_movimiento']);
                    $m->setFondo_id_fondo($resultado['fondo_id_fondo']);
                    $m->setTrabajador_run_trabajador($resultado['trabajador_run_trabajador']);
                    $m->setNombre_movimiento_id_nombre_movimiento($resultado['nombre_movimiento_id_nombre_movimiento']);                       
                           
                
			}else{
				//No hay registros
				$m = array("No hay registros");
            }
            
            return $m;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }

	}// Cierra mostrar_movimiento
	
	public function modificar_movimiento($id_movimiento, $monto){

	
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "UPDATE movimiento
					SET monto_movimiento=:monto_movimiento
					WHERE id_movimiento=:id_movimiento;";
			$consulta = $conn->prepare($sql);
			$consulta->bindValue(':monto_movimiento', $monto);
			//$consulta->bindValue(':nombre_movimiento_id_nombre_movimiento', $id_nom_mov);
			$consulta->bindValue(':id_movimiento', $id_movimiento);
			if($consulta->execute()){
				//Actualizado con éxito
				return true;
			}else{
				//Error
				return false;
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
            //return false;
        }



	}// Cierra modificar_movimiento

	public function eliminar_movimiento($id_movimiento){

		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "DELETE FROM movimiento
					WHERE id_movimiento=:id_movimiento;";
			$consulta = $conn->prepare($sql);
			$consulta->bindValue(':id_movimiento', $id_movimiento);
			if($consulta->execute()){
				//Eliminado con éxito
				return true;
			}else{
				//Error
				return false;
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
            //return false;
        }	

	}// Cierra eliminar_movimiento

	public function mostrar_movimientos_ingresos($id_categoria, $anio){
        
		$this->movimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			//$sql = "SELECT * FROM movimiento";
			$sql = "SELECT
			m.id_movimiento,
			tm.tipo_movimiento,
			cm.categoria_movimiento,
			nm.nombre_movimiento,
			m.monto_movimiento,
			YEAR(m.fecha_movimiento) AS anio,
			MONTH(m.fecha_movimiento) AS mes,
			t.nombres_trabajador
			FROM movimiento m
			JOIN nombre_movimiento nm
			ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
			JOIN categoria_movimiento cm
			ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
			JOIN tipo_movimiento tm
			ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
			JOIN trabajador t
			ON m.trabajador_run_trabajador = t.run_trabajador
			WHERE YEAR(m.fecha_movimiento)=:anio
			AND cm.id_categoria_movimiento=:id_categoria;";
			$consulta = $conn->prepare($sql);	
			$consulta->bindValue(':anio', $anio);					
			$consulta->bindValue(':id_categoria', $id_categoria);					
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->movimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	
            

	}// Cierra mostrar_movimientos_ingresos
	
	function total_ingreso(){

        $this->movimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			//$sql = "SELECT * FROM movimiento";
            $sql = "SELECT
			IFNULL(SUM(m.monto_movimiento),0) AS total_ingreso
			FROM movimiento m
			JOIN nombre_movimiento nm
			ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
			JOIN categoria_movimiento cm
			ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
			JOIN tipo_movimiento tm
			ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
			WHERE tm.id_tipo_movimiento=:id_tipo";
            $consulta = $conn->prepare($sql);	
            $consulta->bindValue(':id_tipo', 0);				
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->movimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

	}// Cierra total_ingreso

	function total_egreso(){

        $this->movimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			//$sql = "SELECT * FROM movimiento";
            $sql = "SELECT
			IFNULL(SUM(m.monto_movimiento),0) AS total_egreso
			FROM movimiento m
			JOIN nombre_movimiento nm
			ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
			JOIN categoria_movimiento cm
			ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
			JOIN tipo_movimiento tm
			ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
			WHERE tm.id_tipo_movimiento=:id_tipo";
            $consulta = $conn->prepare($sql);	
            $consulta->bindValue(':id_tipo', 1);				
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->movimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

	}// Cierra total_egreso
	
	public function mostrar_movimientos_totales($id_tipo, $anio){
        
		$this->movimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			//$sql = "SELECT * FROM movimiento";
			$sql = "SELECT
					tm.tipo_movimiento,
					m.monto_movimiento,
					YEAR(m.fecha_movimiento) AS anio,
					MONTH(m.fecha_movimiento) AS mes
					FROM movimiento m
					JOIN nombre_movimiento nm
					ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
					JOIN categoria_movimiento cm
					ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
					JOIN tipo_movimiento tm
					ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
					WHERE YEAR(m.fecha_movimiento)=:anio
					AND tm.id_tipo_movimiento=:id_tipo_movimiento;";
			$consulta = $conn->prepare($sql);	
			$consulta->bindValue(':anio', $anio);					
			$consulta->bindValue(':id_tipo_movimiento', $id_tipo);					
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->movimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	
            

	}// Cierra mostrar_movimientos_totales
	
	function cantidad_movimientos(){

        $this->movimientos = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
            $sql = "SELECT COUNT(m.id_movimiento) AS total_mov,
			(
				SELECT COUNT(m.id_movimiento)
				FROM movimiento m
				JOIN nombre_movimiento nm
				ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
				JOIN categoria_movimiento cm
				ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
				JOIN tipo_movimiento tm
				ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
				WHERE tm.id_tipo_movimiento=0
			) AS total_ingresos,
			(
				SELECT COUNT(m.id_movimiento)
				FROM movimiento m
				JOIN nombre_movimiento nm
				ON m.nombre_movimiento_id_nombre_movimiento = nm.id_nombre_movimiento
				JOIN categoria_movimiento cm
				ON nm.categoria_movimiento_id_categoria_movimiento = cm.id_categoria_movimiento
				JOIN tipo_movimiento tm
				ON cm.tipo_movimiento_id_tipo_movimiento = tm.id_tipo_movimiento
				WHERE tm.id_tipo_movimiento=1
			) AS total_egresos
			FROM movimiento m;";
            $consulta = $conn->prepare($sql);				
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->movimientos, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

	}// Cierra cantidad_movimientos



}// Cierra clase MovimientoM.php