<?php

if (!isset($_SESSION)):
    session_start(); //inicia sesion si está vacío
endif;

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/TrabajadorM.php';
require_once $ruta_raiz . '/model/subirImagenM.php';
require_once $ruta_raiz . '/model/FotoPerfilM.php';
require_once $ruta_raiz . '/model/NotificacionesM.php';
require $ruta_raiz . '/model/vendor/autoload.php';
require_once 'EncriptadorC.php';
error_reporting(E_ALL);
//MOSTRAR TRABAJORES CON/SIN FILTROS
$error = array();
$data = array();
$opcionales = array("email_trabajador", "telefono_trabajador");
$objeto = "";
if (isset($_GET['accion']) && !empty($_GET['accion'])):
    $trabajador = new TrabajadorM();
    if (isset($_GET['objeto'])):
        $objeto = $_GET['objeto'];
        if ($_GET['accion'] === "buscar" && ctype_digit(clean($_GET['objeto'])) == true):
            $objeto = clean($_GET['objeto']);
        endif;
    endif;
    $trabajador->filtrarTrabajadores($_GET['accion'], $objeto, $_GET['pagina'], $_GET['r_pagina']);
    if (!empty($trabajador->getTrabajadores())):
        $trabajadores = array(
            "trabajador" => array(
                $trabajador->getTrabajadores(),
            ),
            "cantidad_total" => array(
                $trabajador->getCantidad_trabajadores(),
            ),
            "accion" => array(
                "valor" => $_GET['accion'],
            ),
            "objeto" => array(
                "valor" => $objeto,
            ),
        );
        echo json_encode($trabajadores);
    else:
        $error['titulo'] = "No se han encontrado registros.";
        echo json_encode($error);
    endif;
// FIN MOSTRAR TRABAJORES CON/SIN FILTROS

// MOSTRAR DATOS DEL TRABAJADOR
elseif (isset($_GET['run_trabajador']) && !empty($_GET['run_trabajador']) && isset($_GET['detalle'])):

    $trabajador = new TrabajadorM();
    $rut = clean($_GET['run_trabajador']);
    if (esRut($rut)):
        $trabajador->setRun_trabajador($rut);
        $trabajador->mostrar_datos_trabajador();
        if (!empty($trabajador->getTrabajador())):
            $perfilUser = $trabajador->getTrabajador();
            $foto = "";
            foreach ($perfilUser as $index => $row):
                if ($index == 'estado_foto_perfil' && $row == "rechazada"):
                    $foto = "";
                elseif ($index == 'estado_foto_perfil' && $row == "aprobada"):
                    $foto = $perfilUser['url_foto_perfil'];
                endif;
            endforeach;
            $perfilUser['url_foto_perfil'] = $foto;
            $trabajadores = array(
                "trabajador" => array(
                    $perfilUser,
                ),
            );
            echo json_encode($trabajadores);
        else:
            $error['titulo'] = "Rut invalido y/o trabajador no registrado.";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    else:
        $error['titulo'] = "No se han encontrado registros.";
        echo json_encode($error);
    endif;
// FIN MOSTRAR DATOS DEL TRABAJADOR

