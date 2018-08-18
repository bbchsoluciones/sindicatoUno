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
class TrabajadorM{

    //Atributos Tabla Trabajador
    //Atributos Tabla Trabajador
    //Atributos Tabla Trabajador
    private $run_trabajador;
    private $contrasena_trabajador;
    private $nombres_trabajador;
    private $apellidos_trabajador;
    private $fec_nac_trabajador;
    private $genero_trabajador;
    private $placa_trabajador;
    private $sub_cargo_id_sub_cargo;
    private $estado_civil_trabajador;
    private $direccion_trabajador;
    private $comuna_id_comuna;
    private $telefono_trabajador;
    private $celular_trabajador;
    private $email_trabajador;
    private $fec_ing_emp_trabajador;
    private $fec_ing_sin_trabajador;
    private $tipo_usuario_id_tipo_usuario;
	private $estado_trabajador_id_estado_trabajador;
	private $cantidad_trabajadores;
	//Atributos Clase
	private $trabajadores;
	private $trabajador;

    //Constructor
    //Constructor
    //Constructor
    function __construct() {
	}

    //Get and Set Atributos Tabla Trabajador
    //Get and Set Atributos Tabla Trabajador
    //Get and Set Atributos Tabla Trabajador
	public function getRun_trabajador(){
		return $this->run_trabajador;
	}

	public function setRun_trabajador($run_trabajador){
		$this->run_trabajador = $run_trabajador;
	}

	public function getContrasena_trabajador(){
		return $this->contrasena_trabajador;
	}

	public function setContrasena_trabajador($contrasena_trabajador){
		$this->contrasena_trabajador = $contrasena_trabajador;
	}

	public function getNombres_trabajador(){
		return $this->nombres_trabajador;
	}

	public function setNombres_trabajador($nombres_trabajador){
		$this->nombres_trabajador = $nombres_trabajador;
	}

	public function getApellidos_trabajador(){
		return $this->apellidos_trabajador;
	}

	public function setApellidos_trabajador($apellidos_trabajador){
		$this->apellidos_trabajador = $apellidos_trabajador;
	}

	public function getFec_nac_trabajador(){
		return $this->fec_nac_trabajador;
	}

	public function setFec_nac_trabajador($fec_nac_trabajador){
		$this->fec_nac_trabajador = $fec_nac_trabajador;
	}

	public function getGenero_trabajador(){
		return $this->genero_trabajador;
	}

	public function setGenero_trabajador($genero_trabajador){
		$this->genero_trabajador = $genero_trabajador;
	}

	public function getPlaca_trabajador(){
		return $this->placa_trabajador;
	}

	public function setPlaca_trabajador($placa_trabajador){
		$this->placa_trabajador = $placa_trabajador;
	}

	public function getSub_cargo_id_sub_cargo(){
		return $this->sub_cargo_id_sub_cargo;
	}

	public function setSub_cargo_id_sub_cargo($sub_cargo_id_sub_cargo){
		$this->sub_cargo_id_sub_cargo = $sub_cargo_id_sub_cargo;
	}

	public function getEstado_civil_trabajador(){
		return $this->estado_civil_trabajador;
	}

	public function setEstado_civil_trabajador($estado_civil_trabajador){
		$this->estado_civil_trabajador = $estado_civil_trabajador;
	}

	public function getDireccion_trabajador(){
		return $this->direccion_trabajador;
	}

	public function setDireccion_trabajador($direccion_trabajador){
		$this->direccion_trabajador = $direccion_trabajador;
	}

	public function getComuna_id_comuna(){
		return $this->comuna_id_comuna;
	}

	public function setComuna_id_comuna($comuna_id_comuna){
		$this->comuna_id_comuna = $comuna_id_comuna;
	}

	public function getTelefono_trabajador(){
		return $this->telefono_trabajador;
	}

	public function setTelefono_trabajador($telefono_trabajador){
		$this->telefono_trabajador = $telefono_trabajador;
	}

	public function getCelular_trabajador(){
		return $this->celular_trabajador;
	}

	public function setCelular_trabajador($celular_trabajador){
		$this->celular_trabajador = $celular_trabajador;
	}

	public function getEmail_trabajador(){
		return $this->email_trabajador;
	}

	public function setEmail_trabajador($email_trabajador){
		$this->email_trabajador = $email_trabajador;
	}

	public function getFec_ing_emp_trabajador(){
		return $this->fec_ing_emp_trabajador;
	}

	public function setFec_ing_emp_trabajador($fec_ing_emp_trabajador){
		$this->fec_ing_emp_trabajador = $fec_ing_emp_trabajador;
	}

	public function getFec_ing_sin_trabajador(){
		return $this->fec_ing_sin_trabajador;
	}

