<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/TrabajadorM.php');
require_once($ruta_raiz . '/model/HijoTrabajadorM.php');
//Dentro de Controlador

if(isset($_GET['run']) && !empty($_GET['run'])):
    
    $rut = clean($_GET['run']);
    $error = array();
    if(ctype_digit($rut)):
        $trabajador = new TrabajadorM();
        $trabajador->setRun_trabajador($rut);
        $trabajadorExiste = $trabajador->encontrar_trabajador();
        $hijo = new HijoTrabajadorM();
        $hijo->setRun_hijo($rut);
        $hijo->setTrabajador_run_trabajador($rut);
        $hijoExiste = $hijo->encontrar_hijo();
        //verificar que el trabajador exista
       
        if($trabajadorExiste==true):
            $trabajador->mostrar_datos_trabajador();
            $hijo->mostrar_datos_hijos();
            if (!empty($trabajador->getTrabajador()) && !empty($hijo->getHijo())):
                $hijo->contarHijos();
                $array = array(
                    "trabajador" => array(
                        $trabajador->getTrabajador()
                    ),
                    "hijos" => array(
                        $hijo->getHijo()
                    ),
                    "cantidad_hijos" => array(
                        $hijo->getCantidad_hijos()
                    ),
                    "selected" => array(
                        "0"
                    )
                );
                echo json_encode($array);
            else:
                $error['titulo'] = "Ha ocurrido un error!";
                $error['mensaje'] = "El rut del trabajador(a) ingresado, no tiene hijos registrados";
                $error['clase'] = "danger";
                echo json_encode($error);
            endif;
        elseif($hijoExiste==true):
            $hijo->mostrar_rut_padre();
            $run_trabajador = $hijo->getTrabajador_run_trabajador();
            $trabajador->setRun_trabajador($run_trabajador);
            $trabajador->mostrar_datos_trabajador();
            $hijo->mostrar_datos_hijos();
            if (!empty($trabajador->getTrabajador()) && !empty($hijo->getHijo())):
                $hijo->contarHijos();
                $array = array(
                    "trabajador" => array(
                        $trabajador->getTrabajador()
                    ),
                    "hijos" => array(
                        $hijo->getHijo()
                    ),
                    "cantidad_hijos" => array(
                        $hijo->getCantidad_hijos()
                    ),
                    "selected" => array(
                        $rut
                    )
                );
                echo json_encode($array);
            else:
                
            endif;

        else:
            $error['titulo'] = "Ha ocurrido un error!";
            $error['mensaje'] = "no hay coincidencias!";
            $error['clase'] = "danger";
            echo json_encode($error);
            
        endif;
        
    else:
        $error['titulo'] = "Ha ocurrido un error!";
        $error['mensaje'] = "rut invalido";
        $error['clase'] = "danger";
        echo json_encode($error);
    endif;
elseif(isset($_GET['run_hijo']) && !empty($_GET['run_hijo'])):

    $rut = clean($_GET['run_hijo']);
    $error = array();
    if(ctype_digit($rut)):
        $hijo = new HijoTrabajadorM();
        $hijo->setRun_hijo($rut);
        $hijoExiste = $hijo->encontrar_hijo();
        if($hijoExiste):
            $hijo->mostrar_datos_hijo();
            if (!empty($hijo->getHijo())):
                $hijo = array(
                    "hijo" => array(
                        $hijo->getHijo()
                    )
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
    
endif;
function clean($string) {
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}