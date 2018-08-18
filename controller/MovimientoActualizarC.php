<?php
//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/MovimientoM.php');
//Dentro de Controlador


if(
    isset($_POST['id_mov']) && 
    isset($_POST['monto'])
    
)
{
    
    
}