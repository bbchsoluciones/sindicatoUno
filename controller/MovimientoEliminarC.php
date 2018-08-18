<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/MovimientoM.php');
//Dentro de Controlador

if(
    isset($_GET['id_mov'])
    
)
{
    $mov = new MovimientoM();
    if ($mov->eliminar_movimiento($_GET['id_mov'])):
        
        echo "true";
    else:
        echo "false";
    endif;
    
}



