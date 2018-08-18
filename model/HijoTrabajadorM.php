<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Modelo
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');
require_once($ruta_raiz . '/controller/EncriptadorC.php');
//Dentro de Modelo


//Clase
class HijoTrabajadorM{

    private $run_hijo;
    private $nombres_hijo;
    private $apellidos_hijo;
    private $genero_hijo;
    private $fec_nac_hijo;
    private $trabajador_run_trabajador;

    private $hijo;
    private $cantidad_hijos;
    
    function __construct() {
    }
    
    public function getRun_hijo(){
		return $this->run_hijo;
	}

	public function setRun_hijo($run_hijo){
		$this->run_hijo = $run_hijo;
	}

	public function getNombres_hijo(){
		return $this->nombres_hijo;
	}

	public function setNombres_hijo($nombres_hijo){
		$this->nombres_hijo = $nombres_hijo;
	}

	public function getApellidos_hijo(){
		return $this->apellidos_hijo;
	}

	public function setApellidos_hijo($apellidos_hijo){
		$this->apellidos_hijo = $apellidos_hijo;
	}

	public function getGenero_hijo(){
		return $this->genero_hijo;
	}

	public function setGenero_hijo($genero_hijo){
		$this->genero_hijo = $genero_hijo;
	}

	public function getFec_nac_hijo(){
		return $this->fec_nac_hijo;
	}

	public function setFec_nac_hijo($fec_nac_hijo){
		$this->fec_nac_hijo = $fec_nac_hijo;
	}

	public function getTrabajador_run_trabajador(){
		return $this->trabajador_run_trabajador;
	}

	public function setTrabajador_run_trabajador($trabajador_run_trabajador){
		$this->trabajador_run_trabajador = $trabajador_run_trabajador;
	}

	public function getHijo(){
		return $this->hijo;
	}

	public function setHijos($hijo){
		$this->hijo = $hijo;
	}

	public function getCantidad_hijos(){
		return $this->cantidad_hijos;
	}

	public function setCantidad_hijos($cantidad_hijos){
		$this->cantidad_hijos = $cantidad_hijos;
	}
	public function encontrar_hijo() {		
		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM hijo
					WHERE run_hijo=:run_hijo";
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_hijo', $this->run_hijo);			
			$consulta->execute();
			$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
			if(!empty($resultado)){
				return true;
			}else{
				return false;
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}
	public function mostrar_rut_padre() {	
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT run_trabajador FROM trabajador
										JOIN hijo
										ON hijo.trabajador_run_trabajador=trabajador.run_trabajador
										WHERE hijo.run_hijo=:run_hijo";
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_hijo', $this->run_hijo);			
			$consulta->execute();
			$resultado= $consulta->fetch(PDO::FETCH_ASSOC);
			$this->trabajador_run_trabajador = utf8_encode($resultado['run_trabajador']);
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	
	}
	public function mostrar_datos_hijos() {	
		$this->hijo = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT 
					run_hijo,
                    nombres_hijo,
                    apellidos_hijo,
                    genero_hijo,
                    date_format(fec_nac_hijo,'%d/%m/%Y') as fec_nac_hijo
                    FROM hijo
                    JOIN trabajador 
                    ON run_trabajador=trabajador_run_trabajador
					WHERE run_trabajador=:run_trabajador";
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_trabajador', $this->trabajador_run_trabajador);			
			$consulta->execute();
			$resultado= $consulta->fetchAll();
			if($resultado):
				for ($i = 0; $i < count($resultado); $i++) {
					array_push($this->hijo, array_map("utf8_encode",$resultado[$i]));
				}
			endif;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}
	public function mostrar_datos_hijo() {	
		$this->hijo = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT 
					run_hijo,
                    nombres_hijo,
                    apellidos_hijo,
                    genero_hijo,
                    date_format(fec_nac_hijo,'%d/%m/%Y') as fec_nac_hijo
                    FROM hijo
					WHERE run_hijo=:run_hijo";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_hijo', $this->run_hijo);			
			$consulta->execute();
			$resultado= $consulta->fetch(PDO::FETCH_ASSOC);
			if($resultado):
					$this->hijo = array_map("utf8_encode",$resultado);
			endif;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}
	public function contarHijos() {		
		try{
			
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT count(*) from hijo WHERE trabajador_run_trabajador=:run";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run', $this->trabajador_run_trabajador); 		
			$consulta->execute();
			$this->cantidad_hijos = $consulta->fetchColumn(); 
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}// Cierra listar_trabajador

    public function registrar_hijo() {		
		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "INSERT INTO hijo	(run_hijo, 
										nombres_hijo, 
										apellidos_hijo,
										genero_hijo, 
										fec_nac_hijo, 
										trabajador_run_trabajador)
					VALUES (:rut_hijo,
							:nom_hijo,
							:ape_hijo,
							:gen_hijo,
							:fec_hijo,
							:rut_tra)";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':rut_hijo', $this->run_hijo);
			$consulta->bindParam(':nom_hijo', $this->nombres_hijo);
			$consulta->bindParam(':ape_hijo', $this->apellidos_hijo);
			$consulta->bindParam(':gen_hijo', $this->genero_hijo);
			$consulta->bindParam(':fec_hijo', $this->fec_nac_hijo);
			$consulta->bindValue(':rut_tra',  $this->trabajador_run_trabajador);
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
        }		
	}

	public function actualizar_hijo() {		
		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "UPDATE  hijo SET  nombres_hijo=:nom_hijo, 
										apellidos_hijo=:ape_hijo,
										genero_hijo=:gen_hijo, 
										fec_nac_hijo=:fec_hijo
								WHERE   run_hijo=:rut_hijo";
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':rut_hijo', $this->run_hijo);
			$consulta->bindParam(':nom_hijo', $this->nombres_hijo);
			$consulta->bindParam(':ape_hijo', $this->apellidos_hijo);
			$consulta->bindParam(':gen_hijo', $this->genero_hijo);
			$consulta->bindParam(':fec_hijo', $this->fec_nac_hijo);
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
        }		
	}
	public function eliminar_hijo() {		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "DELETE FROM hijo WHERE run_hijo=:rut_hijo";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':rut_hijo', $this->run_hijo);
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
        }		
	}


}