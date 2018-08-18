<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/HijoTrabajadorM.php');
if(isset($_GET['run_hijo'])){
    $hijo = new HijoTrabajadorM();
    $eliminado = array();
    $rut = htmlspecialchars($_GET['run_hijo']);
    $rut = clean($rut);
    $hijo->setRun_hijo($rut);
    $hijoExiste= $hijo->encontrar_hijo();
    if ($hijoExiste==true):
        if($hijo->eliminar_hijo()):
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
    
}
function clean($string) 
{
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


