<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Modelo
$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/connection/PDOConnection.php';
require_once $ruta_raiz . '/controller/EncriptadorC.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require $ruta_raiz . '/assets/vendor/phpmailer/src/Exception.php';
require $ruta_raiz . '/assets/vendor/phpmailer/src/PHPMailer.php';
require $ruta_raiz . '/assets/vendor/phpmailer/src/SMTP.php';
//Dentro de Modelo

/* $t = new TrabajadorM();
$t->setRun_trabajador('193412130');
$t->mostrar_datos_trabajador();
var_dump($t->getTrabajador());   */

/* $t = new TrabajadorM();
$t->enviarCorreo("braulio.briones@gmail.com", "Braulio Briones", "19.341.213-0", "1234");  */

//Clase
class TrabajadorM
{

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
    public function __construct()
    {
    }

    //Get and Set Atributos Tabla Trabajador
    //Get and Set Atributos Tabla Trabajador
    //Get and Set Atributos Tabla Trabajador
    public function getRun_trabajador()
    {
        return $this->run_trabajador;
    }

    public function setRun_trabajador($run_trabajador)
    {
        $this->run_trabajador = $run_trabajador;
    }

    public function getContrasena_trabajador()
    {
        return $this->contrasena_trabajador;
    }

    public function setContrasena_trabajador($contrasena_trabajador)
    {
        $this->contrasena_trabajador = $contrasena_trabajador;
    }

    public function getNombres_trabajador()
    {
        return $this->nombres_trabajador;
    }

    public function setNombres_trabajador($nombres_trabajador)
    {
        $this->nombres_trabajador = $nombres_trabajador;
    }

    public function getApellidos_trabajador()
    {
        return $this->apellidos_trabajador;
    }

    public function setApellidos_trabajador($apellidos_trabajador)
    {
        $this->apellidos_trabajador = $apellidos_trabajador;
    }

    public function getFec_nac_trabajador()
    {
        return $this->fec_nac_trabajador;
    }

    public function setFec_nac_trabajador($fec_nac_trabajador)
    {
        $this->fec_nac_trabajador = $fec_nac_trabajador;
    }

    public function getGenero_trabajador()
    {
        return $this->genero_trabajador;
    }

    public function setGenero_trabajador($genero_trabajador)
    {
        $this->genero_trabajador = $genero_trabajador;
    }

    public function getPlaca_trabajador()
    {
        return $this->placa_trabajador;
    }

    public function setPlaca_trabajador($placa_trabajador)
    {
        $this->placa_trabajador = $placa_trabajador;
    }

    public function getSub_cargo_id_sub_cargo()
    {
        return $this->sub_cargo_id_sub_cargo;
    }

    public function setSub_cargo_id_sub_cargo($sub_cargo_id_sub_cargo)
    {
        $this->sub_cargo_id_sub_cargo = $sub_cargo_id_sub_cargo;
    }

    public function getEstado_civil_trabajador()
    {
        return $this->estado_civil_trabajador;
    }

    public function setEstado_civil_trabajador($estado_civil_trabajador)
    {
        $this->estado_civil_trabajador = $estado_civil_trabajador;
    }

    public function getDireccion_trabajador()
    {
        return $this->direccion_trabajador;
    }

    public function setDireccion_trabajador($direccion_trabajador)
    {
        $this->direccion_trabajador = $direccion_trabajador;
    }

    public function getComuna_id_comuna()
    {
        return $this->comuna_id_comuna;
    }

    public function setComuna_id_comuna($comuna_id_comuna)
    {
        $this->comuna_id_comuna = $comuna_id_comuna;
    }

    public function getTelefono_trabajador()
    {
        return $this->telefono_trabajador;
    }

    public function setTelefono_trabajador($telefono_trabajador)
    {
        $this->telefono_trabajador = $telefono_trabajador;
    }

    public function getCelular_trabajador()
    {
        return $this->celular_trabajador;
    }

    public function setCelular_trabajador($celular_trabajador)
    {
        $this->celular_trabajador = $celular_trabajador;
    }

    public function getEmail_trabajador()
    {
        return $this->email_trabajador;
    }

    public function setEmail_trabajador($email_trabajador)
    {
        $this->email_trabajador = $email_trabajador;
    }

