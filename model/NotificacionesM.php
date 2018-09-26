<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/connection/PDOConnection.php';

class NotificacionesM
{

    private $id_notificaciones;
    private $run_trabajador;
    private $visto;
    private $descripcion;
    private $fecha;
    private $notificaciones;

    public function getId_notificaciones()
    {
        return $this->id_notificaciones;
    }

    public function setId_notificaciones($id_notificaciones)
    {
        $this->id_notificaciones = $id_notificaciones;
    }

    public function getRun_trabajador()
    {
        return $this->run_trabajador;
    }

    public function setRun_trabajador($run_trabajador)
    {
        $this->run_trabajador = $run_trabajador;
    }

    public function getVisto()
    {
        return $this->visto;
    }

    public function setVisto($visto)
    {
        $this->visto = $visto;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function getNotificaciones()
    {
        return $this->notificaciones;
    }

    public function setNotificaciones($notificaciones)
    {
        $this->notificaciones = $notificaciones;
    }

    public function listar_notificaciones()
    {
        $this->notificaciones = array();
        try {

            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT * FROM notificaciones n 
                            INNER JOIN foto_perfil f
                    ON n.run_trabajador=f.trabajador_run_trabajador ";
            $consulta = $conn->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if ($resultado):
                for ($i = 0; $i < count($resultado); $i++):
                    array_push($this->notificaciones, array_map("utf8_encode", $resultado[$i]));
                endfor;
            endif;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }


    public function registrar_notificacion()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "INSERT INTO notificaciones 
                                (run_trabajador,
                                visto,
                                descripcion,
                                fecha)	
                VALUES  (:run_trabajador,
                        0,
                        :descripcion,
                        now())";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':run_trabajador', $this->run_trabajador);
            $consulta->bindValue(':descripcion', $this->descripcion);
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
    public function eliminar_notificacion()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "DELETE FROM notificaciones WHERE run_trabajador=:run_trabajador";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':run_trabajador', $this->run_trabajador);
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


}