// REGISTRAR TRABAJADOR
elseif (isset($_POST['tipo_usuario']) &&
    isset($_POST['nombres_trabajador']) &&
    isset($_POST['apellidos_trabajador']) &&
    isset($_POST['contrasena_trabajador']) &&
    isset($_POST['run_trabajador']) &&
    isset($_POST['email']) &&
    isset($_POST['registrar'])):
    foreach ($_POST as $indice => $valor):
        if ($indice == 'run_trabajador' && esRut($valor) == false):
            $valor = "Rut invalido";
            $error[$indice] = $valor;
        endif;
        if (empty(trim($valor))):
            if($indice != 'email'):
                $valor = "Campo vacío, favor completar";
                $error[$indice] = $valor;
            endif;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;
    if(!empty(trim($_POST['email']))):
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):
            $valor = "Correo inválido, favor verificar";
            $error['email'] = $valor;
        endif;
    endif;
    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $data['run_trabajador'] = clean($data['run_trabajador']);
        $encriptador = new EncriptadorC($data['contrasena_trabajador']);
        $data['contrasena_trabajador'] = $encriptador->getClave();
        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($data['run_trabajador']);
        $trabajador->setNombres_trabajador($data['nombres_trabajador']);
        $trabajador->setApellidos_trabajador($data['apellidos_trabajador']);
        $trabajador->setContrasena_trabajador($data['contrasena_trabajador']);
        $trabajador->setTipo_usuario_id_tipo_usuario($data['tipo_usuario']);
        $trabajador->setEstado_trabajador_id_estado_trabajador(1);
        if(!empty(trim($_POST['email']))):
            $trabajador->setEmail_trabajador($_POST['email']);
        else:
            $trabajador->setEmail_trabajador(null);
        endif;        
        if ($trabajador->registrar_trabajador()):
            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Trabajador registrado correctamente.";
            $error['clase'] = "success";
            if($trabajador->getEmail_trabajador() != null):
                $nombres = explode(" ", $trabajador->getNombres_trabajador());
                if($trabajador->enviarCorreo($trabajador->getEmail_trabajador(), $nombres[0], $trabajador->getRun_trabajador(), $_POST['contrasena_trabajador'])):
                    $error['mensaje'] = "Trabajador registrado correctamente. Correo enviado.";
                else:
                    $error['mensaje'] = "Trabajador registrado correctamente. Correo NO enviado.";
                endif;
            endif;
            echo json_encode($error);
        else:
            $error['titulo'] = "Oops hubo un error!";
            $error['mensaje'] = "El rut ingresado ya existe.";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;
    endif;
// FIN REGISTRAR TRABAJADOR

