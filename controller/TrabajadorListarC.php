<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/TrabajadorM.php');
//Dentro de Controlador
if(isset($_GET['accion']) && !empty($_GET['accion'])):
    $trabajador = new TrabajadorM();
    $objeto = $_GET['objeto'];
    if($_GET['accion']==="buscar" && ctype_digit(clean($_GET['objeto']))==true ):
        $objeto = clean($_GET['objeto']);
    endif;
    $trabajador->filtrarTrabajadores($_GET['accion'],$objeto,$_GET['pagina'],$_GET['r_pagina']);
    if (!empty($trabajador->getTrabajadores())):
        $trabajadores = array(
            "trabajador" => array(
                $trabajador->getTrabajadores()
            ),
            "cantidad_total" => array(
                $trabajador->getCantidad_trabajadores()
            ),
            "accion" => array(
                "valor" => $_GET['accion']
            ),
            "objeto" => array(
                "valor" => $objeto
            ),
        );
        echo json_encode($trabajadores);
    else:
        echo "No se han encontrado registros!";
    endif;
elseif(isset($_GET['run_trabajador']) && !empty($_GET['run_trabajador'])):
    $trabajador = new TrabajadorM();
    $rut = clean($_GET['run_trabajador']);
    if(ctype_digit($rut)):
        $trabajador->setRun_trabajador($rut);
        $trabajador->mostrar_datos_trabajador();
        if (!empty($trabajador->getTrabajador())):
            $trabajadores = array(
                "trabajador" => array(
                    $trabajador->getTrabajador()
                )
            );
            echo json_encode($trabajadores);
        else:
            echo "false";
        endif;
    else:
        echo "false";
    endif;
endif;
function clean($string) {
    $string = str_replace('-', '', $string); // Replaces all hyphens with nothing :V.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}