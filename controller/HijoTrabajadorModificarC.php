<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$run_trabajadora_raiz = dirname(dirname(__FILE__));
require_once($run_trabajadora_raiz . '/model/TrabajadorM.php');
require_once($run_trabajadora_raiz . '/model/HijoTrabajadorM.php');
date_default_timezone_get('America/Santiago');


if( 
    isset($_POST['run_hijo']) &&
    isset($_POST['run_trabajador']) &&
    isset($_POST['nombres_hijo']) &&
    isset($_POST['apellidos_hijo']) &&
    isset($_POST['genero_hijo']) &&
    isset($_POST['fec_nac_hijo'])
):

    $data = array();
    $imagen = "";
    $error = array();
  
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach($_POST as $indice => $valor):
        if(strpos($indice, 'fec')!==false):
            $date = clean($valor);
            if(is_numeric($date)):
                if(strpos($valor, '-')):
                    $valor = str_replace("-","/",$valor);
                endif;
                $fecha = explode("/", $valor);
                if(checkdate($fecha[1],$fecha[0],$fecha[2])):
                    try{
                        $valor = DateTime::createFromFormat('d/m/Y', $valor);
                        $valor = $valor->format('Y-m-d');
                    }catch(Exception $e){
                        $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                        $error[$indice] = $valor;
                    } 
                else:
                    $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                    $error[$indice] = $valor;
                endif;
            else:
                $valor = "Fecha invalida, favor usar formato Dia/Mes/Año";
                $error[$indice] = $valor;
            endif;
        elseif($indice == 'run_hijo' && esRut($valor)==false || $indice == "run_trabajador" && esRut($valor)==false):
            $valor = "Rut invalido";
            $error[$indice] = $valor;
        endif;
        if(empty(trim($valor)) || strpos($valor, "...")==true):
            $valor = "Campo vació o invalido, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice]= utf8_decode(htmlspecialchars($valor));
    endforeach;

    $rut_trabajador = clean($data['run_trabajador']);
    $rut_hijo = clean($data['run_hijo']);

    if($rut_trabajador==$rut_hijo):
        $error['run_hijo'] = "El rut ingresado, ya se encuentra asignado!";
    endif;

    if(count($error)>0):
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
        if($trabajadorExiste==false):
            $error['titulo'] = "Ha ocurrido un error!";
            $error['mensaje'] = "El trabajador no existe!";
            $error['clase'] = "danger";
            echo json_encode($error);
        elseif($trabajadorExiste==true):
             //verificar que el hijo no exista
            $hijoExiste = $hijo->encontrar_hijo();
            if($hijoExiste==false):
                $error['titulo'] = "Ha ocurrido un error!";
                $error['mensaje'] = "El rut fue modificado, favor no editar los archivos html/js";
                $error['clase'] = "danger";
                echo json_encode($error);
            else:
                $hijo->setNombres_hijo($data['nombres_hijo']);
                $hijo->setApellidos_hijo($data['apellidos_hijo']);
                $hijo->setGenero_hijo($data['genero_hijo']);
                $hijo->setFec_nac_hijo($data['fec_nac_hijo']);
                if($hijo->actualizar_hijo()):
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
 
 else:
 
    $error['titulo'] = "Ha ocurrido un error!";
    $error['mensaje'] = "Se ha modificado el rut del trabajador";
    $error['clase'] = "danger";
    echo json_encode($error);
     
 endif;
function clean($string) 
{
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function esRut($r = false){
    if((!$r) or (is_array($r)))
        return false; /* Hace falta el rut */
 
    if(!$r = preg_replace('|[^0-9kK]|i', '', $r))
        return false; /* Era código basura */
 
    if(!((strlen($r) == 8) or (strlen($r) == 9)))
        return false; /* La cantidad de carácteres no es válida. */
 
    $v = strtoupper(substr($r, -1));
    if(!$r = substr($r, 0, -1))
        return false;
 
    if(!((int)$r > 0))
        return false; /* No es un valor numérico */
 
    $x = 2; $s = 0;
    for($i = (strlen($r) - 1); $i >= 0; $i--){
        if($x > 7)
            $x = 2;
        $s += ($r[$i] * $x);
        $x++;
    }
    $dv=11-($s % 11);
    if($dv == 10)
        $dv = 'K';
    if($dv == 11)
        $dv = '0';
    if($dv == $v)
        return number_format($r, 0, '', '.').'-'.$v; /* Formatea el RUT */
    return false;
}
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

?>