<?php
//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/MovimientoM.php');
//Dentro de Controlador


if(isset($_POST['monto']) && isset($_POST['id_nom']) && isset($_POST['run']) && isset($_POST['fecha']) && isset($_POST['desc'])):
    $monto = (int) $_POST['monto'];//to int
    $id_nom = $_POST['id_nom'];    
    $run = $_POST['run'];
    $fecha = $_POST['fecha'];
    $date = new DateTime($fecha);    
    $desc = $_POST['desc'];   
    if($desc == ""):
        $desc = NULL;
    endif;
    $m = new MovimientoM();//Crea objeto MovimientoM    
    if($m->registrar_movimiento($monto, $id_nom, $run, $date->format('Y-m-d H:i:s'), $desc)):
        echo "true";//registrado con éxito        
    else:
        echo "false";//no registrado    
        $m = null;
    endif;
elseif(isset($_POST['ajax']) && isset($_POST['func'])):
    $m = new MovimientoM();
    $m->mostrar_todos_movimientos();
    if (!empty($m->getMovimientos())):
        $m = array("data" => $m->getMovimientos());
        echo json_encode($m);
    else:
        $m = array("data" => "");
        echo json_encode($m);
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
    $m = new MovimientoM();
    if ($m->eliminar_movimiento($_POST['id_mov'])):        
        echo "true";//eliminado con exito
    else:
        echo "false";// no eliminado
    endif;
elseif(isset($_POST['id_categoria']) && isset($_POST['anio'])):
    $m = new MovimientoM();
    $m->mostrar_movimientos_ingresos($_POST['id_categoria'], $_POST['anio']);
    if (!empty($m->getMovimientos())):
        $m = array("data" => $m->getMovimientos());
        echo json_encode($m);
    else:
        $m = array("data" => "");
        echo json_encode($m);
    endif;
elseif(isset($_POST['id_tipo']) && isset($_POST['anio'])):
    $m = new MovimientoM();
    $m->mostrar_movimientos_totales($_POST['id_tipo'], $_POST['anio']);
    if (!empty($m->getMovimientos())):
        $m = array("data" => $m->getMovimientos());
        echo json_encode($m);
    else:
        $m = array("data" => "");
        echo json_encode($m);
    endif;
endif;//fin