    public function getFec_ing_emp_trabajador()
    {
        return $this->fec_ing_emp_trabajador;
    }

    public function setFec_ing_emp_trabajador($fec_ing_emp_trabajador)
    {
        $this->fec_ing_emp_trabajador = $fec_ing_emp_trabajador;
    }

    public function getFec_ing_sin_trabajador()
    {
        return $this->fec_ing_sin_trabajador;
    }

    public function setFec_ing_sin_trabajador($fec_ing_sin_trabajador)
    {
        $this->fec_ing_sin_trabajador = $fec_ing_sin_trabajador;
    }

    public function getTipo_usuario_id_tipo_usuario()
    {
        return $this->tipo_usuario_id_tipo_usuario;
    }

    public function setTipo_usuario_id_tipo_usuario($tipo_usuario_id_tipo_usuario)
    {
        $this->tipo_usuario_id_tipo_usuario = $tipo_usuario_id_tipo_usuario;
    }

    public function getEstado_trabajador_id_estado_trabajador()
    {
        return $this->estado_trabajador_id_estado_trabajador;
    }

    public function setEstado_trabajador_id_estado_trabajador($estado_trabajador_id_estado_trabajador)
    {
        $this->estado_trabajador_id_estado_trabajador = $estado_trabajador_id_estado_trabajador;
    }

    public function getCantidad_trabajadores()
    {
        return $this->cantidad_trabajadores;
    }

    public function setCantidad_trabajadores($cantidad_trabajadores)
    {
        $this->cantidad_trabajadores = $cantidad_trabajadores;
    }

    public function getTrabajadores()
    {
        return $this->trabajadores;
    }

    public function setTrabajadores($trabajadores)
    {
        $this->trabajadores = $trabajadores;
    }

    public function getTrabajador()
    {
        return $this->trabajador;
    }

    public function setTrabajador($trabajador)
    {
        $this->trabajador = $trabajador;
    }