	public function setFec_ing_sin_trabajador($fec_ing_sin_trabajador){
		$this->fec_ing_sin_trabajador = $fec_ing_sin_trabajador;
	}

	public function getTipo_usuario_id_tipo_usuario(){
		return $this->tipo_usuario_id_tipo_usuario;
	}

	public function setTipo_usuario_id_tipo_usuario($tipo_usuario_id_tipo_usuario){
		$this->tipo_usuario_id_tipo_usuario = $tipo_usuario_id_tipo_usuario;
	}

	public function getEstado_trabajador_id_estado_trabajador(){
		return $this->estado_trabajador_id_estado_trabajador;
	}

	public function setEstado_trabajador_id_estado_trabajador($estado_trabajador_id_estado_trabajador){
		$this->estado_trabajador_id_estado_trabajador = $estado_trabajador_id_estado_trabajador;
	}

	public function getCantidad_trabajadores(){
		return $this->cantidad_trabajadores;
	}

	public function setCantidad_trabajadores($cantidad_trabajadores){
		$this->cantidad_trabajadores = $cantidad_trabajadores;
	}

	public function getTrabajadores(){
		return $this->trabajadores;
	}

	public function setTrabajadores($trabajadores){
		$this->trabajadores = $trabajadores;
	}

	public function getTrabajador(){
		return $this->trabajador;
	}

	public function setTrabajador($trabajador){
		$this->trabajador = $trabajador;
	}