// MODIFICAR TRABAJADOR
elseif (isset($_POST['tipo_usuario']) &&
    isset($_POST['email_trabajador']) &&
    isset($_POST['nombres_trabajador']) &&
    isset($_POST['apellidos_trabajador']) &&
    isset($_POST['nombre_cargo']) &&
    isset($_POST['nombre_subcargo']) &&
    isset($_POST['contrasena_trabajador']) &&
    isset($_POST['vcontrasena_trabajador']) &&
    isset($_POST['direccion_trabajador']) &&
    isset($_POST['nombre_comuna']) &&
    isset($_POST['fec_nac_trabajador']) &&
    isset($_POST['genero_trabajador']) &&
    isset($_POST['estado_civil_trabajador']) &&
    isset($_POST['fec_ing_emp_trabajador']) &&
    isset($_POST['fec_ing_sin_trabajador']) &&
    isset($_POST['estado_trabajador']) &&
    isset($_POST['telefono_trabajador']) &&
    isset($_POST['celular_trabajador']) &&
    isset($_POST['run_trabajador']) &&
    isset($_POST['actualizar'])):

    $imagen = "";
    foreach ($_POST as $indice => $valor):
        if (strpos($indice, 'fec') !== false && !empty($valor)):
            $date = clean($valor);
            if (is_numeric($date)):
                if (strpos($valor, '-')):
                    $valor = str_replace("-", "/", $valor);
                endif;
                $fecha = explode("/", $valor);
                if (checkdate($fecha[1], $fecha[0], $fecha[2])):
                    try {
                        $valor = DateTime::createFromFormat('d/m/Y', $valor);
                        $valor = $valor->format('Y-m-d');
                    } catch (Exception $e) {
                        $valor = "Fecha invalida, formato Dia/Mes/Año";
                        $error[$indice] = $valor;
                    } else :
                    $valor = "Fecha invalida, formato Dia/Mes/Año";
                    $error[$indice] = $valor;
                endif;

            else:
                $valor = "Fecha invalida, formato Dia/Mes/Año";
                $error[$indice] = $valor;
            endif;
        elseif ($indice === 'run_trabajador'):
            $valor = clean($valor);
        endif;
        if (empty(trim($valor)) && $indice !== "estado_trabajador"):
            $valor = null;
            unset($error[$valor]);
            $data[$indice] = null;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    /* f (array_key_exists('contrasena_trabajador', $error) && array_key_exists('vcontrasena_trabajador', $error)):
    $data['contrasena_trabajador'] = "nula";
    $data['vcontrasena_trabajador'] = "nula";
    unset($error['contrasena_trabajador']);
    unset($error['vcontrasena_trabajador']); */
    if ($data['contrasena_trabajador'] !== $data['vcontrasena_trabajador']):
        $error['contrasena_trabajador'] = "Contraseñas no coinciden";
        $error['vcontrasena_trabajador'] = "Contraseñas no coinciden";
    elseif ($data['contrasena_trabajador'] == $data['vcontrasena_trabajador'] &&
    !empty($data['contrasena_trabajador']) && !empty($data['vcontrasena_trabajador'])):
        $encriptador = new EncriptadorC($data['contrasena_trabajador']);
        $data['contrasena_trabajador'] = $encriptador->getClave();
    endif;

    //validación placa vigilante
    if ($data['nombre_cargo'] == "3" && ctype_digit($data['placa_trabajador']) == false
    || $data['nombre_cargo'] == "3" && empty($data['placa_trabajador'])):
        $error['placa_trabajador'] = "Formato incorrecto o vacío";
    elseif ($data['nombre_cargo'] !== "3"):
        $data['placa_trabajador'] = null;
    endif;

    //validación email
    if (!filter_var($data['email_trabajador'], FILTER_VALIDATE_EMAIL) && !empty($data['email_trabajador'])):
        $error['email_trabajador'] = "Correo invalido!";
    endif;

    if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])):
        $subir = new imgUpldr;
        $subir->__set("_new_name", date("Ymdhis"));
        $subir->__set("_dest", "../assets/images/avatar/");
        $imagen = $subir->init($_FILES['avatar']);
        $avatar = "http://localhost/sindicatoUno/assets/images/avatar/" . $subir->_name;
        if (!empty($imagen)):
            $error['avatar'] = $imagen;
        endif;

    endif;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:

        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($data['run_trabajador']);
        $trabajador->setTipo_usuario_id_tipo_usuario($data['tipo_usuario']);
        $trabajador->setEmail_trabajador($data['email_trabajador']);
        $trabajador->setNombres_trabajador($data['nombres_trabajador']);
        $trabajador->setApellidos_trabajador($data['apellidos_trabajador']);
        $trabajador->setSub_cargo_id_sub_cargo($data['nombre_subcargo']);
        $trabajador->setContrasena_trabajador($data['contrasena_trabajador']);
        $trabajador->setDireccion_trabajador($data['direccion_trabajador']);
        $trabajador->setComuna_id_comuna($data['nombre_comuna']);
        $trabajador->setFec_nac_trabajador($data['fec_nac_trabajador']);
        $trabajador->setPlaca_trabajador($data['placa_trabajador']);
        $trabajador->setGenero_trabajador($data['genero_trabajador']);
        $trabajador->setEstado_civil_trabajador($data['estado_civil_trabajador']);
        $trabajador->setFec_ing_emp_trabajador($data['fec_ing_emp_trabajador']);
        $trabajador->setFec_ing_sin_trabajador($data['fec_ing_sin_trabajador']);
        $trabajador->setEstado_trabajador_id_estado_trabajador($data['estado_trabajador']);
        $trabajador->setTelefono_trabajador($data['telefono_trabajador']);
        $trabajador->setCelular_trabajador($data['celular_trabajador']);
        if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])):
            $accion = "";
            $foto = new FotoPerfilM();
            $trabajador->encontrarTconImagen();
            $foto->setUrl_foto_perfil($avatar);
            $foto->setTrabajador_run_trabajador($data['run_trabajador']);
            $foto->setEstado_foto_perfil("aprobada");
            $trabajador->encontrarTconImagen();
            $old_imagen = $trabajador->getTrabajador();
            if (!empty($old_imagen)):
                $nombre_imagen = basename(parse_url($old_imagen)['path']);
                unlink("../assets/images/avatar/" . $nombre_imagen);
                $accion = "update";
            else:
                $accion = "insert";
            endif;
            $foto->modificarFotoPerfil($accion);
        endif;
        if ($trabajador->actualizar_trabajador()):
            $n = new NotificacionesM();
            $n->setRun_trabajador($data['run_trabajador']);
            $n->setTipo("user");
            $n->eliminar_notificacion();

            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Información actualiza correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        endif;
    endif;
