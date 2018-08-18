<?php

//Archivos Requeridos
//Archivos Requeridos
//Archivos Requeridos
//Fuera de Controlador
$ruta_raiz = dirname(dirname(__FILE__));
require_once($ruta_raiz . '/model/NoticiaM.php');
//Dentro de Controlador
$n = new NoticiaM();
    $n->mostrar_noticias();
    if (!empty($n->getNoticias())):
        $n = array(
            "data" =>
                $n->getNoticias()
            
        );
        echo json_encode($n);
    else:
        $n = array(
            "data" =>
                ""
            
        );
        echo json_encode($n);
    endif;