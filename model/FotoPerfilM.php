<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/connection/PDOConnection.php';

class FotoPerfilM
{

    private $id_foto_perfil;
    private $url_foto_perfil;
    private $estado_foto_perfil;
    private $observacion;
    private $trabajador_run_trabajador;
    private $fotos;

    public function getId_foto_perfil()
    {
        return $this->id_foto_perfil;
    }

    public function setId_foto_perfil($id_foto_perfil)
    {
        $this->id_foto_perfil = $id_foto_perfil;
    }
    public function getUrl_foto_perfil()
    {
        return $this->url_foto_perfil;
    }

    public function setUrl_foto_perfil($url_foto_perfil)
    {
        $this->url_foto_perfil = $url_foto_perfil;
    }

    public function getEstado_foto_perfil()
    {
        return $this->estado_foto_perfil;
    }

    public function setEstado_foto_perfil($estado_foto_perfil)
    {
        $this->estado_foto_perfil = $estado_foto_perfil;
    }

    public function getObservacion()
    {
        return $this->observacion;
    }

    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    }
    public function getTrabajador_run_trabajador()
    {
        return $this->trabajador_run_trabajador;
    }

    public function setTrabajador_run_trabajador($trabajador_run_trabajador)
    {
        $this->trabajador_run_trabajador = $trabajador_run_trabajador;
    }
    public function getFotos()
    {
        return $this->fotos;
    }

    public function setFotos($fotos)
    {
        $this->fotos = $fotos;
    }
    public function modificarFotoPerfil($accion)
    {
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            if ($accion == "update"):
                $sql = "UPDATE foto_perfil  SET     url_foto_perfil=:avatar,
                                                    fec_subida_perfil=now(),
                                                    estado_foto_perfil=:estado_foto_perfil,
                                                    observacion=NULL
                                            WHERE   trabajador_run_trabajador=:rut";
            else:

                $sql = "INSERT INTO foto_perfil
                                                (url_foto_perfil,
                                                trabajador_run_trabajador,
                                                fec_subida_perfil,
                                                estado_foto_perfil)
                                        VALUES
                                                (:avatar,
                                                :rut,
                                                now(),
                                                :estado_foto_perfil);";

            endif;
/*             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); */
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':rut', $this->trabajador_run_trabajador);
            $consulta->bindValue(':avatar', $this->url_foto_perfil);
            $consulta->bindValue(':estado_foto_perfil', $this->estado_foto_perfil);
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
    public function listar_solicitudes_pendientes()
    {
        $this->fotos = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT f.id_foto_perfil,
                            f.url_foto_perfil,
                            t.run_trabajador,
                            t.nombres_trabajador
                    FROM foto_perfil f
                    JOIN trabajador t ON f.trabajador_run_trabajador=t.run_trabajador
                    WHERE f.estado_foto_perfil = 'pendiente'";
            $consulta = $conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            for ($i = 0; $i < count($resultado); $i++) {
                array_push($this->fotos, array_map('utf8_encode', $resultado[$i]));
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function listar_solicitudes_historial()
    {
        $this->fotos = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT f.id_foto_perfil,
                            f.url_foto_perfil,
                            t.run_trabajador,
                            f.observacion,
                            f.estado_foto_perfil
                    FROM foto_perfil f
                    JOIN trabajador t ON f.trabajador_run_trabajador=t.run_trabajador
                    WHERE f.estado_foto_perfil = 'aprobada' OR f.estado_foto_perfil = 'rechazada'";
            $consulta = $conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            for ($i = 0; $i < count($resultado); $i++) {
                array_push($this->fotos, array_map('utf8_encode', $resultado[$i]));
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function detalle_solicitud()
    {
        $this->fotos = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT * FROm foto_perfil WHERE id_foto_perfil=:id_foto_perfil";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':id_foto_perfil', $this->id_foto_perfil);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->fotos = array_map("utf8_encode", $resultado);
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function detalle_solicitud_user()
    {
        $this->fotos = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT * FROm foto_perfil WHERE trabajador_run_trabajador=:trabajador_run_trabajador AND estado_foto_perfil='rechazada'";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':trabajador_run_trabajador', $this->trabajador_run_trabajador);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->fotos = array_map("utf8_encode", $resultado);
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }
    public function actualizar_solicitud()
    {

        try {
            $campo = "";
            $separador = " ";
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "UPDATE foto_perfil SET estado_foto_perfil=:estado_foto_perfil";
            if (!empty($this->observacion)):
                $campo = ",observacion=:observacion";
            endif;
            $where = "WHERE id_foto_perfil=:id_foto_perfil";
            $sql = $sql . $separador . $campo . $separador . $where;
            $consulta = $conn->prepare($sql);
            if (!empty($this->observacion)):
                $consulta->bindParam(':observacion', $this->observacion);
            endif;
            $consulta->bindParam(':id_foto_perfil', $this->id_foto_perfil);
            $consulta->bindParam(':estado_foto_perfil', $this->estado_foto_perfil);
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

} //Cierra clase
