<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$run_trabajadora_raiz = dirname(dirname(__FILE__));
require_once($run_trabajadora_raiz . '/model/TrabajadorM.php');
require_once('EncriptadorC.php');
//Dentro de Controlador
if(isset($_POST['tipo_usuario']) &&
    isset($_POST['nombres_trabajador']) &&
    isset($_POST['apellidos_trabajador']) &&
    isset($_POST['contrasena_trabajador']) &&
    isset($_POST['run_trabajador'])):

    $data = array();
    $error = array();
    //limpiar registros de array para luego pasarlos a uno nuevo
    foreach($_POST as $indice => $valor):
        if(strpos($valor, '...')!==false):
            $valor = "Campo vació, favor completar";
            $error[$indice] = $valor;
            elseif($indice == 'run_trabajador' && esRut($valor)==false):
                $valor = "Rut invalido";
                $error[$indice] = $valor;
            endif;
        if(empty(trim($valor)) && $valor!=='0'):
            $valor = "Campo vació, favor completar";
            $error[$indice] = $valor;
        endif;
        $data[$indice]= utf8_decode(htmlspecialchars($valor));
    endforeach;


    if(count($error)>0):
       $error['titulo'] = "Ha ocurrido un error!";
       $error['mensaje'] = "Uno o más campos tienen información errónea o están vacíos.";
       $error['clase'] = "danger";
       echo json_encode($error);
    else:
        $data['run_trabajador'] = clean($data['run_trabajador']);
        $encriptador = new EncriptadorC($data['contrasena_trabajador']);
        $data['contrasena_trabajador']= $encriptador->getClave(); 
        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($data['run_trabajador']);
        $trabajador->setNombres_trabajador($data['nombres_trabajador']);
        $trabajador->setApellidos_trabajador($data['apellidos_trabajador']);
        $trabajador->setContrasena_trabajador($data['contrasena_trabajador']);
        $trabajador->setTipo_usuario_id_tipo_usuario($data['tipo_usuario']);
        if($trabajador->registrar_trabajador()):
            $error['titulo'] = "Éxito!";
            $error['mensaje'] = "Información registrada correctamente.";
            $error['clase'] = "success";
            echo json_encode($error);
        else:
            $error['titulo'] = "Oops hubo un error!";
            $error['mensaje'] = "El rut ingresado ya existe.";
            $error['clase'] = "danger";
            echo json_encode($error);
        endif; 
    endif;
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
?>