    //Metodos
    //Metodos
    //Metodos
    //
    public function encontrar_trabajador()
    {

        try {
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
            if (!empty($resultado)) {
                //Usuario Existe
                return true;
            } else {
                //Usuario NO Existe
                return false;
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    } // Cierra encontrar_trabajador

    public function encontrarTconImagen()
    {
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT url_foto_perfil FROM foto_perfil WHERE trabajador_run_trabajador=:run_trabajador";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':run_trabajador', $this->run_trabajador);
            $consulta->execute();
            $resultado = $consulta->fetchColumn();
            if ($resultado) {
                $this->trabajador = $resultado;
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }

    public function contarTrabajores($accion, $objeto)
    {
        try {

            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT count(*) from trabajador ";
            if ($accion == "buscar"):
                $sql .= "WHERE run_trabajador LIKE concat('%', :texto, '%')
											OR nombres_trabajador LIKE concat('%', :texto, '%')";

            endif;

            $consulta = $conn->prepare($sql);
            if ($accion == "buscar"):
                $consulta->bindParam(':texto', $objeto);
            endif;
            $consulta->execute();
            $this->cantidad_trabajadores = $consulta->fetchColumn();
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    } // Cierra listar_trabajador

    public function filtrarTrabajadores($accion, $objeto, $pagina, $registrosPorPagina)
    {
        $this->trabajadores = array();
        $objeto = htmlspecialchars($objeto);
        $pagina = htmlspecialchars($pagina);
        $registrosPorPagina = htmlspecialchars($registrosPorPagina);
        $order = "";
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT run_trabajador,SUBSTRING_INDEX(nombres_trabajador, ' ', 1) AS nombres_trabajador
								FROM trabajador ";
            if ($accion != "todo"):
                if ($accion == "buscar"):
                    $sql .= "WHERE run_trabajador LIKE concat('%', :texto, '%')
														OR nombres_trabajador LIKE concat('%', :texto, '%')";
                elseif ($accion == "filtrar"):
                    if ($objeto == 'true'):
                        $order = "ORDER BY nombres_trabajador ASC";
                    else:
                        $order = "ORDER BY nombres_trabajador DESC";
                    endif;
                endif;
            else:
                $order = "ORDER BY nombres_trabajador ASC";
            endif;
            $this->contarTrabajores($accion, $objeto);
            $inicio = ($pagina - 1) * $registrosPorPagina;
            $fin = $registrosPorPagina;
            $sql .= $order . " LIMIT $inicio,  $fin ";

            $consulta = $conn->prepare($sql);
            if ($accion = "buscar"):
                $consulta->bindParam(':texto', $objeto);
            endif;
            $consulta->execute();
            $trabajadores = $consulta->fetchAll();
            for ($i = 0; $i < count($trabajadores); $i++) {
                array_push($this->trabajadores, array_map('utf8_encode', $trabajadores[$i]));
            }$conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }

    }

    public function mostrar_datos_trabajador()
    {
        $this->trabajador = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT
					f.url_foto_perfil,
                    f.estado_foto_perfil,
					tu.tipo_usuario,
					t.run_trabajador,
					t.email_trabajador,
					t.nombres_trabajador,
					t.apellidos_trabajador,
					t.placa_trabajador,
					c.id_cargo,
					sb.id_sub_cargo,
					c.nombre_cargo,
					sb.nombre_subcargo,
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
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->trabajador = array_map('utf8_encode', $resultado);
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    } // Cierra mostrar_datos_trabajador

    public function registrar_trabajador()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "INSERT INTO trabajador (run_trabajador,
											nombres_trabajador,
											apellidos_trabajador,
											sub_cargo_id_sub_cargo,
											contrasena_trabajador,
											comuna_id_comuna,
                                            email_trabajador,
											tipo_usuario_id_tipo_usuario,
											estado_trabajador_id_estado_trabajador)
					VALUES (:run_trabajador,
							:nombres_trabajador,
							:apellidos_trabajador,
							:sub_cargo_id_sub_cargo,
							:contrasena_trabajador,
							:comuna_id_comuna,
                            :email_trabajador,
							:tipo_usuario_id_tipo_usuario,
							:estado_trabajador_id_estado_trabajador);";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':run_trabajador', $this->run_trabajador);
            $consulta->bindParam(':nombres_trabajador', $this->nombres_trabajador);
            $consulta->bindParam(':apellidos_trabajador', $this->apellidos_trabajador);
            $consulta->bindValue(':sub_cargo_id_sub_cargo', null);
            $consulta->bindParam(':contrasena_trabajador', $this->contrasena_trabajador);
            $consulta->bindValue(':comuna_id_comuna', null);
            $consulta->bindValue(':email_trabajador', $this->email_trabajador);
            $consulta->bindParam(':tipo_usuario_id_tipo_usuario', $this->tipo_usuario_id_tipo_usuario);
            $consulta->bindValue(':estado_trabajador_id_estado_trabajador', $this->estado_trabajador_id_estado_trabajador);
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
    } // Cierra crear_trabajador

    public function actualizar_trabajador()
    {

        try {
            $cuerpo = null;
            $cleaned = array();
            $sql_rows = array();
            $values = array(
                "contrasena_trabajador" => $this->contrasena_trabajador,
                "nombres_trabajador" => $this->nombres_trabajador,
                "apellidos_trabajador" => $this->apellidos_trabajador,
                "fec_nac_trabajador" => $this->fec_nac_trabajador,
                "genero_trabajador" => $this->genero_trabajador,
                "placa_trabajador" => $this->placa_trabajador,
                "sub_cargo_id_sub_cargo" => $this->sub_cargo_id_sub_cargo,
                "estado_civil_trabajador" => $this->estado_civil_trabajador,
                "direccion_trabajador" => $this->direccion_trabajador,
                "comuna_id_comuna" => $this->comuna_id_comuna,
                "telefono_trabajador" => $this->telefono_trabajador,
                "celular_trabajador" => $this->celular_trabajador,
                "email_trabajador" => $this->email_trabajador,
                "fec_ing_emp_trabajador" => $this->fec_ing_emp_trabajador,
                "fec_ing_sin_trabajador" => $this->fec_ing_sin_trabajador,
                "tipo_usuario_id_tipo_usuario" => $this->tipo_usuario_id_tipo_usuario,
                "estado_trabajador_id_estado_trabajador" => $this->estado_trabajador_id_estado_trabajador,
                "cantidad_trabajadores" => $this->cantidad_trabajadores,
            );
            //limpiar listado y dejar solamente aquellos que no estan vacios
            foreach ($values as $key => $valor):
                if ($valor!=""):
                    $cleaned[$key] = $valor;
                endif;
            endforeach;
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $accion = "UPDATE trabajador SET ";

            //generar cuerpo de la consulta
            foreach ($cleaned as $key => $valor):
                $sql_rows[$key] = $key . "=:" . $key;
                reset($cleaned);
                end($cleaned);
                if ($key !== key($cleaned)):
                    $sql_rows[$key] .= ",";
                else:
                    $sql_rows[$key] .= " ";
                endif;
                $cuerpo .= $sql_rows[$key];
            endforeach;

            $clausula = "WHERE run_trabajador = :run_trabajador";

            $sql = $accion . $cuerpo . $clausula;
            $consulta = $conn->prepare($sql);

            //genera los parametros
            foreach ($cleaned as $key => &$valor):
                $consulta->bindParam(':' . $key, $valor);
            endforeach;
            $consulta->bindParam(':run_trabajador', $this->run_trabajador, PDO::PARAM_STR);
            if ($consulta->execute()):
                return true;
            else:
                return false;
            endif;

            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    }

    public function listar_trabajadores()
    {
        $this->trabajadores = array();
        try {
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

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }
    } // Cierra listar_trabajador

    public function eliminar_trabajador()
    {

        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "DELETE FROM trabajador
					WHERE run_trabajador=:run_trabajador;";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':run_trabajador', $this->run_trabajador);
            if ($consulta->execute()) {
                //Eliminado con éxito
                return true;
            } else {
                //Error
                return false;
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
            //return false;
        }

    }

    public function cantidad_miembros()
    {

        $this->trabajadores = array();
        try {
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
                array_push($this->trabajadores, array_map('utf8_encode', $registros));
            endforeach;
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }

    }

    public function login()
    {

        $this->trabajador = array();
        try {
            $pdo = PDOConnection::instance();
            $conn = $pdo->getConnection();
            $sql = "SELECT
					*
					FROM trabajador t
					WHERE t.run_trabajador=:run_trabajador;";
            $consulta = $conn->prepare($sql);
            $consulta->bindParam(':run_trabajador', $this->run_trabajador);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->trabajador = array_map('utf8_encode', $resultado);
            }
            $conn = null;
            $consulta = null;

        } catch (Exception $ex) {
            echo "Fallo: " . $ex->getMessage();
        }

    } // Cierra login()

    public function enviarCorreo($destinatario, $nombre, $rut, $clave)
    {

        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = "mail.sinabrinks.cl"; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = "no-reply@sinabrinks.cl"; // SMTP username
            $mail->Password = "Santiago2018"; // SMTP password
            $mail->SMTPSecure = "ssl"; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465; // TCP port to connect to

            //Recipients
            $mail->setFrom("no-reply@sinabrinks.cl", "no-reply@sinabrinks.cl");
            //$mail->setFrom('bbchsoluciones@gmail.com');
            //$mail->addAddress($destinatario, $destinatario);     // Add a recipient
            $mail->addAddress($destinatario); // Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'SINABRINKS';
            $body = '<!DOCTYPE html>
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <style type="text/css">
                    body {
                        margin: 0;
                        padding: 0;
                        min-width: 100%!important;
                        text-align: justify;
                    }

                    img {
                        height: auto;
                    }

                    .content {
                        width: 100%;
                        max-width: 600px;
                    }


                    .header {
                        padding: 20px;
                        font-weight: bold;
                        font-family: Sans-serif;
                        font-size: 25px;
                        border-bottom: 1px solid #f2eeed;
                    }

                    .innerpadding {
                        padding: 30px 30px 30px 30px;
                    }

                    .innerpadding2 {
                        padding: 20px;
                    }

                    .borderbottom {
                        border-bottom: 1px solid #f2eeed;
                    }

                    .subhead {
                        font-size: 15px;
                        color: #ffffff;
                        font-family: sans-serif;
                        letter-spacing: 10px;
                    }

                    .h1,
                    .h2,
                    .bodycopy {
                        color: #153643;
                        font-family: sans-serif;
                    }

                    .h1 {
                        font-size: 33px;
                        line-height: 38px;
                        font-weight: bold;
                    }

                    .h2 {
                        padding: 0 0 15px 0;
                        font-size: 20px;
                        line-height: 24px;
                        font-weight: bold;
                    }

                    .bodycopy {
                        font-size: 16px;
                        line-height: 22px;
                    }

                    .button {
                        text-align: center;
                        font-size: 18px;
                        font-family: sans-serif;
                        font-weight: bold;

                    }

                    .button a {
                        display: block;
                        padding: 10px 0;
                        margin-top: 20px;
                        background: #5f86e8;
                        color: #ffffff;
                        text-decoration: none;
                        width: 100%;
                    }

                    .footer {
                        padding: 20px 30px 15px 30px;
                    }

                    .footercopy {
                        font-family: sans-serif;
                        font-size: 14px;
                        color: #8e8e8e;
                    }

                    .footer a {
                        color: #8e8e8e;
                        text-decoration: none;
                    }

                    .label {
                        width: 100%;
                        padding: 10px 0;
                    }

                    .input {
                        border: 1px solid #f2eeed;
                        height: 30px;
                        width: 100%;
                        padding: 5px 20px;
                    }

                    .bordeSuperior {
                        border-top: 10px solid #5f86e8;
                    }

                    @media only screen and (max-width: 550px),
                    screen and (max-device-width: 550px) {
                        body[yahoo] .hide {
                            display: none!important;
                        }
                        body[yahoo] .buttonwrapper {
                            background-color: transparent!important;
                        }
                        body[yahoo] .button {
                            padding: 0px!important;
                        }
                        body[yahoo] .button a {
                            background-color: #e05443;
                            padding: 15px 15px 13px!important;
                        }
                    }
                </style>
            </head>

            <body yahoo bgcolor="#ededed">
                <table width="100%" bgcolor="#ededed" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <!--[if (gte mso 9)|(IE)]>
                  <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td>
                <![endif]-->
                            <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td bgcolor="#ededed" class="header">
                                        <table width="70" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="50">
                                                <td>
                                                    <font color="#5f86e8">SINABRINKS</font>
                                                </td>
                                            </tr>
                                        </table>
                                        <!--[if (gte mso 9)|(IE)]>
                        <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td>
                      <![endif]-->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bordeSuperior innerpadding borderbottom">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="h2">
                                                    Hola ' . $nombre . '!
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bodycopy" style="text-align: justify;">
                                                    Se ha vinculado una cuenta de usuario a tu RUT para que puedas ingresar al sistema.
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bodycopy innerpadding2" style="text-align: justify;">
                                        Tus datos para el inicio de sesion son los siguientes:
                                    </td>
                                </tr>
                                <tr>
                                    <td class="innerpadding borderbottom">
                                        <table class="col380" align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 300px;">
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td class="bodycopy label">
                                                                Identificador:
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="input">
                                                                ' . $rut . '
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bodycopy label">
                                                                Contraseña:
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="input">
                                                                ' . $clave . '
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="button" height="45">
                                                                <a href="http://localhost/sindicatouno/view/public/login.php">Iniciar Sesión</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>


                                        <!--[if (gte mso 9)|(IE)]>
                            </td>
                          </tr>
                      </table>
                      <![endif]-->
                                    </td>
                                </tr>
                                <tr>
                                    <td class="innerpadding bodycopy" style="text-align: justify;">
                                        Este correo fue generado de manera automática, agradecemos no responder al remitente que aparece en este mensaje, para mayor
                                        información comunicarse con la administración. Si usted no es el propietario del correo electrónico
                                        mencionado, por favor, ignore este mensaje.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="footer" bgcolor="#ededed">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" class="footercopy" style="text-align: center;">
                                                    Hecho por BBCHSOLUCIONES 2018. Todos los derechos reservados
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding: 20px 0 0 0;">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                                <a href="http://www.facebook.com/">
                                                                    Facebook
                                                                </a>
                                                            </td>
                                                            <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                                <a href="http://www.twitter.com/">
                                                                    Twitter
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                      </td>
                    </tr>
                </table>
                <![endif]-->
                        </td>
                    </tr>
                </table>
            </body>

            </html>';
            $mail->Body = $body;
            $mail->CharSet = 'UTF-8';
            if ($mail->send()):
                return true;
            else:
                return false;
            endif;

            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

        }
    } // cierra enviarCorreo()

} // Cierra clase TrabajadorM.php
