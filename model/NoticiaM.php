<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');


//Clase
class NoticiaM{

    private $id_noticia;
    private $titulo;
    private $cuerpo;
    private $fecha_publicacion;
    private $trabajador_run_trabajador;
	private $publicada;
	private $url_foto_noticia;
	//BD
	private $noticias;

    
    function __construct() {
    }
	public function getId_noticia(){
		return $this->id_noticia;
	}

	public function setId_noticia($id_noticia){
		$this->id_noticia = $id_noticia;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getCuerpo(){
		return $this->cuerpo;
	}

	public function setCuerpo($cuerpo){
		$this->cuerpo = $cuerpo;
	}

	public function getFecha_publicacion(){
		return $this->fecha_publicacion;
	}

	public function setFecha_publicacion($fecha_publicacion){
		$this->fecha_publicacion = $fecha_publicacion;
	}

	public function getTrabajador_run_trabajador(){
		return $this->trabajador_run_trabajador;
	}

	public function setTrabajador_run_trabajador($trabajador_run_trabajador){
		$this->trabajador_run_trabajador = $trabajador_run_trabajador;
	}

	public function getPublicada(){
		return $this->publicada;
	}

	public function setPublicada($publicada){
		$this->publicada = $publicada;
	}
	public function getUrl_foto_noticia(){
		return $this->url_foto_noticia;
	}

	public function setUrl_foto_noticia($url_foto_noticia){
		$this->url_foto_noticia = $url_foto_noticia;
	}

	//BD
	public function getNoticias(){
		return $this->noticias;
	}

	public function setNoticias($noticias){
		$this->noticias = $noticias;
	}

	//METODOS

	public function registrar_noticia() {		
		
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "INSERT INTO noticia	(titulo, 
										cuerpo,
										fecha_publicacion,
										trabajador_run_trabajador,
										publicada)
					VALUES (:titulo,
							:cuerpo,
							 now(),
							:run_trabajador,
							:publicada)";
			$consulta = $conn->prepare($sql);
			$consulta->bindParam(':titulo', $this->titulo);
			$consulta->bindParam(':cuerpo', $this->cuerpo);
			$consulta->bindValue(':run_trabajador', "186036336");
			$consulta->bindParam(':publicada', $this->publicada);
			if($consulta->execute()){
				$this->id_noticia = $conn->lastInsertId();
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
	function agregar_imagen(){

		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "INSERT INTO foto_noticia (url_foto_noticia,noticia_id_noticia)
					VALUES (:url_foto_noticia,:id_noticia)";
			$consulta = $conn->prepare($sql);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta->bindParam(':url_foto_noticia', $this->url_foto_noticia);
			$consulta->bindParam(':id_noticia', $this->id_noticia);
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
	public function mostrar_noticias() {	
		$this->noticias = array();
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			$sql = "SELECT 
					n.id_noticia,
					fn.url_foto_noticia,
					n.titulo,
					n.cuerpo,
					n.publicada,
					n.fecha_publicacion,
					t.nombres_trabajador
					FROM noticia n
					JOIN trabajador t
					ON n.trabajador_run_trabajador = t.run_trabajador
					JOIN foto_noticia fn
					ON n.id_noticia = fn.noticia_id_noticia;";
			$consulta = $conn->prepare($sql);		
			$consulta->execute();
			$resultado= $consulta->fetchAll();
			if($resultado):
				for ($i = 0; $i < count($resultado); $i++) {
					array_push($this->noticias, array_map("utf8_encode",$resultado[$i]));
				}
			endif;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }		
	}
   



}// Cierra clase regionM.php