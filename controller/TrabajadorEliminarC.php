<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/TrabajadorM.php');
if(isset($_GET['run_trabajador'])){
    $trabajador = new TrabajadorM();
    $eliminado = array();
    $rut = htmlspecialchars($_GET['run_trabajador']);
    $rut = clean($rut);
    $trabajador->setRun_trabajador($rut);
    $existT = $trabajador->encontrar_trabajador();
    if ($existT==true):
        if($trabajador->eliminar_trabajador()):
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
    
}
function clean($string) 
{
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}


