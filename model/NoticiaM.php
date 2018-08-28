<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/connection/PDOConnection.php';

//Clase
class NoticiaM
{

    private $id_noticia;
    private $titulo;
    private $cuerpo;
    private $fecha_publicacion;
    private $trabajador_run_trabajador;
    private $publicada;
    private $url_foto_noticia;
    //BD
    private $noticias;

    public function __construct()
    {
    }
    public function getId_noticia()
    {
        return $this->id_noticia;
    }

    public function setId_noticia($id_noticia)
    {
        $this->id_noticia = $id_noticia;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getCuerpo()
    {
        return $this->cuerpo;
    }

    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;
    }

    public function getFecha_publicacion()
    {
        return $this->fecha_publicacion;
    }

    public function setFecha_publicacion($fecha_publicacion)
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    public function getTrabajador_run_trabajador()
    {
        return $this->trabajador_run_trabajador;
    }

    public function setTrabajador_run_trabajador($trabajador_run_trabajador)
    {
        $this->trabajador_run_trabajador = $trabajador_run_trabajador;
    }

    public function getPublicada()
    {
        return $this->publicada;
    }

    public function setPublicada($publicada)
    {
        $this->publicada = $publicada;
    }
    public function getUrl_foto_noticia()
    {
        return $this->url_foto_noticia;
    }

    public function setUrl_foto_noticia($url_foto_noticia)
    {
        $this->url_foto_noticia = $url_foto_noticia;
    }

    //BD
    public function getNoticias()
    {
        return $this->noticias;
    }

    public function setNoticias($noticias)
    {
        $this->noticias = $noticias;
    }

    //METODOS

    public function registrar_noticia()
    {

        try {
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
            $consulta->bindValue(':run_trabajador', $this->trabajador_run_trabajador);
            $consulta->bindParam(':publicada', $this->publicada);
            if ($consulta->execute()) {
                $this->id_noticia = $conn->lastInsertId();
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

    public function actualizar_noticia()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "UPDATE noticia SET titulo=:titulo,
										cuerpo=:cuerpo,
										fecha_modificacion=now(),
                                        publicada=:publicada
                                  WHERE id_noticia=:id_noticia";
                                    
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_noticia', $this->id_noticia);
            $consulta->bindParam(':titulo', $this->titulo);
            $consulta->bindParam(':cuerpo', $this->cuerpo);
            $consulta->bindParam(':publicada', $this->publicada);
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
            $sql = "INSERT INTO foto_noticia (url_foto_noticia,noticia_id_noticia)
                    VALUES (:url_foto_noticia,:id_noticia)";
            else:
            $sql =  "UPDATE foto_noticia SET   url_foto_noticia=:url_foto_noticia
                                     WHERE noticia_id_noticia=:id_noticia";
            endif;
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':url_foto_noticia', $this->url_foto_noticia);
            $consulta->bindParam(':id_noticia', $this->id_noticia);
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
            $sql =  "DELETE FROM foto_noticia
                                     WHERE noticia_id_noticia=:id_noticia";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_noticia', $this->id_noticia);
            if ($consulta->execute()) {
                $nombre_imagen = basename(parse_url($this->url_foto_noticia)['path']); 
                $split = explode(".", $nombre_imagen);
                $name = $split[0];
                $extension = $split[1];
                if(ctype_digit($name)):
                    unlink("../assets/images/".$nombre_imagen);
                endif;
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
    public function eliminar_noticia()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql =  "DELETE FROM noticia 
                                     WHERE id_noticia=:id_noticia";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_noticia', $this->id_noticia);
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
    public function mostrar_noticias()
    {
        setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
        $this->noticias = array();
        try {
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
					LEFT JOIN foto_noticia fn
					ON n.id_noticia = fn.noticia_id_noticia;";
            $consulta = $conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if ($resultado):
                foreach ($resultado as $key => $val) {
                    if ($val['fecha_publicacion']) {
                        $resultado[$key]['fecha_publicacion'] = strftime("%d %b %Y, %H:%m", strtotime($val['fecha_publicacion']));
                    }
                }
                for ($i = 0; $i < count($resultado); $i++) {
                    array_push($this->noticias, array_map("utf8_encode", $resultado[$i]));
                }
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function mostrar_noticia()
    {
        $this->noticias = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT
					n.id_noticia,
					fn.url_foto_noticia,
					n.titulo,
					n.cuerpo,
					n.publicada
					FROM noticia n
					JOIN trabajador t
					ON n.trabajador_run_trabajador = t.run_trabajador
					LEFT JOIN foto_noticia fn
                    ON n.id_noticia = fn.noticia_id_noticia
                    WHERE n.id_noticia = :id_noticia";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_noticia', $this->id_noticia);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($resultado):
                $resultado['cuerpo'] = htmlspecialchars_decode($resultado['cuerpo']);
                $this->noticias = array_map("utf8_encode", $resultado);
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }

} // Cierra clase regionM.php