// FIN MODIFICAR TRABAJADOR

// MODIFICAR TRABAJADOR USER
elseif (isset($_POST['email_trabajador']) &&
    isset($_POST['nombres_trabajador']) &&
    isset($_POST['apellidos_trabajador']) &&
    isset($_POST['nombre_cargo']) &&
    isset($_POST['nombre_subcargo']) &&
    isset($_POST['contrasena_trabajador']) &&
    isset($_POST['vcontrasena_trabajador']) &&
    isset($_POST['direccion_trabajador']) &&
    isset($_POST['nombre_comuna']) &&
    isset($_POST['fec_nac_trabajador']) &&
    isset($_POST['genero_trabajador']) &&
    isset($_POST['estado_civil_trabajador']) &&
    isset($_POST['fec_ing_emp_trabajador']) &&
    isset($_POST['fec_ing_sin_trabajador']) &&
    isset($_POST['telefono_trabajador']) &&
    isset($_POST['celular_trabajador']) &&
    isset($_POST['run_trabajador']) &&
    isset($_POST['actualizar'])):

    $imagen = "";
    foreach ($_POST as $indice => $valor):
        if (strpos($indice, 'fec') !== false && !empty($valor)):
            $date = clean($valor);
            if (is_numeric($date)):
                if (strpos($valor, '-')):
                    $valor = str_replace("-", "/", $valor);
                endif;
                $fecha = explode("/", $valor);
                if (checkdate($fecha[1], $fecha[0], $fecha[2])):
                    try {
                        $valor = DateTime::createFromFormat('d/m/Y', $valor);
                        $valor = $valor->format('Y-m-d');
                    } catch (Exception $e) {
                        $valor = "Fecha invalida, formato Dia/Mes/Año";
                        $error[$indice] = $valor;
                    } else :
                    $valor = "Fecha invalida, formato Dia/Mes/Año";
                    $error[$indice] = $valor;
                endif;

            else:
                $valor = "Fecha invalida, formato Dia/Mes/Año";
                $error[$indice] = $valor;
            endif;
        elseif ($indice === 'run_trabajador'):
            $valor = clean($valor);
        endif;
        if (empty(trim($valor)) && $indice !== "estado_trabajador"):
            $valor = null;
            unset($error[$valor]);
            $data[$indice] = null;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    /* f (array_key_exists('contrasena_trabajador', $error) && array_key_exists('vcontrasena_trabajador', $error)):
    $data['contrasena_trabajador'] = "nula";
    $data['vcontrasena_trabajador'] = "nula";
    unset($error['contrasena_trabajador']);
    unset($error['vcontrasena_trabajador']); */
    if ($data['contrasena_trabajador'] !== $data['vcontrasena_trabajador']):
        $error['contrasena_trabajador'] = "Contraseñas no coinciden";
        $error['vcontrasena_trabajador'] = "Contraseñas no coinciden";
    elseif ($data['contrasena_trabajador'] == $data['vcontrasena_trabajador'] &&
    !empty($data['contrasena_trabajador']) && !empty($data['vcontrasena_trabajador'])):
        $encriptador = new EncriptadorC($data['contrasena_trabajador']);
        $data['contrasena_trabajador'] = $encriptador->getClave();
    endif;

    //validación placa vigilante
    if ($data['nombre_cargo'] == "3" && ctype_digit($data['placa_trabajador']) == false
    || $data['nombre_cargo'] == "3" && empty($data['placa_trabajador'])):
        $error['placa_trabajador'] = "Formato incorrecto o vacío";
    elseif ($data['nombre_cargo'] !== "3"):
        $data['placa_trabajador'] = null;
    endif;

    //validación email
    if (!filter_var($data['email_trabajador'], FILTER_VALIDATE_EMAIL) && !empty($data['email_trabajador'])):
        $error['email_trabajador'] = "Correo invalido!";
    endif;

    if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])):
        $subir = new imgUpldr;
        $subir->__set("_new_name", date("Ymdhis"));
        $subir->__set("_dest", "../assets/images/avatar/");
        $imagen = $subir->init($_FILES['avatar']);
        $avatar = "http://localhost/sindicatoUno/assets/images/avatar/" . $subir->_name;
        if (!empty($imagen)):
            $error['avatar'] = $imagen;
        endif;

    endif;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($data['run_trabajador']);
        $trabajador->setTipo_usuario_id_tipo_usuario($_SESSION['tipo_usuario']);
        $trabajador->setEmail_trabajador($data['email_trabajador']);
        $trabajador->setNombres_trabajador($data['nombres_trabajador']);
        $trabajador->setApellidos_trabajador($data['apellidos_trabajador']);
        $trabajador->setSub_cargo_id_sub_cargo($data['nombre_subcargo']);
        $trabajador->setContrasena_trabajador($data['contrasena_trabajador']);
        $trabajador->setDireccion_trabajador($data['direccion_trabajador']);
        $trabajador->setComuna_id_comuna($data['nombre_comuna']);
        $trabajador->setFec_nac_trabajador($data['fec_nac_trabajador']);
        $trabajador->setPlaca_trabajador($data['placa_trabajador']);
        $trabajador->setGenero_trabajador($data['genero_trabajador']);
        $trabajador->setEstado_civil_trabajador($data['estado_civil_trabajador']);
        $trabajador->setFec_ing_emp_trabajador($data['fec_ing_emp_trabajador']);
        $trabajador->setFec_ing_sin_trabajador($data['fec_ing_sin_trabajador']);
        $trabajador->setTelefono_trabajador($data['telefono_trabajador']);
        $trabajador->setCelular_trabajador($data['celular_trabajador']);
        $uploaded = false;
        if (isset($_FILES['avatar']['name']) && !empty($_FILES['avatar']['name'])):
            $accion = "";
            $estado = "";
            $foto = new FotoPerfilM();
            $foto->setUrl_foto_perfil($avatar);
            $foto->setTrabajador_run_trabajador($data['run_trabajador']);
            if ($_SESSION['tipo_usuario'] != 1):
                $estado = "pendiente";
            else:
                $estado = "aprobada";
            endif;
            $foto->setEstado_foto_perfil($estado);
            $trabajador->encontrarTconImagen();
            $old_imagen = $trabajador->getTrabajador();
            if (!empty($old_imagen)):
                $nombre_imagen = basename(parse_url($old_imagen)['path']);
                unlink("../assets/images/avatar/" . $nombre_imagen);
                $accion = "update";
            else:
                $accion = "insert";
            endif;
            $uploaded = $foto->modificarFotoPerfil($accion);
        endif;
        if ($trabajador->actualizar_trabajador()):
            if ($uploaded && $_SESSION['tipo_usuario'] != 1):
                $n = new NotificacionesM();
                $n->setRun_trabajador($data['run_trabajador']);
                $n->setDescripcion("Solicitud pendiente");
                $n->setTipo("user");
                $n->eliminar_notificacion();
                $n->setTipo("admin");
                $n->eliminar_notificacion();
                $n->registrar_notificacion();
                $options = array(
                    'cluster' => 'us2',
                    'useTLS' => false,
                );
                $pusher = new Pusher\Pusher(
                    '007aa358a604a98ed413',
                    '00e69b3c91fd9e02248f',
                    '605862',
                    $options
                );
                $notificacion['title'] = 'Solicitud pendiente';
                $notificacion['message'] = "Trabajador: " . $data['nombres_trabajador'];
                $notificacion['image'] = $avatar;
                $notificacion['url'] = 'http://localhost/sindicatoUno/view/intranet/admin/imageApproval.php';
                $pusher->trigger('my-channel', 'my-event', $notificacion);
            endif;

            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Información actualiza correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        endif;
    endif;
