<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/MovimientoM.php');
//mostrar_movimientos_ingresos(8, 2018)
//Dentro de Controlador
if(
    isset($_POST['id_categoria']) && 
    isset($_POST['anio'])
    
)
{

    $mov = new MovimientoM();
    $mov->mostrar_movimientos_ingresos($_POST['id_categoria'], $_POST['anio']);
    if (!empty($mov->getMovimientos())):
        $mov = array(
            "data" =>
                $mov->getMovimientos()
            
        );
        echo json_encode($mov);
    else:
        $mov = array(
            "data" =>
                ""
            
        );
        echo json_encode($mov);
    endif;



}



