<?php
//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/MovimientoM.php');
//Dentro de Controlador


if(isset($_POST['monto']) && isset($_POST['id_nom']) && isset($_POST['run']) && isset($_POST['fecha'])):
    $monto = (int) $_POST['monto'];//to int
    $id_nom = $_POST['id_nom'];    
    $run = $_POST['run'];
    $fecha = $_POST['fecha'];
    $date = new DateTime($fecha);      
    $m = new MovimientoM();//Crea objeto MovimientoM    
    if($m->registrar_movimiento($monto, $id_nom, $run, $date->format('Y-m-d H:i:s'))):
        echo "true";//registrado con éxito        
    else:
        echo "false";//no registrado    
        $m = null;
    endif;
elseif(isset($_POST['ajax']) && isset($_POST['func'])):
    $mov = new MovimientoM();
    $mov->mostrar_todos_movimientos();
    if (!empty($mov->getMovimientos())):
        $mov = array("data" => $mov->getMovimientos());
        echo json_encode($mov);
    else:
        $mov = array("data" => "");
        echo json_encode($mov);
    endif;
elseif(isset($_POST['id_mov']) && isset($_POST['monto_nuevo'])):
    $id_mov = $_POST['id_mov'];
    $monto = (int) $_POST['monto_nuevo'];// to int   
    $m = new MovimientoM();//Crear Movimiento    
    if($m->modificar_movimiento($id_mov, $monto)):        
        echo "true";//actualizado con exito        
    else:        
        echo "false";//no se actualizo    
        $m = null;
    endif;
elseif(isset($_POST['ajax']) && isset($_POST['id_mov'])):    
    $mov = new MovimientoM();
    if ($mov->eliminar_movimiento($_POST['id_mov'])):        
        echo "true";//eliminado con exito
    else:
        echo "false";// no eliminado
    endif;
endif;//fin