// MODIFICAR TRABAJADOR USER

// ELIMINAR TRABAJADOR

elseif (isset($_GET['run_trabajador']) && !empty($_GET['run_trabajador']) && isset($_GET['eliminar'])):

    $trabajador = new TrabajadorM();
    $eliminado = array();
    $rut = htmlspecialchars($_GET['run_trabajador']);
    $rut = clean($rut);
    $trabajador->setRun_trabajador($rut);
    $existT = $trabajador->encontrar_trabajador();
    if ($existT == true):
        if ($trabajador->eliminar_trabajador()):
            $eliminado['titulo'] = "Éxito!";
            $eliminado['mensaje'] = "usuario eliminado satisfactoriamente.";
            $eliminado['clase'] = "success";
            echo json_encode($eliminado);
        else:
            $eliminado['titulo'] = "Oops!";
            $eliminado['mensaje'] = "el usuario no ha podido ser eliminado.";
            $eliminado['clase'] = "danger";
            echo json_encode($eliminado);
        endif;

    else:
        echo "trabajador no existe";
    endif;
// FIN ELIMINAR TRABAJADOR
    // INTRANET USER MOSTRAR DATOS TRABAJADOR
elseif (isset($_POST['ajax']) && isset($_POST['mostrarDatosTrabajador']) && isset($_POST['run_trabajador'])):

    $run = $_POST['run_trabajador'];
    $t = new TrabajadorM();
    $t->setRun_trabajador($run);
    $t->mostrar_datos_trabajador();
    //var_dump($t->getTrabajador());
    if (!empty($t->getTrabajador())):
        $t = array("data" => $t->getTrabajador());
        echo json_encode($t);
    else:
        $t = array("data" => "");
        echo json_encode($t);
    endif;
