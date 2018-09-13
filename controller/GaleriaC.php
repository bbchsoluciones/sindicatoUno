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
    echo json_encode($data);
    sleep(1);
    elseif (isset($_POST['listado'])):
        $galeria = new NoticiaM();
        $n->mostrar_noticias();
        if (!empty($n->getNoticias())):
            $noticias = $n->getNoticias();
            foreach ($noticias as $key => $val):
                $noticias[$key]['fecha_publicacion'] = strftime("%d %b %Y, %H:%m", strtotime($val['fecha_publicacion']));
            endforeach;
            $n = array("data" => $noticias);
            echo json_encode($n);
        else:
            $n = array("data" => "");
            echo json_encode($n);
        endif;
endif;
