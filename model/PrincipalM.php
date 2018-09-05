<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/connection/PDOConnection.php';

class PrincipalM
{

    private $id_texto;
    private $titulo_;
    private $descripcion_;
    private $categoria;
    private $alineacion_texto;
    private $animacion;
    private $color_fondo;
    private $color_texto;
    private $url_foto;
    private $principal;

    public function __construct()
    {
    }
    public function getId_texto(){
		return $this->id_texto;
	}

	public function setId_texto($id_texto){
		$this->id_texto = $id_texto;
	}

	public function getTitulo_(){
		return $this->titulo_;
	}

	public function setTitulo_($titulo_){
		$this->titulo_ = $titulo_;
	}

	public function getDescripcion_(){
		return $this->descripcion_;
	}

	public function setDescripcion_($descripcion_){
		$this->descripcion_ = $descripcion_;
	}

	public function getCategoria(){
		return $this->categoria;
	}

	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}

	public function getAlineacion_texto(){
		return $this->alineacion_texto;
	}

	public function setAlineacion_texto($alineacion_texto){
		$this->alineacion_texto = $alineacion_texto;
	}

	public function getAnimacion(){
		return $this->animacion;
	}

	public function setAnimacion($animacion){
		$this->animacion = $animacion;
	}

	public function getColor_fondo(){
		return $this->color_fondo;
	}

	public function setColor_fondo($color_fondo){
		$this->color_fondo = $color_fondo;
	}

	public function getColor_texto(){
		return $this->color_texto;
	}

	public function setColor_texto($color_texto){
		$this->color_texto = $color_texto;
	}

	public function getUrl_foto(){
		return $this->url_foto;
	}

	public function setUrl_foto($url_foto){
		$this->url_foto = $url_foto;
	}

	public function getPrincipal(){
		return $this->principal;
	}

	public function setPrincipal($principal){
		$this->principal = $principal;
    }
    
    public function mostrar_textos()
    {
        $this->principal = array();
        try {
            
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT
                    t.id_texto,
                    t.titulo_,
                    t.descripcion_,
                    t.categoria,
                    t.alineacion_texto,
                    t.animacion,
                    t.color_fondo,
                    t.color_texto,
                    f.url_foto
                    FROM texto t
                    LEFT JOIN foto_publica f
                    ON t.id_texto=f.id_texto
                    WHERE categoria=:categoria
                    ORDER BY id_texto";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(":categoria", $this->categoria);
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if ($resultado):
                for ($i = 0; $i < count($resultado); $i++) :
                    array_push($this->principal, array_map("utf8_encode", $resultado[$i]));
                endfor;
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
	}
	public function mostrar_texto()
    {
        $this->principal = array();
        try {
            
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT
                    t.id_texto,
                    t.titulo_,
                    t.descripcion_,
                    t.categoria,
                    t.alineacion_texto,
                    t.animacion,
                    t.color_fondo,
                    t.color_texto,
                    f.url_foto
                    FROM texto t
                    LEFT JOIN foto_publica f
                    ON t.id_texto=f.id_texto
                    WHERE t.id_texto=:id_texto";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(":id_texto", $this->id_texto);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($resultado):
                $this->principal = array_map("utf8_encode", $resultado);
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function registrar_texto()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "INSERT INTO texto	(titulo_,
										descripcion_,
										categoria,
										alineacion_texto,
										animacion,
                                        color_fondo,
                                        color_texto)
                VALUES  (:titulo_,
                        :descripcion_,
                        :categoria,
                        :alineacion_texto,
                        :animacion,
                        :color_fondo,
                        :color_texto)";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':titulo_', $this->titulo_);
            $consulta->bindParam(':descripcion_', $this->descripcion_);
            $consulta->bindValue(':categoria', $this->categoria);
            $consulta->bindParam(':alineacion_texto', $this->alineacion_texto);
            $consulta->bindParam(':animacion', $this->animacion);
            $consulta->bindParam(':color_fondo', $this->color_fondo);
            $consulta->bindParam(':color_texto', $this->color_texto);
            if ($consulta->execute()) {
                $this->id_texto = $conn->lastInsertId();
                return true;
            } else {
                //Error
                return false;
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }

    public function actualizar_texto()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "UPDATE texto SET titulo_=:titulo_,
										descripcion_=:descripcion_,
										categoria=:categoria,
                                        alineacion_texto=:alineacion_texto,
                                        animacion=:animacion,
                                        color_fondo=:color_fondo,
                                        color_texto=:color_texto
                                  WHERE id_texto=:id_texto";
                                    
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_texto', $this->id_texto);
            $consulta->bindParam(':titulo_', $this->titulo_);
            $consulta->bindParam(':descripcion_', $this->descripcion_);
            $consulta->bindValue(':categoria', $this->categoria);
            $consulta->bindParam(':alineacion_texto', $this->alineacion_texto);
            $consulta->bindParam(':animacion', $this->animacion);
            $consulta->bindParam(':color_fondo', $this->color_fondo);
            $consulta->bindParam(':color_texto', $this->color_texto);
            if ($consulta->execute()) {
                return true;
            } else {
                //Error
                return false;
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function eliminar_texto()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql =  "DELETE FROM texto 
                                     WHERE id_texto=:id_texto";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_texto', $this->id_texto);
            if ($consulta->execute()) {
                return true;
            } else {
                //Error
                return false;
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }

    }

    public function agregar_imagen($accion)
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            if($accion!=="update"):
            $sql = "INSERT INTO foto_publica (url_foto,id_texto)
                    VALUES (:url_foto,:id_texto)";
            else:
            $sql =  "UPDATE foto_publica SET   url_foto=:url_foto
                                     WHERE id_texto=:id_texto";
            endif;
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':url_foto', $this->url_foto);
            $consulta->bindParam(':id_texto', $this->id_texto);
            if ($consulta->execute()) {
                //Registrado con éxito
                return true;
            } else {
                //Error
                return false;
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }

    }
    public function eliminar_imagen()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql =  "DELETE FROM foto_publica
                                     WHERE id_texto=:id_texto";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_texto', $this->id_texto);
            if ($consulta->execute()) {
                $nombre_imagen = basename(parse_url($this->url_foto)['path']); 
                 unlink("../assets/images/".$nombre_imagen);
                return true;
            } else {
                //Error
                return false;
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }

    }
}
    