elseif (isset($_POST['destinatario']) && isset($_POST['nombre']) && isset($_POST['rut']) && isset($_POST['pass'])):
    $destinatario = $_POST['destinatario'];
    $nombre = $_POST['nombre'];
    $rut = $_POST['rut'];
    $pass = $_POST['pass'];
    $t = new TrabajadorM();
    if ($t->enviarCorreo($destinatario, $nombre, $rut, $pass)):
        echo "true";
    else:
        echo "false";
    endif;
//SOLICITUDES
elseif (isset($_GET['solicitudes_pendientes'])):
    $error = array();
    $perfil = new FotoPerfilM();
    $perfil->listar_solicitudes_pendientes();
    if (!empty($perfil->getFotos())):
        $perfil = $perfil->getFotos();
        echo json_encode($perfil);
    else:
        $error['mensaje'] = "No se encontraron solicitudes pendientes";
        echo json_encode($error);
    endif;
elseif (isset($_GET['solicitudes_historial'])):
    $error = array();
    $class = null;
    $perfil = new FotoPerfilM();
    $perfil->listar_solicitudes_historial();
    if (!empty($perfil->getFotos())):
        $perfilUser = $perfil->getFotos();
        foreach ($perfilUser as $index => $value):
            if ($perfilUser[$index]['estado_foto_perfil'] == "aprobada"):
                $class = "fa fa-check";
            else:
                $class = "fas fa-times";
            endif;
            $perfilUser[$index]['estado_foto_perfil'] = $class;
        endforeach;
        echo json_encode($perfilUser);
    else:
        $error['mensaje'] = "No se encontraron registros";
        echo json_encode($error);
    endif;
