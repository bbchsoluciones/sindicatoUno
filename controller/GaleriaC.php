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
    $subir->__set("_new_name", date("Ymdhis") . rand(1, 1000));
    $subir->__set("_dest", "../assets/images/galeria/");
    $subida = $subir->init($_FILES['file']);
    $imagen = "http://localhost/sindicatoUno/assets/images/galeria/" . $subir->_name;
    if (!empty($subida)):
        $data['titulo'] = "Error";
        $data['imagen_nombre'] = $_FILES['file']['name'] . " => " . $subida;
        $data['clase'] = "danger";
        $data['icono'] = "times";
    else:
        $galeria = new GaleriaM();
        $galeria->setUrl_foto_galeria($imagen);
        $galeria->setTrabajador_run_trabajador($_SESSION['run_trabajador']);
        $galeria->setDestacado("0");
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
elseif (isset($_GET['modificar_destacado']) &&
    isset($_GET['id_foto_galeria']) &&
    isset($_GET['destacado'])):
    $mensaje = array();
    $galeria = new GaleriaM();
    $destacado = (int) htmlspecialchars($_GET['destacado']);
    $galeria->setId_foto_galeria(htmlspecialchars($_GET['id_foto_galeria']));
    $galeria->setDestacado($destacado);
    $galeria->contador_destacado();
    $total = (int) $galeria->getTotal_destacado();
    if ($destacado === 0):
        if ($galeria->actualizar_destacado() !== true):
            $mensaje['titulo'] = "Ha ocurrido un error";
            $mensaje['mensaje'] = "No se pudo cambiar la categoria";
            $mensaje['clase'] = "danger";
            echo json_encode($mensaje);
        endif;
    elseif ($destacado === 1 && $total < 5):
        if ($galeria->actualizar_destacado() !== true):
            $mensaje['titulo'] = "Ha ocurrido un error";
            $mensaje['mensaje'] = "No se pudo cambiar la categoria";
            $mensaje['clase'] = "danger";
            echo json_encode($mensaje);
        endif;
    else:
        $mensaje['titulo'] = "Ha ocurrido un error";
        $mensaje['mensaje'] = "Solo pueden haber 5 imágenes destacadas";
        $mensaje['clase'] = "danger";
        echo json_encode($mensaje);
    endif;
elseif (isset($_GET['eliminar_imagen']) &&
    isset($_GET['id_foto_galeria'])):
    $mensaje = array();
    $galeria = new GaleriaM();
    $galeria->setId_foto_galeria(htmlspecialchars($_GET['id_foto_galeria']));
    $galeria->mostrar_imagen();
    $galeria->setUrl_foto_galeria($galeria->getGaleria()['url_foto_galeria']);
    if ($galeria->eliminar_imagen()):
        $mensaje['titulo'] = "Éxito";
        $mensaje['mensaje'] = "Imagen eliminada correctamente";
        $mensaje['clase'] = "success";
        echo json_encode($mensaje);
    else:
        $mensaje['titulo'] = "Error";
        $mensaje['mensaje'] = "Imagen no pudo ser eliminada";
        $mensaje['clase'] = "danger";
        echo json_encode($mensaje);
    endif;

elseif (isset($_GET['listado'])):
    $galeria = new GaleriaM();
    $galeria->mostrar_galeria();
    $galeria->contador_destacado();
    if (!empty($galeria->getGaleria())):
        $total = $galeria->getTotal_destacado();
        $galeria = $galeria->getGaleria();
        foreach ($galeria as $key => $val):
            $galeria[$key]['nombre_imagen'] = pathinfo($val['url_foto_galeria'], PATHINFO_BASENAME);
        endforeach;
        $galeria = array(
            "galeria" => $galeria,
            "total" => $total,
        );
        echo json_encode($galeria);
    else:
        $galeria = array("galeria" => "");
        echo json_encode($galeria);
    endif;
elseif(isset($_GET['listado_publico'])):
    $galeria = new GaleriaM();
    $galeria->mostrar_galeria();
    if (!empty($galeria->getGaleria())):
        $galeria = array("galeria" => $galeria->getGaleria());
    endif;
    echo json_encode($galeria);
endif;
