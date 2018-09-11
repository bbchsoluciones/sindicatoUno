<?php

$ruta_raiz = dirname(dirname(__FILE__));
require_once $ruta_raiz . '/model/GaleriaM.php';
require_once $ruta_raiz . '/model/subirImagenM.php';
if (!isset($_SESSION)):
    session_start();
endif;

if (isset($_FILES['file']) && !empty($_FILES['file'])):
    $imagen = null;
    $data = array();
    $mensaje = array();
    $json = array();

    $subir = new imgUpldr;
    $subir->__set("_new_name", date("Ymdhis") .rand(1,1000). "_galeria");
    $subir->__set("_dest", "../assets/images/galeria/");
    $subida = $subir->init($_FILES['file']);
    $imagen = "http://localhost/sindicatoUno/assets/images/" . $subir->_name;
    if (!empty($subida)):
        $data['titulo'] = "Error";
        $data['imagen_nombre'] = $_FILES['file']['name']." => ".$subida;
        $data['clase'] = "danger";
        $data['icono'] = "times";
    else:
        $galeria = new GaleriaM();
        $galeria->setUrl_foto_galeria($imagen);
        $galeria->setTrabajador_run_trabajador($_SESSION['run_trabajador']);
        if ($galeria->agregar_imagen()):
            $data['titulo'] = 'Éxito';
            $data['imagen_nombre'] = $_FILES['file']['name'];
            $data['clase'] = "success";
            $data['icono'] = "check";
        else:
            $data['titulo'] = "Error";
            $data['imagen_nombre'] = $_FILES['file']['name'];
            $data['clase'] = "danger";
            $data['icono'] = "times";
        endif;
    endif;
    if (in_array("danger", $data)):
        $mensaje['titulo'] = "Ha ocurrido un error!";
        $mensaje['mensaje'] = "Uno o más archivos no han podido ser subidos!.";
        $mensaje['clase'] = "danger";
        $mensaje['icono'] = "times";
        $json = array("mensaje" => $mensaje, "imagen" => $data);
        echo json_encode($json);
    else:
        $mensaje['titulo'] = "Éxito!";
        $mensaje['mensaje'] = "Archivo(s) subido(s) correctamente.";
        $mensaje['clase'] = "success";
        $mensaje['icono'] = "check";
        $json = array("mensaje" => $mensaje, "imagen" => $data);
        echo json_encode($json);
    endif;
    sleep(1);
endif;