elseif (isset($_GET['solicitudes_historial_user'])):
    $error = array();
    $class = null;
    $perfil = new FotoPerfilM();
    $perfil->setTrabajador_run_trabajador($_SESSION['run_trabajador']);
    $perfil->detalle_solicitud_user();
    if (!empty($perfil->getFotos())):
        $perfilUser = $perfil->getFotos();
        foreach ($perfilUser as $index => $row):
            if ($index == 'estado_foto_perfil' && $row == "aprobada"):
                $class = "fa fa-check";
            else:
                $class = "fas fa-times";
            endif;
            $perfilUser['estado_foto_perfil'] = $class;
        endforeach;
        echo json_encode($perfilUser);
    else:
        $error['mensaje'] = "No se encontraron registros";
        echo json_encode($error);
    endif;
elseif (isset($_POST['actualizar_estado']) &&
    isset($_POST['id_foto_perfil']) &&
    isset($_POST['estado']) &&
    isset($_POST['observacion'])):

    $data = array();
    foreach ($_POST as $indice => $valor):
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;
    $perfil = new FotoPerfilM();
    $perfil->setId_foto_perfil($data['id_foto_perfil']);
    $perfil->detalle_solicitud();
    if (!empty($perfil->getFotos())):
        $perfil->setObservacion($data['observacion']);
        $perfil->setEstado_foto_perfil($data['estado']);
        if ($perfil->actualizar_solicitud()):
            $n = new NotificacionesM();
            $run_trabajador = $perfil->getFotos()['trabajador_run_trabajador'];
            $n->setRun_trabajador($run_trabajador);
            $n->setTipo("admin");
            $n->eliminar_notificacion();
            if ($data['estado'] == "rechazada"):
                $n->setDescripcion("Solicitud rechazada");
                $n->setTipo("user");
                $n->registrar_notificacion();
                $options = array(
                    'cluster' => 'us2',
                    'useTLS' => false,
                );
                $pusher = new Pusher\Pusher(
                    '007aa358a604a98ed413',
                    '00e69b3c91fd9e02248f',
                    '605862',
                    $options
                );
                $notificacion['title'] = 'Imagen rechazada';
                $notificacion['message'] = 'Se recomienda volver a subir una nueva foto';
                $notificacion['image'] = $perfil->getFotos()['url_foto_perfil'];
                $notificacion['url'] = '#';
                $pusher->trigger('user_' . $run_trabajador, 'my-event', $notificacion);
            endif;

            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Solicitud " . $data['estado'] . " correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        else:
            $error['titulo'] = "Oops, hubo un error!";
            $error['mensaje'] = "El estado de la solicitud no pudo ser actualizado.";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;

    else:
        $error['titulo'] = "Oops, hubo un error!";
        $error['mensaje'] = "El id fue modificado";
        $error['clase'] = "danger";
        echo json_encode($error);
    endif;

endif;
//FIN SOLICITUDES
function clean($string)
{
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function esRut($r = false)
{
    if ((!$r) or (is_array($r))) {
        return false;
    }
    /* Hace falta el rut */

    if (!$r = preg_replace('|[^0-9kK]|i', '', $r)) {
        return false;
    }
    /* Era código basura */

    if (!((strlen($r) == 8) or (strlen($r) == 9))) {
        return false;
    }
    /* La cantidad de carácteres no es válida. */

    $v = strtoupper(substr($r, -1));
    if (!$r = substr($r, 0, -1)) {
        return false;
    }

    if (!((int) $r > 0)) {
        return false;
    }
    /* No es un valor numérico */

    $x = 2;
    $s = 0;
    for ($i = (strlen($r) - 1); $i >= 0; $i--) {
        if ($x > 7) {
            $x = 2;
        }

        $s += ($r[$i] * $x);
        $x++;
    }
    $dv = 11 - ($s % 11);
    if ($dv == 10) {
        $dv = 'K';
    }

    if ($dv == 11) {
        $dv = '0';
    }

    if ($dv == $v) {
        return number_format($r, 0, '', '.') . '-' . $v;
    }
    /* Formatea el RUT */
    return false;
}
