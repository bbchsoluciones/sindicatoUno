<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/TrabajadorM.php';
require_once $ruta_raiz . '/model/HijoTrabajadorM.php';
date_default_timezone_get('America/Santiago');
//mostrar padre y sus hijos
if (isset($_GET['run']) && !empty($_GET['run']) && isset($_GET['detalle'])):

    $rut = clean($_GET['run']);
    $error = array();
    if (esRut($rut)):
        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($rut);
        $trabajadorExiste = $trabajador->encontrar_trabajador();
        $hijo = new HijoTrabajadorM();
        $hijo->setRun_hijo($rut);
        $hijo->setTrabajador_run_trabajador($rut);
        $hijoExiste = $hijo->encontrar_hijo();
        //verificar que el trabajador exista

        if ($trabajadorExiste == true):
            $trabajador->mostrar_datos_trabajador();
            $hijo->mostrar_datos_hijos();
            if (!empty($trabajador->getTrabajador()) && !empty($hijo->getHijo())):
                $hijo->contarHijos();
                $array = array(
                    "trabajador" => array(
                        $trabajador->getTrabajador(),
                    ),
                    "hijos" => array(
                        $hijo->getHijo(),
                    ),
                    "cantidad_hijos" => array(
                        $hijo->getCantidad_hijos(),
                    ),
                    "selected" => array(
                        "0",
                    ),
                );
                echo json_encode($array);
            else:
                $error['titulo'] = "El rut del trabajador(a) ingresado, no tiene hijos registrados";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;
        elseif ($hijoExiste == true):
            $hijo->mostrar_rut_padre();
            $run_trabajador = $hijo->getTrabajador_run_trabajador();
            $trabajador->setRun_trabajador($run_trabajador);
            $trabajador->mostrar_datos_trabajador();
            $hijo->mostrar_datos_hijos();
            if (!empty($trabajador->getTrabajador()) && !empty($hijo->getHijo())):
                $hijo->contarHijos();
                $array = array(
                    "trabajador" => array(
                        $trabajador->getTrabajador(),
                    ),
                    "hijos" => array(
                        $hijo->getHijo(),
                    ),
                    "cantidad_hijos" => array(
                        $hijo->getCantidad_hijos(),
                    ),
                    "selected" => array(
                        $rut,
                    ),
                );
                echo json_encode($array);
            else:

            endif;

        else:
            $error['titulo'] = "No hay coincidencias!";
            $error['clase'] = "danger";
            echo json_encode($error);

        endif;

    else:
        $error['titulo'] = "Rut invalido!";
        $error['clase'] = "danger";
        echo json_encode($error);
    endif;
//fin mostrar padre y sus hijos

//mostrar datos hijo
elseif (isset($_GET['run_hijo']) && !empty($_GET['run_hijo']) && isset($_GET['mostrar'])):

    $rut = clean($_GET['run_hijo']);
    $error = array();
    if (esRut($rut)):
        $hijo = new HijoTrabajadorM();
        $hijo->setRun_hijo($rut);
        $hijoExiste = $hijo->encontrar_hijo();
        if ($hijoExiste):
            $hijo->mostrar_datos_hijo();
            if (!empty($hijo->getHijo())):
                $hijo = array(
                    "hijo" => array(
                        $hijo->getHijo(),
                    ),
                );
                echo json_encode($hijo);
            else:
                $error['titulo'] = "Ha ocurrido un error!";
                $error['mensaje'] = "No hay coincidencias";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;

        else:
            $error['titulo'] = "Ha ocurrido un error!";
            $error['mensaje'] = "rut invalido";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif;

    else:
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "rut invalido";
        $error['clase'] = "danger";
        echo json_encode($error);
    endif;
// fin mostrar datos hijo

// registrar hijo
elseif (
    isset($_POST['run_hijo']) &&
    isset($_POST['run_trabajador']) &&
    isset($_POST['nombres_hijo']) &&
    isset($_POST['apellidos_hijo']) &&
    isset($_POST['genero_hijo']) &&
    isset($_POST['fec_nac_hijo']) &&
    isset($_POST['registrar_hijo'])
):

    $data = array();
    $imagen = "";
    $error = array();
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach ($_POST as $indice => $valor):
        if (strpos($indice, 'fec') !== false):
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
                        $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                        $error[$indice] = $valor;
                    } else :
                    $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                    $error[$indice] = $valor;
                endif;
            else:
                $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                $error[$indice] = $valor;
            endif;
        elseif ($indice == 'run_hijo' && esRut($valor) == false || $indice == "run_trabajador" && esRut($valor) == false):
            $valor = "Rut invalido";
            $error[$indice] = $valor;
        endif;
        if (empty(trim($valor)) || strpos($valor, "...") == true):
            $valor = "Campo vació o invalido, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    $rut_trabajador = clean($data['run_trabajador']);
    $rut_hijo = clean($data['run_hijo']);

    if ($rut_trabajador == $rut_hijo):
        $error['run_hijo'] = "El rut ingresado, ya se encuentra asignado!";
    endif;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($rut_trabajador);
        $hijo = new HijoTrabajadorM();
        $hijo->setRun_hijo($rut_hijo);
        $trabajadorExiste = $trabajador->encontrar_trabajador();
        //verificar que el trabajador exista
        if ($trabajadorExiste == false):
            $error['titulo'] = "El trabajador no existe!";
            $error['mensaje'] = "El trabajador no existe!";
            $error['clase'] = "danger";
            echo json_encode($error);
        elseif ($trabajadorExiste == true):
            //verificar que el hijo no exista
            $hijoExiste = $hijo->encontrar_hijo();
            if ($hijoExiste == true):
                $error['titulo'] = "Ha ocurrido un error!";
                $error['mensaje'] = "El rut ingresado, ya se encuentra en la base de datos!";
                $error['clase'] = "danger";
                echo json_encode($error);
            else:
                $hijo->setTrabajador_run_trabajador($rut_trabajador);
                $hijo->setNombres_hijo($data['nombres_hijo']);
                $hijo->setApellidos_hijo($data['apellidos_hijo']);
                $hijo->setGenero_hijo($data['genero_hijo']);
                $hijo->setFec_nac_hijo($data['fec_nac_hijo']);

                if ($hijo->registrar_hijo()):
                    $error['titulo'] = "Éxito!";
                    $error['mensaje'] = "Información ingresada correctamente.";
                    $error['clase'] = "success";
                    echo json_encode($error);
                else:
                    $error['titulo'] = "Oops hubo un error!";
                    $error['mensaje'] = "Información no pudo ser registrada.";
                    $error['clase'] = "success";
                    echo json_encode($error);
                endif;
            endif;
        endif;

    endif;
