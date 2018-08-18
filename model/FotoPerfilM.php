<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/connection/PDOConnection.php');

class FotoPerfilM{

    
    private $url_foto_perfil;

	public function getUrl_foto_perfil(){
		return $this->url_foto_perfil;
	}

	public function setUrl_foto_perfil($url_foto_perfil){
		$this->url_foto_perfil = $url_foto_perfil;
	}

    function modificarFotoPerfil($accion,$rut){
		try{
			$pdo = PDOConnection::instance();
			$conn = $pdo->getConnection();
			if($accion=="update"):
                $sql = "UPDATE foto_perfil
                                    SET
                                            url_foto_perfil=:avatar,
                                            fec_subida_perfil=now()
                                    WHERE   trabajador_run_trabajador=:rut";
            else:

                $sql = "INSERT INTO foto_perfil
                                                (url_foto_perfil,
                                                trabajador_run_trabajador,
                                                fec_subida_perfil)
                                        VALUES
                                                (:avatar,
                                                :rut,
                                                now());";

            endif;
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta = $conn->prepare($sql);	
            $consulta->bindParam(':rut', $rut);
            $consulta->bindValue(':avatar', $this->url_foto_perfil);
			if($consulta->execute()):
				return true;
            else:
				return false;
			endif;
			$conn = null;
			$consulta = null;
			$conn = null;
			$consulta = null;

		}catch (Exception $ex) {
			echo "Fallo: " . $ex->getMessage();
        }	

    }

}//Cierra clase