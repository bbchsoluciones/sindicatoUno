<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/connection/PDOConnection.php';

class GaleriaM
{

    private $id_foto_galeria;
    private $url_foto_galeria;
    private $trabajador_run_trabajador;
    private $destacado;
    private $galeria;
    private $total_destacado;

    public function __construct()
    {
    }

    public function getId_foto_galeria()
    {
        return $this->id_foto_galeria;
    }

    public function setId_foto_galeria($id_foto_galeria)
    {
        $this->id_foto_galeria = $id_foto_galeria;
    }

    public function getUrl_foto_galeria()
    {
        return $this->url_foto_galeria;
    }

    public function setUrl_foto_galeria($url_foto_galeria)
    {
        $this->url_foto_galeria = $url_foto_galeria;
    }

    public function getTrabajador_run_trabajador()
    {
        return $this->trabajador_run_trabajador;
    }

    public function setTrabajador_run_trabajador($trabajador_run_trabajador)
    {
        $this->trabajador_run_trabajador = $trabajador_run_trabajador;
    }

    public function getDestacado()
    {
        return $this->destacado;
    }

    public function setDestacado($destacado)
    {
        $this->destacado = $destacado;
    }
    public function getGaleria()
    {
        return $this->galeria;
    }

    public function setGaleria($galeria)
    {
        $this->galeria = $galeria;
    }
    public function getTotal_destacado()
    {
        return $this->total_destacado;
    }

    public function setTotal_destacado($total_destacado)
    {
        $this->total_destacado = $total_destacado;
    }
    public function mostrar_galeria()
    {
        $this->galeria = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT * FROM foto_galeria";
            $consulta = $conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if ($resultado):
                for ($i = 0; $i < count($resultado); $i++) {
                    array_push($this->galeria, array_map("utf8_encode", $resultado[$i]));
                }
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function mostrar_galeria_top()
    {
        $this->galeria = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT * FROM foto_galeria WHERE destacado=1 ORDER BY id_foto_galeria DESC";
            $consulta = $conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if ($resultado):
                for ($i = 0; $i < count($resultado); $i++) {
                    array_push($this->galeria, array_map("utf8_encode", $resultado[$i]));
                }
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function mostrar_galeria_normal()
    {
        $this->galeria = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT * FROM foto_galeria WHERE destacado!=1 ORDER BY id_foto_galeria DESC";
            $consulta = $conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if ($resultado):
                for ($i = 0; $i < count($resultado); $i++) {
                    array_push($this->galeria, array_map("utf8_encode", $resultado[$i]));
                }
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function mostrar_imagen()
    {
        $this->galeria = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT * FROM foto_galeria WHERE id_foto_galeria=:id_foto_galeria";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_foto_galeria', $this->id_foto_galeria);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($resultado):
                $this->galeria = array_map("utf8_encode", $resultado);
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function contador_destacado()
    {
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT count(*) FROM foto_galeria WHERE destacado=1";
            $consulta = $conn->prepare($sql);
            $consulta->execute();
            $this->total_destacado = $consulta->fetchColumn();
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function actualizar_destacado()
    {
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "UPDATE foto_galeria
                        SET     destacado=:destacado
                        WHERE   id_foto_galeria=:id_foto_galeria";

            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_foto_galeria', $this->id_foto_galeria);
            $consulta->bindValue(':destacado', $this->destacado);
            if ($consulta->execute()):
                return true;
            else:
                return false;
            endif;
            $conn = null;
            $consulta = null;
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
            $sql = "DELETE FROM foto_galeria
                                     WHERE id_foto_galeria=:id_foto_galeria";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_foto_galeria', $this->id_foto_galeria);
            if ($consulta->execute()) {
                $nombre_imagen = basename(parse_url($this->url_foto_galeria)['path']);
                unlink("../assets/images/galeria/" . $nombre_imagen);
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

    public function agregar_imagen()
    {
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "INSERT INTO foto_galeria
                                (url_foto_galeria,
                                trabajador_run_trabajador,
                                destacado)
                        VALUES
                                (:url_foto_galeria,
                                :trabajador_run_trabajador,
                                :destacado)";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':trabajador_run_trabajador', $this->trabajador_run_trabajador);
            $consulta->bindValue(':url_foto_galeria', $this->url_foto_galeria);
            $consulta->bindValue(':destacado', $this->destacado);
            if ($consulta->execute()):
                return true;
            else:
                return false;
            endif;
            $conn = null;
            $consulta = null;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }

    }

} //Cierra clase