// fin registrar hijo

// modificar hijo

elseif (
    isset($_POST['run_hijo']) &&
    isset($_POST['run_trabajador']) &&
    isset($_POST['nombres_hijo']) &&
    isset($_POST['apellidos_hijo']) &&
    isset($_POST['genero_hijo']) &&
    isset($_POST['fec_nac_hijo']) &&
    isset($_POST['actualizar_hijo'])
):
    $data = array();
    $imagen = "";
    $error = array();

    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach ($_POST as $indice => $valor):
        if (strpos($indice, 'fec') !== false):
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
                        $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                        $error[$indice] = $valor;
                    } else :
                    $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                    $error[$indice] = $valor;
                endif;
            else:
                $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                $error[$indice] = $valor;
            endif;
        elseif ($indice == 'run_hijo' && esRut($valor) == false || $indice == "run_trabajador" && esRut($valor) == false):
            $valor = "Rut invalido";
            $error[$indice] = $valor;
        endif;
        if (empty(trim($valor)) || strpos($valor, "...") == true):
            $valor = "Campo vació o invalido, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice] = utf8_decode(htmlspecialchars($valor));
    endforeach;

    $rut_trabajador = clean($data['run_trabajador']);
    $rut_hijo = clean($data['run_hijo']);

    if ($rut_trabajador == $rut_hijo):
        $error['run_hijo'] = "El rut ingresado, ya se encuentra asignado!";
    endif;

    if (count($error) > 0):
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
        $error['clase'] = "danger";
        echo json_encode($error);
    else:
        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($rut_trabajador);
        $hijo = new HijoTrabajadorM();
        $hijo->setRun_hijo($rut_hijo);
        $trabajadorExiste = $trabajador->encontrar_trabajador();
        //verificar que el trabajador exista
        if ($trabajadorExiste == false):
            $error['titulo'] = "Ha ocurrido un error!";
            $error['mensaje'] = "El trabajador no existe!";
            $error['clase'] = "danger";
            echo json_encode($error);
        elseif ($trabajadorExiste == true):
            //verificar que el hijo no exista
            $hijoExiste = $hijo->encontrar_hijo();
            if ($hijoExiste == false):
                $error['titulo'] = "Ha ocurrido un error!";
                $error['mensaje'] = "El rut fue modificado, favor no editar los archivos html/js";
                $error['clase'] = "danger";
                echo json_encode($error);
            else:
                $hijo->setNombres_hijo($data['nombres_hijo']);
                $hijo->setApellidos_hijo($data['apellidos_hijo']);
                $hijo->setGenero_hijo($data['genero_hijo']);
                $hijo->setFec_nac_hijo($data['fec_nac_hijo']);
                if ($hijo->actualizar_hijo()):
                    $error['titulo'] = "Éxito!";
                    $error['mensaje'] = "Información actualizada correctamente.";
                    $error['clase'] = "success";
                    echo json_encode($error);
                else:
                    $error['titulo'] = "Oops hubo un error!";
                    $error['mensaje'] = "Información no pudo ser actualizada.";
                    $error['clase'] = "danger";
                    echo json_encode($error);
                endif;

            endif;

        endif;

    endif;
elseif (isset($_GET['run_hijo'])):
    $hijo = new HijoTrabajadorM();
    $eliminado = array();
    $rut = htmlspecialchars($_GET['run_hijo']);
    $rut = clean($rut);
    $hijo->setRun_hijo($rut);
    $hijoExiste = $hijo->encontrar_hijo();
    if ($hijoExiste == true):
        if ($hijo->eliminar_hijo()):
            $eliminado['titulo'] = "Éxito!";
            $eliminado['mensaje'] = "hijo(a) eliminado satisfactoriamente.";
            $eliminado['clase'] = "success";
            echo json_encode($eliminado);
        else:
            $eliminado['titulo'] = "Oops!";
            $eliminado['mensaje'] = "el registro no ha podido ser eliminado.";
            $eliminado['clase'] = "danger";
            echo json_encode($eliminado);
        endif;

    else:
        $eliminado['titulo'] = "Oops!";
        $eliminado['mensaje'] = "el rut no existe.";
        $eliminado['clase'] = "danger";
    endif;
else:
    $error['titulo'] = "FATAL";
    echo json_encode($error);

endif;

// fin modifica hijo
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
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