    //Metodos
    //Metodos
	//Metodos
	//
	public function encontrar_trabajador() {		
		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM trabajador
					WHERE run_trabajador=:run_trabajador";
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_trabajador', $this->run_trabajador);			
			$consulta->execute();
			$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
			//echo "Resultado consulta buscar: ".var_dump($resultado);
			if(!empty($resultado)){
				//Usuario Existe
				return true;
			}else{
				//Usuario NO Existe
				return false;
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}// Cierra encontrar_trabajador

	public function encontrarTconImagen() {		
		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT 	url_foto_perfil FROM trabajador
						INNER JOIN 
									foto_perfil 
						ON 
									foto_perfil.trabajador_run_trabajador = trabajador.run_trabajador
						WHERE 
									foto_perfil.trabajador_run_trabajador=:run_trabajador";
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_trabajador', $this->run_trabajador);			
			$consulta->execute();
			$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
			//echo "Resultado consulta buscar: ".var_dump($resultado);
			if(!empty($resultado)){
				//Usuario Existe
				return true;
			}else{
				//Usuario NO Existe
				return false;
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}// Cierra encontrar_trabajador 

	public function contarTrabajores($accion,$objeto) {		
		try{
			
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT count(*) from trabajador ";
			if($accion=="buscar"):
				$sql .= "WHERE run_trabajador LIKE concat('%', :texto, '%') 
								OR nombres_trabajador LIKE concat('%', :texto, '%')";
				
			endif;
			
			$consulta = $conn->prepare($sql);	
			if($accion=="buscar"): 
				$consulta->bindParam(':texto', $objeto); 
			endif;			
			$consulta->execute();
			$this->cantidad_trabajadores = $consulta->fetchColumn(); 
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}// Cierra listar_trabajador

	public function filtrarTrabajadores($accion, $objeto, $pagina,$registrosPorPagina){
		$this->trabajadores = array();
		$objeto = htmlspecialchars($objeto);
		$pagina = htmlspecialchars($pagina);
		$registrosPorPagina = htmlspecialchars($registrosPorPagina);
		$order = "";
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT run_trabajador,SUBSTRING_INDEX(nombres_trabajador, ' ', 1) AS nombres_trabajador
								FROM trabajador ";
			if($accion!="todo"):
				if($accion=="buscar"):
					$sql .= "WHERE run_trabajador LIKE concat('%', :texto, '%') 
								OR nombres_trabajador LIKE concat('%', :texto, '%')";
				elseif($accion=="filtrar"):
					if($objeto=='true'):
						$order="ORDER BY nombres_trabajador ASC"; 
					else:
						$order="ORDER BY nombres_trabajador DESC";  
					endif;
				endif;
			else:
				$order="ORDER BY nombres_trabajador ASC";
			endif;
			$this->contarTrabajores($accion,$objeto);
			$inicio = ($pagina-1)*$registrosPorPagina;
			$fin = $registrosPorPagina;
			$sql .= $order." LIMIT $inicio,  $fin ";
			
			$consulta = $conn->prepare($sql);
			if($accion="buscar"): 
				$consulta->bindParam(':texto', $objeto); 
			endif;
			$consulta->execute();
			$trabajadores = $consulta->fetchAll();
			for ($i = 0; $i < count($trabajadores); $i++) {
				array_push($this->trabajadores, array_map('utf8_encode',$trabajadores[$i]));
			}			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }
		
	}

	public function mostrar_datos_trabajador() {		
		$this->trabajador = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT 
					f.url_foto_perfil,
					tu.tipo_usuario,
					t.run_trabajador,
					t.email_trabajador,
					t.nombres_trabajador,
					t.apellidos_trabajador,
					t.placa_trabajador,
					c.id_cargo,
					sb.id_sub_cargo,
					c.nombre_cargo,
					t.direccion_trabajador,
					r.id_region,
					p.id_provincia,
					co.id_comuna,
					r.nombre_region,
					p.nombre_provincia,
					co.nombre_comuna,
					date_format(t.fec_nac_trabajador,'%d/%m/%Y') as fec_nac_trabajador, 
					t.genero_trabajador,
					t.estado_civil_trabajador,
					date_format(t.fec_ing_emp_trabajador,'%d/%m/%Y') as fec_ing_emp_trabajador, 
					date_format(t.fec_ing_sin_trabajador,'%d/%m/%Y') as fec_ing_sin_trabajador, 
					et.estado_trabajador,
					t.telefono_trabajador,
					t.celular_trabajador
					FROM trabajador t
					LEFT JOIN foto_perfil f 
					ON t.run_trabajador = f.trabajador_run_trabajador
					JOIN tipo_usuario tu
					ON t.tipo_usuario_id_tipo_usuario = tu.id_tipo_usuario
					LEFT JOIN sub_cargo sb
					ON t.sub_cargo_id_sub_cargo = sb.id_sub_cargo
					LEFT JOIN cargo c
					ON sb.cargo_id_cargo = c.id_cargo
					LEFT JOIN comuna co
					ON t.comuna_id_comuna = co.id_comuna
					LEFT JOIN provincia p
					ON co.provincia_id_provincia = p.id_provincia
					LEFT JOIN region r
					ON p.region_id_region = r.id_region
					LEFT JOIN estado_trabajador et
					ON t.estado_trabajador_id_estado_trabajador = et.id_estado_trabajador
					WHERE t.run_trabajador=:run_trabajador";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_trabajador', $this->run_trabajador);			
			$consulta->execute();
			$resultado= $consulta->fetch(PDO::FETCH_ASSOC);
			if($resultado){
				$this->trabajador = array_map('utf8_encode', $resultado);
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}// Cierra mostrar_datos_trabajador

    public function registrar_trabajador() {		
		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "INSERT INTO trabajador (run_trabajador, 
											nombres_trabajador, 
											apellidos_trabajador,
											sub_cargo_id_sub_cargo, 
											contrasena_trabajador, 
											comuna_id_comuna,
											tipo_usuario_id_tipo_usuario,
											estado_trabajador_id_estado_trabajador) 
					VALUES (:run_trabajador, 
							:nombres_trabajador, 
							:apellidos_trabajador, 
							:sub_cargo_id_sub_cargo, 
							:contrasena_trabajador, 
							:comuna_id_comuna,
							:tipo_usuario_id_tipo_usuario,
							:estado_trabajador_id_estado_trabajador);";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_trabajador', $this->run_trabajador);
			$consulta->bindParam(':nombres_trabajador', $this->nombres_trabajador);
			$consulta->bindParam(':apellidos_trabajador', $this->apellidos_trabajador);
			$consulta->bindValue(':sub_cargo_id_sub_cargo', null);
			$consulta->bindParam(':contrasena_trabajador', $this->contrasena_trabajador);
			$consulta->bindValue(':comuna_id_comuna', null);
			$consulta->bindParam(':tipo_usuario_id_tipo_usuario', $this->tipo_usuario_id_tipo_usuario);
			$consulta->bindValue(':estado_trabajador_id_estado_trabajador', null);
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
	}// Cierra crear_trabajador	

	public function actualizar_trabajador() {
		
	try{
		$pdo = PDOConnection::instance();
		$conn = $pdo->getConnection();
		$accion = "UPDATE trabajador SET ";

		$cuerpo =          "tipo_usuario_id_tipo_usuario = :tipo_usuario_id_tipo_usuario,
							email_trabajador = :email_trabajador,
							nombres_trabajador = :nombres_trabajador,
							apellidos_trabajador = :apellidos_trabajador,
							sub_cargo_id_sub_cargo = :sub_cargo_id_sub_cargo,
							direccion_trabajador = :direccion_trabajador,
							comuna_id_comuna = :comuna_id_comuna,
							fec_nac_trabajador = :fec_nac_trabajador,
							genero_trabajador = :genero_trabajador,
							estado_civil_trabajador = :estado_civil_trabajador,
							fec_ing_emp_trabajador = :fec_ing_emp_trabajador,
							fec_ing_sin_trabajador = :fec_ing_sin_trabajador,
							estado_trabajador_id_estado_trabajador = :estado_trabajador_id_estado_trabajador,
							telefono_trabajador = :telefono_trabajador,
							celular_trabajador = :celular_trabajador,
							placa_trabajador = :placa_trabajador ";

		$clausula = "WHERE run_trabajador = :run_trabajador";

		if($this->contrasena_trabajador!=="nula"){
			$cuerpo .= ",contrasena_trabajador = :contrasena_trabajador ";
		}

						
		$sql = $accion . $cuerpo .$clausula;
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$consulta = $conn->prepare($sql);

		if($this->contrasena_trabajador!=="nula"):
			$consulta->bindParam(':contrasena_trabajador', $this->contrasena_trabajador, PDO::PARAM_STR);
		endif;

		$consulta->bindParam(':placa_trabajador', $this->placa_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':tipo_usuario_id_tipo_usuario', $this->tipo_usuario_id_tipo_usuario, PDO::PARAM_INT);
		$consulta->bindParam(':email_trabajador', $this->email_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':nombres_trabajador', $this->nombres_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':apellidos_trabajador', $this->apellidos_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':sub_cargo_id_sub_cargo', $this->sub_cargo_id_sub_cargo, PDO::PARAM_INT);
		$consulta->bindParam(':direccion_trabajador', $this->direccion_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':comuna_id_comuna', $this->comuna_id_comuna, PDO::PARAM_INT);
		$consulta->bindParam(':fec_nac_trabajador', $this->fec_nac_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':genero_trabajador', $this->genero_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':estado_civil_trabajador', $this->estado_civil_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':fec_ing_emp_trabajador', $this->fec_ing_emp_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':fec_ing_sin_trabajador', $this->fec_ing_sin_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':estado_trabajador_id_estado_trabajador', $this->estado_trabajador_id_estado_trabajador, PDO::PARAM_INT);
		$consulta->bindParam(':telefono_trabajador', $this->telefono_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':celular_trabajador', $this->celular_trabajador, PDO::PARAM_STR);
		$consulta->bindParam(':run_trabajador', $this->run_trabajador, PDO::PARAM_STR);
		if($consulta->execute()):
				return true;
            else:
				return false;
			endif;

		$conn = null;
		$consulta = null;

	}catch (Exception $ex) {
		echo "Fallo: " . $ex->getMessage();
	}		
}

	public function listar_trabajadores() {		
		$this->trabajadores = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT * FROM trabajador";
			$consulta = $conn->prepare($sql);					
			$consulta->execute();
			$trabajadores = $consulta->fetchAll();
			for ($i = 0; $i < count($trabajadores); $i++) {
				array_push($this->trabajadores, $trabajadores[$i]);
			}
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}// Cierra listar_trabajador

	public function eliminar_trabajador(){

		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "DELETE FROM trabajador
					WHERE run_trabajador=:run_trabajador;";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':run_trabajador', $this->run_trabajador);
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

	}

	function cantidad_miembros(){

        $this->trabajadores = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			//$sql = "SELECT * FROM movimiento";
            $sql = "SELECT 
			IFNULL(COUNT(run_trabajador),0) AS total,
			(SELECT IFNULL(COUNT(run_trabajador),0) FROM trabajador WHERE estado_trabajador_id_estado_trabajador=0) AS inactivos,
			(SELECT IFNULL(COUNT(run_trabajador),0) FROM trabajador WHERE estado_trabajador_id_estado_trabajador=1) AS activos,
			(SELECT IFNULL(COUNT(run_trabajador),0) FROM trabajador WHERE estado_trabajador_id_estado_trabajador=2) AS pendientes,
			(SELECT IFNULL(COUNT(run_trabajador),0) FROM trabajador WHERE genero_trabajador='Masculino') AS hombres,
			(SELECT IFNULL(COUNT(run_trabajador),0) FROM trabajador WHERE genero_trabajador='Femenino') AS mujeres,
			(SELECT IFNULL(COUNT(run_trabajador),0) FROM trabajador WHERE genero_trabajador='Otro') AS otros
			FROM trabajador;";
            $consulta = $conn->prepare($sql);				
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			foreach ($resultado as $registros):
                array_push($this->trabajadores, array_map('utf8_encode',$registros));
            endforeach;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

    }






















	
	/*
    public function login() {
        $pdo = PDOConnection::instance();
        $conn = $pdo->getConnection();
        $consulta = $conn->prepare("SELECT * FROM " 
                                    . self::TABLA . 
                                    " usuario join perfil on usuario.id_perfil=perfil.id_perfil 
                                    where usuario.nombre=:nombre 
                                    OR usuario.correo=:nombre");
        $consulta->bindParam(':nombre', $this->nombre);
        $consulta->execute();
        $row = $consulta->fetch();
        $this->row[] = $row;
        $conn = null;
        $consulta = null;
    }// Cierra login()   
*/


}// Cierra clase TrabajadorM.php