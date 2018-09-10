<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/GaleriaM.php';
require_once $ruta_raiz . '/model/subirImagenM.php';

if (isset($_FILES['files']) && !empty($_FILES['files'])):
    $imagen = null;
    $error = array();
    $count = count($_FILES["files"]['name']);

    //limpiar registros de array para luego pasarlos a uno nuevo
    for($i=0;$i<$count;$i++):
        $_FILES['imagen_'.$i]['name'] = $_FILES['files']['name'][$i];
        $_FILES['imagen_'.$i]['type'] = $_FILES['files']['type'][$i];
        $_FILES['imagen_'.$i]['tmp_name'] = $_FILES['files']['tmp_name'][$i];
        $_FILES['imagen_'.$i]['error'] = $_FILES['files']['error'][$i];
        $_FILES['imagen_'.$i]['size'] = $_FILES['files']['size'][$i];
    endfor;
    unset($_FILES['files']);

 
    for($i=0;$i<count($_FILES);$i++):
        $subir = new imgUpldr;
        $subir->__set("_new_name", date("Ymdhis") .$i. "_galeria");
        $subir->__set("_dest", "../assets/images/");
        $subida[$i] = $subir->init($_FILES['imagen_'.$i]);
        $imagen[$i] = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
        if (!empty($subida[$i])):
            $error['imagen_'.$i] = $subida[$i];
        else:

        endif;
        sleep(2);
    endfor;

endif;